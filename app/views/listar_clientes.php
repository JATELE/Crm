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

$sql = "SELECT * FROM clientes2";
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
   <style>
    .scroll-box {
      max-height: 400px; /* Puedes ajustar esta altura */
      overflow-y: auto;
    }
  </style>
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
      <section class="content p-4">
        <div class="box border border-primary rounded p-3">
          <div class="box-header with-border mb-3">
            <h3 class="box-title">Clientes Registrados</h3>
          </div>
          <div class="box-body table-responsive scroll-box">
            <?php if (count($clientes) > 0): ?>
              <table class="table table-bordered table-hover">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Lugar de Nacimiento</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Estado Civil</th>
                    <th>Contraseña</th>
                    <th>Puntos</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($clientes as $cliente): ?>
                    <tr>
                      <td><?= htmlspecialchars($cliente['dni_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['nombres_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['apellidos_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['correo_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['telefono_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['lugar_nacimiento']) ?></td>
                      <td><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></td>
                      <td><?= htmlspecialchars($cliente['estado_civil']) ?></td>
                      <td><?= htmlspecialchars($cliente['password_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['puntos']) ?></td>
                      <td>
                        <a href="../controllers/ClienteController.php?accion=eliminar&dni=<?= $cliente['dni_cliente'] ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                        <a href="#" class="btn btn-warning btn-sm btnEditarCliente" data-bs-toggle="modal"
                          data-bs-target="#modalEditarCliente" data-dni="<?= $cliente['dni_cliente'] ?>"
                          data-nombres="<?= $cliente['nombres_cliente'] ?>"
                          data-apellidos="<?= $cliente['apellidos_cliente'] ?>"
                          data-correo="<?= $cliente['correo_cliente'] ?>"
                          data-telefono="<?= $cliente['telefono_cliente'] ?>"
                          data-lugar="<?= $cliente['lugar_nacimiento'] ?>" data-fecha="<?= $cliente['fecha_nacimiento'] ?>"
                          data-estado="<?= $cliente['estado_civil'] ?>">
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
      <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <form action="../controllers/ClienteController.php" method="POST">
            <input type="hidden" name="accion" value="actualizar">
            <input type="hidden" name="dni_original" id="dni_cliente">

            <input type="hidden" name="dni_cliente" id="edit_dni">

            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombres</label>
                  <input type="text" class="form-control" name="nombre_c" id="nombres_cliente">
                </div>
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" name="apellidos_c" id="apellidos_cliente">
                </div>
                <div class="form-group">
                  <label>Correo</label>
                  <input type="email" class="form-control" name="correo_c" id="correo_cliente">
                </div>
                <div class="form-group">
                  <label>Teléfono</label>
                  <input type="text" class="form-control" name="telefono_c" id="telefono_cliente">
                </div>
                <div class="form-group">
                  <label>Lugar de nacimiento</label>
                  <input type="text" class="form-control" name="lugar_c" id="lugar_nacimiento">
                </div>
                <div class="form-group">
                  <label>Fecha de nacimiento</label>
                  <input type="date" class="form-control" name="fecha_c" id="lugar_nacimiento">
                </div>
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
                    <span class="text-danger"><?php echo $errores['estados_c']; ?></span>
                  <?php endif; ?>
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              </div>
            </div>
          </form>
        </div>
      </div>


    </div>
    <!-- Footer -->
    <?php require_once("default/footer.php"); ?>
  </div> <!-- FINAL DEL DIV DEL CONTENEDOR -->
  <!-- Todos los scripts -->
  <script src="../views/assets/js/reportes_clientes.js"></script>

  <?php require_once("default/links-script.php"); ?>
</body>

</html>