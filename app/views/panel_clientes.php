<?php
session_start();
$errores = $_SESSION['errores_registro'] ?? [];
$datos = $_SESSION['datos_registro'] ?? [];

if (isset($_SESSION["usuario_sesion"])) {
  $nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
  $apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
  $privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
} else {
  header("location: ../index.php");
  exit();
}

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
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Registro de clientes</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <?php include_once("default/links-head.php") ?>
  <style>
    .center-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper"> <!-- INICIO DEL DIV DEL CONTENEDOR -->
    <!-- Cabezera y Nav del lado izquierdo -->
    <?php require_once("default/navigation.php") ?>
    <!-- Content Wrapper - Contenido Principal-->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> Registro de clientes <small>Control panel</small> </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Registro Clientes</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="center-wrapper">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border text-center">
                <h3 class="box-title">Registrar Cliente</h3>
              </div>
              <form action="../controllers/ClienteController.php" method="post">
                <div class="box-body">
    <?php
    inputField("text", "dni_c", "DNI", $errores, $datos);
    inputField("text", "nombre_c", "Nombre", $errores, $datos);
    inputField("text", "apellidos_c", "Apellido", $errores, $datos);
    inputField("email", "correo_c", "Correo electronico", $errores, $datos);
    inputField("text", "telefono_c", "Telefono", $errores, $datos);
    inputField("text", "lugar_c", "Lugar de Nacimiento", $errores, $datos);
    inputField("date", "fecha_c", "Fecha de Nacimiento", $errores, $datos);
    inputField("text", "contraseña", "Contraseña ", $errores, $datos);
    ?>
    
    <input type="hidden" name="accion" value="registrar">

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
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Registrar
                  </button>
                  <button type="reset" class="btn btn-default">
                    <i class="fa fa-eraser"></i> Limpiar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </section>



    </div>
    <!-- Footer -->
    <?php require_once("default/footer.php"); ?>
  </div>
  <?php require_once("default/links-script.php"); ?>
</body>
<?php
unset($_SESSION['errores_registro']);
unset($_SESSION['datos_registro']);
?>

</html>