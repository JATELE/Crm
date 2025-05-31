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
require_once '../models/rol.php';
$rolModel = new Rol();
$roles = $rolModel->getLoginUsuario(); // trae todos los roles

$nombre_rol = '';
foreach ($roles as $r) {
  if ($r['id_rol'] == $_SESSION['usuario_sesion']['id_rol']) {
    $nombre_rol = $r['nombre_rol'];
    break;
  }
}

$conexion->cerrarConexion();
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Reporte de Clientes</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <!-- Incluir una vez todos los links -->
  <?php include_once("default/links-head.php") ?>
</head>


<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
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
                        <a href="#" class="btn btn-warning btn-sm btnEditarCliente" data-dni="<?= $cliente['dni'] ?>"
                          data-nombre="<?= $cliente['nombre'] ?>" data-telefono="<?= $cliente['telefono'] ?>"
                          data-direccion="<?= $cliente['direccion'] ?>" data-correo="<?= $cliente['correo'] ?>">
                          Editar
                          </a>

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
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal Editar Cliente</h4>
            </div>
            <div class="modal-body text-left">
              <!--  INICIO DE FORMULARIO -->
              <form action="#" method="post">
                <div class="mb-3">
                  <label for="dni" class="form-label">DNI</label>
                  <input type="text" disabled="true" readOnly class="form-control" id="dni" name="dni_c">
                </div>
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre_c">
                </div>
                <!-- CORREGIDO -->
                <div class="mb-3">
                  <label for="telefono" class="form-label">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono_c">
                </div>
                <div class="mb-3">
                  <label for="direccion" class="form-label">Dirección</label>
                  <input type="text" class="form-control" id="direccion" name="direccion_c">
                </div>

                <div class="mb-4 mt-3">
                  <label for="nombre" class="form-label">Correo electronico</label>
                  <input type="email" class="form-control" id="email" name="correo_c">
                </div>
              </form>
              <!--  FIN DE FORMULARIO-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger" id="btnEditarCliente">Confirmar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>
    <!-- Footer -->
    <?php require_once("default/footer.php"); ?>
  </div> <!-- FINAL DEL DIV DEL CONTENEDOR -->
  <!-- Todos los scripts -->
   <script src="../views/assets/js/reportes_clientes.js"></script>

  <?php require_once("default/links-script.php"); ?>
</body>

</html>