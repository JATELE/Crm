<?php
session_start();
if (isset($_SESSION["usuario_sesion"])) {
  $nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
  $apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
  $privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
} else {
  header("location: ../index.php");
  // echo "No existe la sessión";
  // exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Registro de Campaña</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <!-- Incluir una vez todos los links -->
  <?php include_once("default/links-head.php") ?>
</head>
<style>
  select.form-select {
    max-height: 200px;
    overflow-y: auto;
  }
  .center-wrapper {
  display: flex;
  justify-content: center;
  padding: 20px;
}

</style>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper"> <!-- INICIO DEL DIV DEL CONTENEDOR -->
    <!-- Cabezera y Nav del lado izquierdo -->
    <?php require_once("default/navigation.php") ?>
    <!-- Content Wrapper - Contenido Principal-->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> Registro de Campaña <small>Control panel</small> </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Registro Campaña</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
  <div class="center-wrapper d-flex justify-content-center">
    <div class="col-md-6">
      <div class="box box-primary p-4">
        <div class="box-header with-border text-center mb-3">
          <h3 class="box-title">Registrar Campaña</h3>
        </div>
        <form action="../controllers/CampañaRegistrarController.php" method="post">
  <div class="box-body">
    <div class="form-group mb-3">
      <label for="nombre_campaña">Nombre de la Campaña</label>
      <input type="text" class="form-control" id="nombre_campaña" name="nombre_campaña" required>
    </div>
    <div class="form-group mb-3">
      <label for="descripcion">description</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" required>
    </div>
    <div class="form-group mb-3">
      <label for="fecha_inicio">Fecha de inicio</label>
      <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
    </div>
    <div class="form-group mb-3">
      <label for="fecha_fin">Fecha de fin</label>
      <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
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
  </div> <!-- FINAL DEL DIV DEL CONTENEDOR -->
  <!-- Todos los scripts -->

  <?php require_once("default/links-script.php"); ?>
</body>

</html>