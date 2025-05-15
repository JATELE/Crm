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

include_once __DIR__ . '/../models/conexion.php';


$conexion = new Conexion();
$conexion->conectar();

if ($conexion->getConexion()->connect_error) {
  die("Error de conexión: " . $conexion->getConexion()->connect_error);
}

$sql = "SELECT * FROM clientes";
$resultado = $conexion->getEjecutionQuery($sql);


if ($resultado->num_rows > 0) {

  $clientes = [];
  while ($row = $resultado->fetch_assoc()) {
    $clientes[] = $row;
  }
} else {
  $clientes = [];
}


$conexion->cerrarConexion();
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Clientes Registrados</title>
  <!-- Incluir todos los links de cabecera -->
  <?php include_once("default/links-head.php") ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper"> ->
    <?php require_once("default/navigation.php") ?>

    <div class="content-wrapper">
    
      <section class="content-header">
        <h1>Clientes Registrados</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Clientes Registrados</li>
        </ol>
      </section>
   
      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Clientes Registrados</h3>
          </div>
          <div class="box-body table-responsive">
            <?php if (count($clientes) > 0): ?>
              <table class="table table-bordered table-hover">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($clientes as $cliente): ?>
                    <tr>
                      <td><?= htmlspecialchars($cliente['dni']) ?></td>
                      <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                      <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                      <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                      <td><?= htmlspecialchars($cliente['correo']) ?></td>
                      <td>
                      





                        <a href="../controllers/ClienteController.php?accion=eliminar&dni=<?= $cliente['dni'] ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>No se encontraron clientes.</p>
            <?php endif; ?>
          </div>
        </div>
      </section>

    </div>
    
    <?php require_once("default/footer.php"); ?>
  </div> 
  <?php require_once("default/links-script.php"); ?>
</body>

</html>