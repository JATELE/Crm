<?php
require_once("default/auth.php");
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_encuesta"])) {
    $id_encuesta = intval($_POST["id_encuesta"]);
    $fecha = date("Y-m-d");

    if ($logueado) {
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
    if (isset($_POST["respuestas"]) && is_array($_POST["respuestas"])) {

        foreach ($_POST["respuestas"] as $id_pregunta => $respuesta) {
            $respuesta = trim($respuesta);
            if ($respuesta !== "") {
                $stmt = $conn->prepare("INSERT INTO respuestas2 (id_encuesta, id_pregunta, dni_cliente, respuesta, fecha_respuesta) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iisss", $id_encuesta, $id_pregunta, $dni_cliente, $respuesta, $fecha);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Lógica específica según la encuesta
        if ($id_encuesta == 1) { // Deseo
            $destino = trim($_POST["respuestas"][1] ?? "");
            $presupuesto = floatval($_POST["respuestas"][2] ?? 0);
            $tiempo = trim($_POST["respuestas"][3] ?? "");

            $stmt_deseo = $conn->prepare("INSERT INTO deseo2 (dni_cliente, destino, peso_indicador, presupuesto_estimado, tiempo_estimado) VALUES (?, ?, ?, ?, ?)");
            $peso_indicador = 0; // opcional
            $stmt_deseo->bind_param("ssdds", $dni_cliente, $destino, $peso_indicador, $presupuesto, $tiempo);
            $stmt_deseo->execute();
            $stmt_deseo->close();
        }

        if ($id_encuesta == 2) { // Experiencia
            $bien_adquirido = trim($_POST["respuestas"][4] ?? "");
            $calificacion = intval($_POST["respuestas"][5] ?? 0);
            $lugar = trim($_POST["respuestas"][6] ?? "");
            $descripcion = trim($_POST["respuestas"][7] ?? "");
            $tipo = trim($_POST["respuestas"][8] ?? "");
            $fecha_visita = trim($_POST["respuestas"][9] ?? null);

            $stmt_exp = $conn->prepare("INSERT INTO experiencia2 (dni_cliente, bien_adquirido, calificacion, rango_costo, lugar, descripcion, tipo_de_viaje, fecha_visita) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $rango_costo = ""; // opcional
            $stmt_exp->bind_param("ssisssss", $dni_cliente, $bien_adquirido, $calificacion, $rango_costo, $lugar, $descripcion, $tipo, $fecha_visita);
            $stmt_exp->execute();
            $stmt_exp->close();
        }

        if ($id_encuesta == 3) { // Interacciones
            $fecha_inter = trim($_POST["respuestas"][10] ?? null);
            $canal = trim($_POST["respuestas"][11] ?? "");
            $descripcion_int = trim($_POST["respuestas"][12] ?? "");

            $stmt_int = $conn->prepare("INSERT INTO interacciones2 (dni_cliente, fecha, canal, descripcion) VALUES (?, ?, ?, ?)");
            $stmt_int->bind_param("ssss", $dni_cliente, $fecha_inter, $canal, $descripcion_int);
            $stmt_int->execute();
            $stmt_int->close();
        }
    }
}

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
    $sql_encuestas = "SELECT * FROM encuestas2";
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
        html,
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* BODY */
        body {
            background: #f0f0f0;
        }

        .container {
            flex: 1;
        }

        /* FOOTER */
        #main-footer {
            background-color: #222;
            color: #fff;
            padding: 40px 0;
            font-family: Arial, sans-serif;
            margin-top: auto;
        }

        /* DROPDOWN */
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

        /* BARRA SUPERIOR */
        .top-bar {
            background: linear-gradient(90deg, #f38c47ff, #1dd1a1, #54a0ff);
            background-size: 400% 400%;
            animation: moveGradient 8s ease infinite;
            overflow: hidden;
            white-space: nowrap;
            padding: 10px 0;
            position: relative;
            font-size: 1.1rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 0 6px rgba(0, 0, 0, 0.4);
        }

        @keyframes moveGradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .moving-text {
            display: inline-block;
            padding-left: 100%;
            animation: moveText 18s linear infinite;
        }

        @keyframes moveText {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .highlight {
            color: #fff;
            text-shadow: 0 0 10px #fff, 0 0 20px #ffe066;
        }

        /* FOOTER WIDGETS */
        #main-footer .footer-widget img {
            width: 15px;
            height: auto;
        }

        #footer-widgets {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-widget {
            flex: 1;
            min-width: 200px;
        }

        .footer-widget .title {
            color: #ff6600;
            font-size: 18px;
            margin-bottom: 15px;
        }

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
        }

        .footer-widget p,
        .footer-widget a {
            color: #ddd;
            font-size: 14px;
        }

        /* BOTÓNES */
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

        #footer-bottom {
            border-top: 1px solid #444;
            margin-top: 30px;
            padding-top: 15px;
            text-align: center;
            font-size: 13px;
            color: #aaa;
        }

        /* ========== ACORDEÓN ========== */

        .modern-accordion {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .accordion-item-modern {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e5e5;
            overflow: visible;
        }

        .accordion-header-modern {
            width: 100%;
            background: #f7f9fc;
            padding: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .accordion-header-modern:hover {
            background: #eef2f7;
        }

        .accordion-header-modern .icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .accordion-header-modern .arrow {
            transition: transform 0.3s ease;
        }

        .accordion-header-modern.active .arrow {
            transform: rotate(180deg);
        }

        .accordion-body-modern {
            max-height: none;
            overflow: visible;
            background: #ffffff;
            padding: 0 20px;
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease, padding 0.3s ease;
            height: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        .accordion-body-modern.open {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
            height: auto;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        /* Por si algún card corta contenido */
        .question-card,
        .question-input {
            overflow: visible;
        }

        /* PREGUNTAS */
        .question-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }

        .question-card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .question-input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #fafafa;
        }

        /* BOTÓN ENVIAR */
        .submit-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .survey-submit-modern {
            width: 250px;
            padding: 12px;
            border-radius: 12px;
            background: linear-gradient(135deg, #4facfe, #00c6ff);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div class="top-bar">
        <div class="moving-text">
            🚚 ¡Gana <span class="highlight">descuentos increíbles</span> con tus puntos! 🎁
            🚀 Canjea y ahorra en tus compras favoritas 💳
        </div>
    </div>

    <nav class="navbar navbar-expand-lg border-bottom border-body py-4 p-3" style="background-color: #f7f3ec;">
        <div class="container-fluid position-relative">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-center" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item mx-5"><a class="nav-link M11" href="EncuestasInkarian.php">Inicio</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="servicios.php">Servicios</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="encuentas.php">Encuestas</a></li>
                </ul>
            </div>
            <div class="redes position-absolute top-50 end+110 translate-middle-y pe-3">
                <img src="https://inkarian.com/wp-content/uploads/2023/03/Logo-web512x512.png"
                    class="img-fluid rounded-circle" alt="Logo Inkrian" style="width: 150px; height: 80px;">
            </div>
            <div class="position-absolute top-50 end-0 translate-middle-y pe-3 d-flex align-items-center">
                <?php if ($logueado): ?>
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
            <div class="modern-accordion">
                <?php foreach ($encuestas as $encuesta): ?>
                    <div class="accordion-item-modern">

                        <!-- Título -->
                        <button class="accordion-header-modern" type="button">
                            <span class="icon">📋</span>
                            <span class="title"><?= htmlspecialchars($encuesta["nombre_encuesta"]) ?></span>
                            <span class="arrow">⌄</span>
                        </button>

                        <!-- Contenido -->
                        <div class="accordion-body-modern">
                            <p class="desc"><?= htmlspecialchars($encuesta["descripcion"]) ?></p>

                            <form method="POST" class="survey-form-modern">
                                <input type="hidden" name="id_encuesta" value="<?= $encuesta["id_encuesta"] ?>">

                                <div class="question-grid">
                                    <?php foreach ($encuesta["preguntas"] as $pregunta): ?>
                                        <div class="question-card">
                                            <label><?= htmlspecialchars($pregunta["pregunta"]) ?></label>
                                            <textarea
                                                class="question-input"
                                                name="respuestas[<?= $pregunta["id_pregunta"] ?>]"
                                                rows="2" required></textarea>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="submit-wrapper">
                                    <button type="submit" class="survey-submit-modern">Enviar respuestas ✨</button>
                                </div>

                            </form>

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
    <script>
        document.querySelectorAll(".accordion-header-modern").forEach(header => {
            header.addEventListener("click", function() {
                const body = this.nextElementSibling;

                this.classList.toggle("active");
                body.classList.toggle("open");
            });
        });
    </script>

</body>
<?php require_once("default/footer.php"); ?>

</html>