<?php
session_start();

if (!isset($_SESSION["cliente_sesion"])) {
    header("Location: ../index.php");
    exit;
}

$nombre = $_SESSION["cliente_sesion"]["nombre"];
$apellido = $_SESSION["cliente_sesion"]["apellido"];
$dni_cliente = $_SESSION["cliente_sesion"]["dni"];

require_once "../app/models/conexion.php";
$con = new Conexion();
$con->conectar();
$conn = $con->getConexion();

// Obtener puntos actuales del cliente
$stmt = $conn->prepare("SELECT puntos FROM clientes2 WHERE dni_cliente = ?");
$stmt->bind_param("s", $dni_cliente);
$stmt->execute();
$stmt->bind_result($puntos_cliente);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_encuesta"])) {
    $id_encuesta = intval($_POST["id_encuesta"]);
    $fecha = date("Y-m-d");

    // Verificar si el cliente ya respondió esta encuesta
    $stmt = $conn->prepare("SELECT 1 FROM respuestas2 WHERE dni_cliente = ? AND id_encuesta = ? LIMIT 1");
    $stmt->bind_param("si", $dni_cliente, $id_encuesta);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Ya has respondido esta encuesta.'); window.location.href='encuentas.php';</script>";
        exit;
    }
    $stmt->close();

    // Guardar respuestas
    if (isset($_POST["respuestas"]) && is_array($_POST["respuestas"])) {
        foreach ($_POST["respuestas"] as $id_pregunta => $respuesta) {
            $respuesta = trim($respuesta);
            if ($respuesta !== "") {
                $stmt = $conn->prepare("INSERT INTO respuestas2 (id_encuesta, id_pregunta, dni_cliente, respuesta, fecha_respuesta) 
                                        VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iisss", $id_encuesta, $id_pregunta, $dni_cliente, $respuesta, $fecha);
                $stmt->execute();
            }
        }
    }

    // Obtener los puntos que vale la encuesta
    $stmt = $conn->prepare("SELECT puntos_encuesta FROM encuestas2 WHERE id_encuesta = ?");
    $stmt->bind_param("i", $id_encuesta);
    $stmt->execute();
    $stmt->bind_result($puntos_encuesta);
    $stmt->fetch();
    $stmt->close();

    // Sumar los puntos al cliente
    $stmt = $conn->prepare("UPDATE clientes2 SET puntos = puntos + ? WHERE dni_cliente = ?");
    $stmt->bind_param("is", $puntos_encuesta, $dni_cliente);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('¡Gracias por responder la encuesta!'); window.location.href='encuentas.php';</script>";
    exit;
}

// Obtener encuestas NO respondidas por el cliente
$encuestas = [];
$sql_encuestas = "
    SELECT * FROM encuestas2
    WHERE id_encuesta NOT IN (
        SELECT DISTINCT id_encuesta
        FROM respuestas2
        WHERE dni_cliente = '$dni_cliente'
    )
";
$result_encuestas = $conn->query($sql_encuestas);

if ($result_encuestas && $result_encuestas->num_rows > 0) {
    while ($encuesta = $result_encuestas->fetch_assoc()) {
        $id_encuesta = $encuesta["id_encuesta"];
        $sql_preguntas = "
            SELECT p.id_pregunta, p.pregunta 
            FROM preguntas2 p
            JOIN encuesta_pregunta2 ep ON p.id_pregunta = ep.id_pregunta
            WHERE ep.id_encuesta = $id_encuesta
        ";
        $result_preguntas = $conn->query($sql_preguntas);
        $preguntas = [];
        while ($row = $result_preguntas->fetch_assoc()) {
            $preguntas[] = $row;
        }
        $encuesta["preguntas"] = $preguntas;
        $encuestas[] = $encuesta;
    }
}
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
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 8px 0;
            font-weight: bold;
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
            <div class="collapse navbar-collapse nav justify-content-center" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item mx-5"><a class="nav-link M11" href="iniciotienda2.php">Inicio</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="servicios.php">Servicios</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="encuestas.php">Encuesta</a></li>
                </ul>
            </div>
            <div class="redes position-absolute top-50 end 0 translate-middle-y pe-3">
                <a class="nav-item mx-0">logo</a>
            </div>
            <div class="dropdown">
                <button class="dropdown-button">👤 Mi cuenta</button>
                <div class="dropdown-content">
                    <a href="#">Perfil</a>
                    <a href="#">Puntos: <?= htmlspecialchars($puntos_cliente) ?></a>
                    <a href="../app/controllers/cerrar_sesion.php">Cerrar sesión</a>
                </div>
            </div>

        </div>
    </nav>
    <div class="container my-5">
        <h2 class="mb-4 text-center">Encuestas Disponibles</h2>
        <?php if (empty($encuestas)): ?>
            <div class="alert alert-info text-center">
                ¡Ya respondiste todas las encuestas disponibles!
            </div>
        <?php endif; ?>
        <div class="row">
            <?php foreach ($encuestas as $encuesta): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= htmlspecialchars($encuesta["nombre_encuesta"]) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($encuesta["descripcion"]) ?></p>
                            <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse"
                                data-bs-target="#form_<?= $encuesta["id_encuesta"] ?>" aria-expanded="false"
                                aria-controls="form_<?= $encuesta["id_encuesta"] ?>">
                                Responder
                            </button>

                            <div class="collapse mt-3" id="form_<?= $encuesta["id_encuesta"] ?>">
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
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>