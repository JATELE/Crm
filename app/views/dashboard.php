<?php
session_start();
if (!isset($_SESSION["usuario_sesion"])) {
  header("location: ../index.php");
  exit;
}

$nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
$apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
$privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];

require_once("../models/conexion.php");
$conexionObj = new Conexion();
$conexionObj->conectar();
$conexion = $conexionObj->getConexion();

// Total clientes
$sql_clientes = "SELECT COUNT(*) AS total FROM clientes2";
$total_clientes = $conexion->query($sql_clientes)->fetch_assoc()['total'] ?? 0;

// Total campañas
$sql_campanias = "SELECT COUNT(*) AS total FROM campaña2";
$total_campanias = $conexion->query($sql_campanias)->fetch_assoc()['total'] ?? 0;

// Total encuestas
$sql_encuestas = "SELECT COUNT(*) AS total FROM encuestas2";
$total_encuestas = $conexion->query($sql_encuestas)->fetch_assoc()['total'] ?? 0;

// Clientes que respondieron
$sql_respondieron = "SELECT COUNT(DISTINCT dni_cliente) as total FROM respuestas2";
$total_respondieron = $conexion->query($sql_respondieron)->fetch_assoc()['total'] ?? 0;
$total_no_respondieron = $total_clientes - $total_respondieron;

// Evolución clientes por fecha
$fechas = [];
$totales_clientes = [];
$sql_registros = "SELECT DATE(fecha_registro) as fecha, COUNT(*) as total 
                  FROM clientes2 
                  GROUP BY DATE(fecha_registro) 
                  ORDER BY fecha ASC";
$resultado_registros = $conexion->query($sql_registros);
while ($row = $resultado_registros->fetch_assoc()) {
  $fechas[] = $row['fecha'];
  $totales_clientes[] = $row['total'];
}

// Distribución por estado civil
$estados = [];
$totales_estados = [];
$sql_estado = "SELECT estado_civil, COUNT(*) as total FROM clientes2 GROUP BY estado_civil";
$res_estado = $conexion->query($sql_estado);
while ($row = $res_estado->fetch_assoc()) {
  $estados[] = $row['estado_civil'];
  $totales_estados[] = $row['total'];
}

// Encuestas por campaña
$campanias = [];
$totales_encuestas = [];
$sql_camp_enc = "SELECT c.nombre_campaña, COUNT(e.id_encuesta) as total
                 FROM campaña2 c 
                 LEFT JOIN encuestas2 e ON c.id_campaña = e.id_campaña
                 GROUP BY c.id_campaña";
$res_camp_enc = $conexion->query($sql_camp_enc);
while ($row = $res_camp_enc->fetch_assoc()) {
  $campanias[] = $row['nombre_campaña'];
  $totales_encuestas[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard CRM</title>
  <?php include_once("default/links-head.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
  .chart-container {
    position: relative;
    height: 280px;   /* controla la altura */
    width: 100%;
    margin-bottom: 20px;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include_once("default/navigation.php"); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Dashboard <small>Panel de control</small></h1>
    </section>

    <section class="content">
      <!-- Cajas resumen -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner"><h3><?= $total_clientes ?></h3><p>Clientes</p></div>
            <div class="icon"><i class="ion ion-person"></i></div>
            <a href="listar_clientes.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner"><h3><?= $total_campanias ?></h3><p>Campañas</p></div>
            <div class="icon"><i class="ion ion-bag"></i></div>
            <a href="panel_campaña_reportes.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner"><h3><?= $total_encuestas ?></h3><p>Encuestas</p></div>
            <div class="icon"><i class="ion ion-pie-graph"></i></div>
            <a href="panel_crear_encuesta.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner"><h3><?= $total_respondieron ?></h3><p>Clientes con encuestas</p></div>
            <div class="icon"><i class="ion ion-checkmark"></i></div>
            <a href="#" class="small-box-footer">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
  <div class="col-md-6">
    <div class="chart-container">
      <canvas id="clientesChart"></canvas>
    </div>
  </div>
  <div class="col-md-6">
    <div class="chart-container">
      <canvas id="encuestasChart"></canvas>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="chart-container">
      <canvas id="estadoChart"></canvas>
    </div>
  </div>
  <div class="col-md-6">
    <div class="chart-container">
      <canvas id="campaniasChart"></canvas>
    </div>
  </div>
</div>
</section>
</div>

<?php include_once("default/footer.php"); ?>
</div>

<?php include_once("default/links-script.php"); ?>

<script>
  // Clientes registrados por fecha
  new Chart(document.getElementById('clientesChart'), {
    type: 'line',
    data: {
      labels: <?= json_encode($fechas) ?>,
      datasets: [{
        label: 'Clientes registrados',
        data: <?= json_encode($totales_clientes) ?>,
        fill: true,
        tension: 0.4,
        backgroundColor: 'rgba(75,192,192,0.2)',
        borderColor: 'rgba(75,192,192,1)',
        borderWidth: 2
      }]
    },
    options: { 
      responsive: true, 
      maintainAspectRatio: false 
    }
  });

  // Clientes que respondieron vs no
  new Chart(document.getElementById('encuestasChart'), {
    type: 'doughnut',
    data: {
      labels: ['Respondieron', 'No respondieron'],
      datasets: [{
        data: [<?= $total_respondieron ?>, <?= $total_no_respondieron ?>],
        backgroundColor: ['rgba(54,162,235,0.7)','rgba(255,99,132,0.7)'],
        borderColor: ['rgba(54,162,235,1)','rgba(255,99,132,1)'],
        borderWidth: 1
      }]
    },
    options: { 
      responsive: true, 
      maintainAspectRatio: false 
    }
  });

  // Distribución por estado civil
  new Chart(document.getElementById('estadoChart'), {
    type: 'pie',
    data: {
      labels: <?= json_encode($estados) ?>,
      datasets: [{
        data: <?= json_encode($totales_estados) ?>,
        backgroundColor: ['#f39c12','#00a65a','#3c8dbc','#d81b60','#605ca8']
      }]
    },
    options: { 
      responsive: true, 
      maintainAspectRatio: false 
    }
  });

  // Encuestas por campaña
  new Chart(document.getElementById('campaniasChart'), {
    type: 'bar',
    data: {
      labels: <?= json_encode($campanias) ?>,
      datasets: [{
        label: 'Encuestas por campaña',
        data: <?= json_encode($totales_encuestas) ?>,
        backgroundColor: 'rgba(153,102,255,0.7)',
        borderColor: 'rgba(153,102,255,1)',
        borderWidth: 1
      }]
    },
    options: { 
      responsive: true, 
      maintainAspectRatio: false, 
      scales: { y: { beginAtZero: true } } 
    }
  });
</script>
</body>
</html>
