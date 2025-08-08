<?php
session_start();
$errores = $_SESSION['errores_registro'] ?? [];
$datos = $_SESSION['datos_registro'] ?? [];

function inputField($type, $name, $label, $errores, $datos)
{
    $value = htmlspecialchars($datos[$name] ?? '');
    $isInvalid = isset($errores[$name]) ? 'is-invalid' : '';
    $errorMsg = $errores[$name] ?? '';

    echo "<div class='mb-3'>";
    echo "<label for='$name' class='form-label'>$label</label>";
    echo "<input type='$type' class='form-control $isInvalid' id='$name' name='$name' value='$value'>";
    if ($errorMsg) {
        echo "<div class='text-danger'>$errorMsg</div>";
    }
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre de la pagina</title>
    <link rel="stylesheet" href="../views/assets/css/gym2.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;400;600;800;900&display=swap');

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f6f5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        .contenedor {
            width: 100%;

            background-color: #f7f3ec;

            padding: 0px 20px;
        }

        .contenedor header {
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            flex-wrap: wrap;
        }

        .collapse navbar-collapse {
            justify-content: space-between;
            align-items: center;
        }

        .nav {
            flex: 1;
            text-align: center;
        }

        .nav a {
            display: inline-block;
            text-decoration: none;
            color: #000000;
            padding: 5px;
            text-transform: uppercase;
        }

        .nav a:hover {
            color: rgb(167, 126, 88);
        }


        .M11 {

            font-size: 15px;
            color: rgb(75, 153, 92);
            text-decoration: none;
            position: relative;
            padding-bottom: 15px;

            margin-right: -8px;
        }

        .top-bar {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 8px 0;
        }

        .whatsapp-icon {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 1000;
        }

        .whatsapp-icon img {
            width: 3vw;
            height: auto;
        }

        @media (max-width: 768px) {
            .whatsapp-icon img {
                width: 8vw;
            }
        }

        @media (max-width: 480px) {
            .whatsapp-icon img {
                width: 10vw;
            }
        }

        .whatsapp-icon:hover img {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <!-- Top bar -->
    <div class="top-bar">
        🚚 Gana descuentos increibles con tus puntos
    </div>

    <nav class="navbar navbar-expand-lg border-bottom border-body py-4 p-3" style="background-color: #f7f3ec;">
        <div class="container-fluid position-relative">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-center" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item mx-5"><a class="nav-link M11" href="../web/iniciotienda.php">Inicio</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="Abarrotes.php">Servicios</a></li>
                    <li class="nav-item mx-5"><a class="nav-link M11" href="Conocenos.php">Encuesta</a></li>
                </ul>
            </div>
            <div class="redes position-absolute top-50 end-0 translate-middle-y pe-3">
                <a class="nav-item mx-0" href="../app/index.php">Inicia Seccion</a>
                <a class="nav-item mx-0" href="../app/indexRegister.php">Registrate</a>
            </div>

        </div>

    </nav>
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Registro de Cliente</h5>
            </div>
            <div class="card-body">
                <form action="controllers/ClienteController.php" method="post">
                    <div class="box-body">
                        <?php
                        inputField("text", "dni_c", "DNI", $errores, $datos);
                        inputField("text", "nombre_c", "Nombre", $errores, $datos);
                        inputField("text", "apellidos_c", "Apellido", $errores, $datos);
                        inputField("email", "correo_c", "Correo electronico", $errores, $datos);
                        inputField("text", "contraseña", "Contraseña ", $errores, $datos);
                        inputField("text", "telefono_c", "Telefono", $errores, $datos);
                        inputField("text", "lugar_c", "Lugar de Nacimiento", $errores, $datos);
                        inputField("date", "fecha_c", "Fecha de Nacimiento", $errores, $datos);
                        ?>

                        <!-- Campo SELECT para Estado Civil -->
                        <div class="form-group">
                            <label for="estado_c">Estado Civil</label>
                            <select name="estado_c" id="estado_c" class="form-control">
                                <option value="">Seleccione una opción</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Conviviente">Conviviente</option>
                            </select>
                            <?php if (isset($errores['estado_c'])): ?>
                                <span class="text-danger"><?php echo $errores['estado_c']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="box-footer text-center">
                        <input type="hidden" name="accion" value="registrarte">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> registrarte
                        </button>
                        <button type="reset" class="btn btn-default">
                            <i class="fa fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="https://wa.me/51906328260" target="_blank" class="whatsapp-icon" id="whatsappIcon">
        <img src="https://img.icons8.com/?size=64&id=16713&format=png" alt="WhatsApp Icon">
    </a>
</body>
<?php
unset($_SESSION['errores_registro']);
unset($_SESSION['datos_registro']);
?>

</html>