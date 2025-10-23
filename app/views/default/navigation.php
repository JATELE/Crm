<?php
// === Comprobación de licencia ===
require_once __DIR__ . '/../../models/conexion.php';

$conexionObj = new Conexion();
$conexionObj->conectar();
$conexion = $conexionObj->getConexion();

$consultaLicencia = $conexion->query("SELECT * FROM licencias WHERE usado = 1 LIMIT 1");
$licenciaActiva = $consultaLicencia->num_rows > 0;
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

<!-- Header -->
<header class="main-header">
  <!-- Logo -->
  <a href="dashboard.php" class="logo">
    <span class="logo-mini"><b>I'</b>A</span>
    <span class="logo-lg"><b>Inka'</b>Arian</span>
  </a>

  <!-- Navbar -->
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- Licencia -->
        <li class="nav-item" style="margin-top:12px; margin-right:10px;">
          <?php if ($licenciaActiva ?? false): ?>
            <span class="label label-success" style="font-size:13px; padding:5px 10px; border-radius:10px;">
              <i class="fa fa-star"></i> Versión PRO
            </span>
          <?php else: ?>
            <span class="label label-default" style="font-size:13px; padding:5px 10px; border-radius:10px;">
              <i class="fa fa-lock"></i> Versión Gratis
            </span>
          <?php endif; ?>
        </li>

        <!-- Notificaciones -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">
              <?= $total_clientes + $total_campanias + $total_encuestas ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">Tienes <?= $total_clientes + $total_campanias + $total_encuestas ?> notificaciones</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> <?= $total_clientes ?> clientes registrados
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-bullhorn text-green"></i> <?= $total_campanias ?> campañas activas
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-list text-yellow"></i> <?= $total_encuestas ?> encuestas creadas
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-check text-success"></i> <?= $total_respondieron ?> clientes respondieron encuestas
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-times text-red"></i> <?= $total_no_respondieron ?> clientes no respondieron
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="dashboard.php">Ver todas</a></li>
          </ul>
        </li>

        <!-- Usuario -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="html/dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />
            <span class="hidden-xs"><?= $nombre_usuario . " " . $apellido_usuario ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="html/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
              <p>
                <?= $nombre_usuario . " " . $apellido_usuario ?> - Web Developer
                <small>Miembro desde Nov. 2012</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Perfil</a>
              </div>
              <div class="pull-right">
                <a href="../controllers/cerrar_sesion.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>


<!-- Sidebar -->
<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Usuario -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="html/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p><?php echo $nombre_usuario . " " . $apellido_usuario; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a><br>
        <?php if ($licenciaActiva): ?>
          <small class="text-success"><i class="fa fa-star"></i> PRO</small>
        <?php else: ?>
          <small class="text-muted"><i class="fa fa-lock"></i> Gratis</small>
        <?php endif; ?>
      </div>
    </div>

    <!-- Menú lateral -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENÚ PRINCIPAL</li>

      <?php if ($privilegios_usuario == 1): ?>
        <li class="active">
          <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-user-plus"></i> <span>Clientes</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="panel_clientes.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
            <li><a href="listar_clientes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
            <li><a href="panel_clientes_consultas.php"><i class="fa fa-circle-o"></i> Consultas</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-cube"></i> <span>Campañas</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="panel_campaña_registrar.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
            <li><a href="panel_campaña_reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
            <li><a href="panel_promociones.php"><i class="fa fa-circle-o"></i> Promociones</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Encuestas</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="panel_encuesta_registrar.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
            <li><a href="panel_crear_encuesta.php"><i class="fa fa-circle-o"></i> Crear Encuesta</a></li>
            <li><a href="panel_usuarios_reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Usuarios</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="panel_usuarios_registrar.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
            <li><a href="panel_usuarios_reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
          </ul>
        </li>

      <?php else: ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-user-plus"></i> <span>Clientes</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="panel_clientes_registrar.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
            <li><a href="panel_clientes_reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
            <li><a href="panel_clientes_consultas.php"><i class="fa fa-circle-o"></i> Consultas</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-cube"></i> <span>Campañas</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="panel_campaña_registrar.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
            <li><a href="panel_campaña_reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
          </ul>
        </li>
      <?php endif; ?>
    </ul>
  </section>
</aside>