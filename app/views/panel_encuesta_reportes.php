<?php
session_start();
if (isset($_SESSION["usuario_sesion"])) {
  $nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
  $apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
  $privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
} else {
  header("location: ../index.php");
  exit();
}

require_once("../controllers/CampañaController.php");
$controller = new Campaña();
$campañas = $controller->listar_campaña();
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Reporte de Campañas</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <?php include_once("default/links-head.php") ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php require_once("default/navigation.php") ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1> Reportes Campaña <small>Control panel</small> </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Reportes Campaña</li>
        </ol>
      </section>
      <form action="../controllers/CampañaController.php" method="POST">
        <input type="hidden" name="accion" value="registrar">
        <div class="form-group">
          <label for="nombre_campaña">Nombre de la Campaña</label>
          <input type="text" name="nombre_campaña" id="nombre_campaña" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="fecha_inicio">Fecha de Inicio</label>
          <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="fecha_fin">Fecha de Fin</label>
          <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Campaña</button>
      </form>

      <hr>

      <!-- Tabla de campañas -->
      <h4 class="mt-4">Listado de Campañas</h4>
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($campañas as $c): ?>
            <tr>
              <td><?= htmlspecialchars($c['id_campaña']) ?></td>
              <td><?= htmlspecialchars($c['nombre_campaña']) ?></td>
              <td><?= htmlspecialchars($c['descripcion']) ?></td>
              <td><?= htmlspecialchars($c['fecha_inicio']) ?></td>
              <td><?= htmlspecialchars($c['fecha_fin']) ?></td>
              <td>
                <a href="../controllers/CampañaController.php?accion=eliminar&id=<?= $c['id_campaña'] ?>"
                  class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta campaña?');">
                  Eliminar
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        
      </table>
    </div>
    <?php require_once("default/footer.php"); ?>
  </div>
  <script src="../views/assets/js/reportes_campañas.js"></script>
  <?php require_once("default/links-script.php"); ?>
</body>
</html>
