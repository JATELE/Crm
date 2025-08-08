<?php
session_start();
if (isset($_SESSION["usuario_sesion"])) {
  $nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
  $apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
  $privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
} else {
  header("location: ../index.php");
  exit;
}

require_once("../models/conexion.php");

$conexionObj = new Conexion();
$conexionObj->conectar();
$conexion = $conexionObj->getConexion();

if (!$conexion) {
  die("Error: No se estableció la conexión correctamente.");
}

// Clientes registrados
$sql_clientes = "SELECT COUNT(*) AS total FROM clientes2";
$resultado_clientes = $conexion->query($sql_clientes);
$total_clientes = $resultado_clientes->fetch_assoc()['total'] ?? 0;

// Campañas registradas
$sql_campanias = "SELECT COUNT(*) AS total FROM campaña2";
$resultado_campanias = $conexion->query($sql_campanias);
$total_campanias = $resultado_campanias->fetch_assoc()['total'] ?? 0;

// Encuestas registradas
$sql_encuestas = "SELECT COUNT(*) AS total FROM encuestas2";
$resultado_encuestas = $conexion->query($sql_encuestas);
$total_encuestas = $resultado_encuestas->fetch_assoc()['total'] ?? 0;

// Gráfico de registros por fecha (montaña)
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

// Clientes que respondieron al menos una encuesta
$sql_respondieron = "SELECT COUNT(DISTINCT dni_cliente) as total FROM respuestas2";
$result_respondieron = $conexion->query($sql_respondieron);
$total_respondieron = $result_respondieron->fetch_assoc()['total'] ?? 0;

$total_no_respondieron = $total_clientes - $total_respondieron;
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <!-- Incluir una vez todos los links -->
  <?php include_once("default/links-head.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper"> <!-- INICIO DEL DIV DEL CONTENEDOR -->
    <!-- Cabezera y Nav del lado izquierdo -->
    <?php require_once("default/navigation.php") ?>
    <!-- Content Wrapper - Contenido Principal-->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> Dashboard <small>Control panel</small> </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $total_clientes; ?></h3>
              <p>Clientes registrados</p>
            </div>
            <div class="icon"><i class="ion ion-person-add"></i></div>
            <a href="listar_clientes.php" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $total_campanias; ?></h3>
              <p>Campañas registradas</p>
            </div>
            <div class="icon"><i class="ion ion-bag"></i></div>
            <a href="panel_campaña_reportes.php" class="small-box-footer">Ver más <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $total_encuestas; ?></h3>
              <p>Encuestas realizadas</p>
            </div>
            <div class="icon"><i class="ion ion-pie-graph"></i></div>
            <a href="panel_crear_encuesta.php" class="small-box-footer">Ver más <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <canvas id="clientesChart"></canvas>
          </div>
          <div class="col-md-6">
            <canvas id="encuestasChart"></canvas>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Gráfico tipo montaña: Clientes registrados por día -->
        <canvas id="clientesChart"></canvas>
        <script>
          const ctxClientes = document.getElementById('clientesChart').getContext('2d');
          const clientesChart = new Chart(ctxClientes, {
            type: 'line',
            data: {
              labels: <?= json_encode($fechas) ?>,
              datasets: [{
                label: 'Clientes registrados por día',
                data: <?= json_encode($totales_clientes) ?>,
                fill: true,
                tension: 0.4,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
              }]
            },
            options: {
              responsive: true,
              scales: {
                y: {
                  beginAtZero: true,
                  title: { display: true, text: 'Cantidad de clientes' }
                },
                x: {
                  title: { display: true, text: 'Fecha de registro' }
                }
              }
            }
          });
        </script>

        <!-- Gráfico de pastel: Clientes que respondieron y no -->
        <canvas id="encuestasChart"></canvas>
        <script>
          const ctxEncuestas = document.getElementById('encuestasChart').getContext('2d');
          const encuestasChart = new Chart(ctxEncuestas, {
            type: 'doughnut',
            data: {
              labels: ['Respondieron al menos una encuesta', 'No han respondido ninguna'],
              datasets: [{
                label: 'Participación de clientes',
                data: [<?= $total_respondieron ?>, <?= $total_no_respondieron ?>],
                backgroundColor: [
                  'rgba(54, 162, 235, 0.7)',
                  'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true
            }
          });
        </script>

      </section>
    </div>

    <!-- Footer -->
    <?php require_once("default/footer.php"); ?>
  </div> <!-- FINAL DEL DIV DEL CONTENEDOR -->
  <!-- Todos los scripts -->
  <?php require_once("default/links-script.php"); ?>
</body>

</html>