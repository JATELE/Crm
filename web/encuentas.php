<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logueado = isset($_SESSION["cliente_sesion"]);
$nombre = $logueado ? $_SESSION["cliente_sesion"]["nombre"] : "";
$apellido = $logueado ? $_SESSION["cliente_sesion"]["apellido"] : "";
$dni_cliente = $logueado ? $_SESSION["cliente_sesion"]["dni"] : "";

require_once "../app/models/conexion.php";
$con = new Conexion();
$con->conectar();
$conn = $con->getConexion();

// --- Procesar envío de respuestas ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_encuesta"])) {
    $id_encuesta = intval($_POST["id_encuesta"]);
    $fecha = date("Y-m-d");

    if ($logueado) {
        // Verificar si ya respondió
        $stmt = $conn->prepare("SELECT 1 FROM respuestas2 WHERE dni_cliente = ? AND id_encuesta = ? LIMIT 1");
        $stmt->bind_param("si", $dni_cliente, $id_encuesta);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Ya has respondido esta encuesta.'); window.location.href='encuentas.php';</script>";
            exit;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Debes iniciar sesión para responder la encuesta.'); window.location.href='encuentas.php';</script>";
        exit;
    }

    // Guardar respuestas
    if (isset($_POST["respuestas"]) && is_array($_POST["respuestas"])) {

        // Si es encuesta Deseo, tomar los valores fuera del foreach
        if ($id_encuesta == 9) {
            $destino = isset($_POST["respuestas"][11]) ? trim($_POST["respuestas"][11]) : null;
            $presupuesto_estimado = isset($_POST["respuestas"][12]) ? floatval($_POST["respuestas"][12]) : 0;
            $tiempo_estimado = isset($_POST["respuestas"][13]) ? trim($_POST["respuestas"][13]) : null;
            $peso_indicador = 0;
        }

        foreach ($_POST["respuestas"] as $id_pregunta => $respuesta) {
            $respuesta = trim($respuesta);
            if ($respuesta !== "") {
                // Guardar en respuestas2
                $stmt = $conn->prepare("INSERT INTO respuestas2 (id_encuesta, id_pregunta, dni_cliente, respuesta, fecha_respuesta) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iisss", $id_encuesta, $id_pregunta, $dni_cliente, $respuesta, $fecha);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Insertar en deseo2 solo una vez
        if ($id_encuesta == 9) { // Encuesta Deseo
            // Recoger las respuestas
            $destino = trim($_POST["respuestas"][11] ?? "");
            $presupuesto_input = trim($_POST["respuestas"][12] ?? "0");
            $tiempo_estimado = trim($_POST["respuestas"][13] ?? "");

            // Función para convertir texto como "2 mil" o "2,500" a número
            function convertir_texto_a_numero($texto)
            {
                $texto = strtolower($texto);
                $texto = str_replace(',', '', $texto); // quitar comas
                $numero = 0;

                if (preg_match('/(\d+)\s*mil/', $texto, $m)) {
                    $numero = intval($m[1]) * 1000;
                } elseif (preg_match('/(\d+)/', $texto, $m)) {
                    $numero = intval($m[1]);
                }

                return $numero;
            }

            $presupuesto_estimado = convertir_texto_a_numero($presupuesto_input);

            // Peso indicador opcional
            $peso_indicador = 0;

            // Guardar en deseo2
            $stmt_deseo = $conn->prepare("INSERT INTO deseo2 (dni_cliente, destino, peso_indicador, presupuesto_estimado, tiempo_estimado) VALUES (?, ?, ?, ?, ?)");
            $stmt_deseo->bind_param("ssdds", $dni_cliente, $destino, $peso_indicador, $presupuesto_estimado, $tiempo_estimado);
            $stmt_deseo->execute();
            $stmt_deseo->close();
        }
        if ($id_encuesta == 10) {
            $bien_adquirido = trim($_POST["respuestas"][14] ?? "");
            $calificacion = intval($_POST["respuestas"][15] ?? 0);
            $lugar = trim($_POST["respuestas"][16] ?? "");
            $descripcion_exp = trim($_POST["respuestas"][17] ?? "");
            $tipo_de_viaje = trim($_POST["respuestas"][18] ?? "");
            $fecha_visita = trim($_POST["respuestas"][19] ?? null);
            $rango_costo = ""; // Opcional, puedes adaptarlo como presupuesto

            $stmt_exp = $conn->prepare("INSERT INTO experiencia2 (dni_cliente, bien_adquirido, calificacion, rango_costo, lugar, descripcion, tipo_de_viaje, fecha_visita) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_exp->bind_param("ssisssss", $dni_cliente, $bien_adquirido, $calificacion, $rango_costo, $lugar, $descripcion_exp, $tipo_de_viaje, $fecha_visita);
            $stmt_exp->execute();
            $stmt_exp->close();
        }

        // Insertar en Interacciones2 si es encuesta Interacciones
        if ($id_encuesta == 11) {
            $fecha_inter = trim($_POST["respuestas"][20] ?? null);
            $canal = trim($_POST["respuestas"][21] ?? "");
            $descripcion_int = trim($_POST["respuestas"][22] ?? "");

            $stmt_int = $conn->prepare("INSERT INTO interacciones2 (dni_cliente, fecha, canal, descripcion) VALUES (?, ?, ?, ?)");
            $stmt_int->bind_param("ssss", $dni_cliente, $fecha_inter, $canal, $descripcion_int);
            $stmt_int->execute();
            $stmt_int->close();
        }

        // Sumar puntos
        $stmt = $conn->prepare("SELECT puntos_encuesta FROM encuestas2 WHERE id_encuesta = ?");
        $stmt->bind_param("i", $id_encuesta);
        $stmt->execute();
        $stmt->bind_result($puntos_encuesta);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("UPDATE clientes2 SET puntos = puntos + ? WHERE dni_cliente = ?");
        $stmt->bind_param("is", $puntos_encuesta, $dni_cliente);
        $stmt->execute();
        $stmt->close();

        echo "
<script>
Swal.fire({
    icon: 'success',
    title: '¡Gracias!',
    text: 'Gracias por responder la encuesta.',
    confirmButtonText: 'Aceptar'
}).then(() => {
    window.location.href = 'encuentas.php';
});
</script>
";
    }
}

// --- Obtener encuestas y sus preguntas ---
$encuestas = [];
if ($logueado) {
    $sql_encuestas = "
        SELECT * FROM encuestas2 e
        WHERE NOT EXISTS (
            SELECT 1 FROM respuestas2 r
            WHERE r.id_encuesta = e.id_encuesta
            AND r.dni_cliente = ?
        )
    ";
    $stmt = $conn->prepare($sql_encuestas);
    $stmt->bind_param("s", $dni_cliente);
} else {
    $sql_encuestas = "SELECT * FROM encuestas2"; // mostrar todas si no está logueado
    $stmt = $conn->prepare($sql_encuestas);
}

$stmt->execute();
$result_encuestas = $stmt->get_result();

while ($encuesta = $result_encuestas->fetch_assoc()) {
    $id_encuesta = $encuesta["id_encuesta"];
    $sql_preguntas = "
        SELECT p.id_pregunta, p.pregunta 
        FROM preguntas2 p
        JOIN encuesta_pregunta2 ep ON p.id_pregunta = ep.id_pregunta
        WHERE ep.id_encuesta = ?
    ";
    $stmt2 = $conn->prepare($sql_preguntas);
    $stmt2->bind_param("i", $id_encuesta);
    $stmt2->execute();
    $result_preguntas = $stmt2->get_result();
    $preguntas = [];
    while ($row = $result_preguntas->fetch_assoc()) {
        $preguntas[] = $row;
    }
    $stmt2->close();

    $encuesta["preguntas"] = $preguntas;
    $encuestas[] = $encuesta;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abarrotes Yuly</title>
    <link rel="stylesheet" href="css/gym.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {

            background: #f0f0f0;

        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropdown-button:hover {
            background-color: #2980b9;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 180px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1;
            overflow: hidden;
            animation: fadeIn 0.3s ease-in-out;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.2s ease, padding-left 0.2s ease;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            padding-left: 24px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .top-bar {
            background-color: #f89406;
            color: white;
            text-align: center;
            padding: 8px 0;
            font-weight: bold;
        }

        /* Footer general */
        #main-footer .footer-widget img {
            width: 15px;
            /* cambia el tamaño */
            height: auto;
            /* mantiene la proporción */
        }

        #main-footer {
            background-color: #222;
            color: #fff;
            padding: 40px 0;
            font-family: Arial, sans-serif;
        }

        /* Contenedor de columnas */
        #footer-widgets {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Cada columna */
        .footer-widget {
            flex: 1;
            min-width: 200px;
        }

        /* Títulos */
        .footer-widget .title {
            color: #ff6600;
            /* naranja */
            font-size: 18px;
            margin-bottom: 15px;
        }

        /* Listas */
        .footer-widget ul {
            list-style: disc;
            margin: 0;
            padding-left: 20px;
        }

        .footer-widget ul li {
            margin-bottom: 8px;
        }

        .footer-widget ul li a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-widget ul li a:hover {
            color: #ff6600;
            /* hover en naranja */
        }

        /* Contacto */
        .footer-widget p,
        .footer-widget a {
            color: #ddd;
            font-size: 14px;
        }

        /* Botones */
        .wp-block-button__link {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            border: 2px solid #fff;
            background: transparent;
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .wp-block-button__link:hover {
            background: #ff6600;
            border-color: #ff6600;
            color: #fff;
        }

        /* Footer inferior */
        #footer-bottom {
            border-top: 1px solid #444;
            margin-top: 30px;
            padding-top: 15px;
            text-align: center;
            font-size: 13px;
            color: #aaa;
        }

        .et_pb_column .et_pb_blurb .et-pb-icon {
            font-size: 4px !important;
            /* Cambia el 24px al tamaño que prefieras */
        }
    </style>
</head>

<body>
    <div class="top-bar">
        🚚 Gana descuentos increíbles con tus puntos
    </div>

    <nav class="navbar navbar-expand-lg border-bottom border-body py-4 p-3" style="background-color: #f7f3ec;">
        <div class="container-fluid position-relative">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú principal -->
            <div class="collapse navbar-collapse nav justify-content-center" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item mx-5"><a class="nav-link M11" href="EncuestasInkarian.php">Inicio</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="servicios.php">Servicios</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="encuentas.php">Encuestas</a></li>
                </ul>
            </div>

            <!-- Logo -->
            <div class="redes position-absolute top-50 end+110 translate-middle-y pe-3">
                <img src="https://inkarian.com/wp-content/uploads/2023/03/Logo-web512x512.png"
                    class="img-fluid rounded-circle" alt="Logo Inkrian" style="width: 150px; height: 80px;">
            </div>

            <!-- Usuario -->
            <div class="position-absolute top-50 end-0 translate-middle-y pe-3 d-flex align-items-center">
                <?php if ($logueado): ?>
                    <!-- Dropdown de usuario -->
                    <div class="dropdown">
                        <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            👋 Hola, <?= htmlspecialchars($nombre) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Puntos: <?= htmlspecialchars($puntos_cliente ?? 0) ?></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="../app/controllers/cerrar_sesion.php">Cerrar
                                    sesión</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- Botones si no está logueado -->
                    <a href="../app/index.php" class="btn btn-outline-primary btn-sm me-2">Inicia sesión</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalRegistro"
                        class="btn btn-success btn-sm">Regístrate</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <?php if (!empty($encuestas)): ?>
            <h2 class="mb-4 text-center">Encuestas Disponibles</h2>
            <div class="accordion" id="accordionEncuestas">
                <?php foreach ($encuestas as $encuesta): ?>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="heading_<?= $encuesta["id_encuesta"] ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_<?= $encuesta["id_encuesta"] ?>" aria-expanded="false"
                                aria-controls="collapse_<?= $encuesta["id_encuesta"] ?>">
                                <?= htmlspecialchars($encuesta["nombre_encuesta"]) ?>
                            </button>
                        </h2>
                        <div id="collapse_<?= $encuesta["id_encuesta"] ?>" class="accordion-collapse collapse"
                            aria-labelledby="heading_<?= $encuesta["id_encuesta"] ?>" data-bs-parent="#accordionEncuestas">
                            <div class="accordion-body">
                                <p class="text-muted"><?= htmlspecialchars($encuesta["descripcion"]) ?></p>
                                <form method="POST">
                                    <input type="hidden" name="id_encuesta" value="<?= $encuesta["id_encuesta"] ?>">
                                    <?php foreach ($encuesta["preguntas"] as $pregunta): ?>
                                        <div class="mb-2">
                                            <label class="form-label"><?= htmlspecialchars($pregunta["pregunta"]) ?></label>
                                            <textarea class="form-control form-control-sm"
                                                name="respuestas[<?= $pregunta["id_pregunta"] ?>]" rows="2" required></textarea>
                                        </div>
                                    <?php endforeach; ?>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="container my-5">
                <div class="no-surveys-card text-center p-5 mx-auto"
                    style="max-width: 600px; border-radius: 25px; background: linear-gradient(135deg, #e0f7fa, #b2ebf2); box-shadow: 0 10px 25px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <div style="font-size: 50px; margin-bottom: 20px;">🎉</div>
                    <h3 class="fw-bold mb-3" style="color: #00796b;">¡Excelente!</h3>
                    <p class="lead mb-4" style="color: #004d40; line-height: 1.6;">
                        Has respondido todas las encuestas disponibles.<br>
                        Gracias por tu participación y por ayudarnos a mejorar nuestros servicios. 🌟
                    </p>
                    <span style="font-size: 2rem;">💬</span>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
<?php require_once("default/footer.php"); ?>

</html>