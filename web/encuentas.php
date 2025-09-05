<?php
require_once("default/auth.php");
if (!$logueado) {
    header("Location: ../index.php");
    exit;
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
        <h2 class="mb-4 text-center">Encuestas Disponibles</h2>
        <?php if (empty($encuestas)): ?>
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
<?php require_once("default/footer.php"); ?>

</html>