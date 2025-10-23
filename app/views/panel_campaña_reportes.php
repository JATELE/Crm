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
<div class="container my-5">

  <!-- Formulario en tarjeta elegante -->
  <div class="card shadow-sm rounded-4 border-0 mb-5">
    <div class="card-header bg-secondary text-white rounded-top-4 p-3">
      <h4 class="mb-0"><i class="bi bi-megaphone-fill"></i> Registrar Nueva Campaña</h4>
    </div>
    <div class="card-body p-4">
      <form action="../controllers/CampañaController.php" method="POST">
        <input type="hidden" name="accion" value="registrar">

        <div class="mb-3">
          <label for="nombre_campaña" class="form-label fw-semibold">Nombre de la Campaña</label>
          <input type="text" name="nombre_campaña" id="nombre_campaña" class="form-control form-control-lg shadow-sm" placeholder="Ingrese el nombre" required>
        </div>

        <div class="mb-3">
          <label for="descripcion" class="form-label fw-semibold">Descripción</label>
          <textarea name="descripcion" id="descripcion" class="form-control form-control-lg shadow-sm" rows="3" placeholder="Describa la campaña" required></textarea>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label for="fecha_inicio" class="form-label fw-semibold">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control form-control-lg shadow-sm" required>
          </div>
          <div class="col-md-6">
            <label for="fecha_fin" class="form-label fw-semibold">Fecha de Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg shadow-sm" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold">
          <i class="bi bi-plus-circle-fill"></i> Registrar Campaña
        </button>
      </form>
    </div>
  </div>

  <!-- Listado de campañas elegante -->
  <h4 class="mb-4 fw-semibold text-secondary"><i class="bi bi-card-list"></i> Campañas Activas</h4>
  <div class="row g-4">
    <?php foreach ($campañas as $c): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
          <div class="card-header bg-light text-dark">
            <h5 class="mb-0"><?= htmlspecialchars($c['nombre_campaña']) ?></h5>
          </div>
          <div class="card-body">
            <p class="card-text text-muted"><?= htmlspecialchars($c['descripcion']) ?></p>
            <p class="mb-1"><strong>Inicio:</strong> <?= htmlspecialchars($c['fecha_inicio']) ?></p>
            <p class="mb-3"><strong>Fin:</strong> <?= htmlspecialchars($c['fecha_fin']) ?></p>
            <div class="d-grid">
              <a href="../controllers/CampañaController.php?accion=eliminar&id=<?= $c['id_campaña'] ?>" 
                 class="btn btn-outline-danger fw-semibold" 
                 onclick="return confirm('¿Estás seguro de eliminar esta campaña?');">
                 <i class="bi bi-trash-fill"></i> Eliminar
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
  /* Efectos suaves */
  .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
  }

  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
  }
</style>

    </div>
    <?php require_once("default/footer.php"); ?>
  </div>
  <script src="../views/assets/js/reportes_campañas.js"></script>
  <?php require_once("default/links-script.php"); ?>
</body>
</html>
