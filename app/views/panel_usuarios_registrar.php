<?php
session_start();
if (!isset($_SESSION["usuario_sesion"])) {
  header("location: ../index.php");
  exit();
}
$nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
$apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
$privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Registrar Usuarios</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <?php include_once("default/links-head.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php require_once("default/navigation.php") ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>Registrar Usuarios <small>Panel de Control</small></h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Registrar Usuarios</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Formulario de Registro</h3>
              </div>
              <form action="../controllers/UsuarioController.php" method="POST">
                <input type="hidden" name="accion" value="registrar">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="id_rol">Rol:</label>
                    <select name="id_rol" class="form-control" required>
                      <option value="1">Administrador</option>
                      <option value="2">Empleado</option>
                      <!-- Agrega más roles si es necesario -->
                    </select>
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php require_once("default/footer.php"); ?>
  </div>

  <?php require_once("default/links-script.php"); ?>

  <?php
  if (isset($_SESSION['mensaje_usuario'])) {
    $mensaje = $_SESSION['mensaje_usuario'];
    echo "<script>
      Swal.fire({
        icon: '{$mensaje['tipo']}',
        title: '{$mensaje['titulo']}',
        text: '{$mensaje['texto']}',
        confirmButtonText: 'Aceptar'
      });
    </script>";
    unset($_SESSION['mensaje_usuario']);
  }
  ?>
</body>

</html>
