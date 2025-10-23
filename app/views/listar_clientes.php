<?php
session_start();
$errores = $_SESSION['errores_registro'] ?? [];
$datos = $_SESSION['datos_registro'] ?? [];

if (!isset($_SESSION["usuario_sesion"])) {
  header("location: ../index.php");
  exit();
}

$nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
$apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
$privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];

include_once __DIR__ . '/../models/conexion.php';
$conexion = new Conexion();
$conexion->conectar();

if ($conexion->getConexion()->connect_error) {
  die("Error de conexión: " . $conexion->getConexion()->connect_error);
}

// 🔹 Obtener lista de clientes
$sql = "SELECT * FROM clientes2";
$resultado = $conexion->getEjecutionQuery($sql);
$clientes = ($resultado->num_rows > 0) ? $resultado->fetch_all(MYSQLI_ASSOC) : [];

// 🔹 Obtener los DNIs que ya respondieron alguna encuesta
$sqlRespuestas = "SELECT DISTINCT dni_cliente FROM respuestas2";
$res = $conexion->getEjecutionQuery($sqlRespuestas);
$respondieron = [];
if ($res->num_rows > 0) {
  while ($r = $res->fetch_assoc()) {
    $respondieron[] = $r['dni_cliente'];
  }
}

require_once '../models/rol.php';
$rolModel = new Rol();
$roles = $rolModel->getLoginUsuario();
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
  <title>Clientes y Reportes</title>
  <?php include_once("default/links-head.php") ?>
  <style>
    .scroll-box {
      max-height: 400px;
      overflow-y: auto;
    }

    .status-icon {
      font-size: 18px;
      margin-left: 6px;
    }

    .respondio {
      color: green;
    }

    .no-respondio {
      color: gray;
    }

    .table th {
      text-align: center;
    }

    .table td {
      vertical-align: middle;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php require_once("default/navigation.php") ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Clientes y Reportes</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Clientes y Reportes</li>
        </ol>
      </section>

      <!-- ==================== LISTADO DE CLIENTES ==================== -->
      <section class="content p-4">
        <div class="box border border-primary rounded p-3">
          <div class="box-header with-border mb-3">
            <h3 class="box-title">Clientes Registrados</h3>
          </div>
          <div class="box-body table-responsive scroll-box">
            <?php if (count($clientes) > 0): ?>
              <?php if (isset($_GET['error']) && $_GET['error'] === 'relacion'): ?>
                <div class="alert alert-danger">
                  ⚠️ No puedes eliminar este cliente porque ya respondió una encuesta.
                </div>
              <?php endif; ?>

              <?php if (isset($_GET['msg']) && $_GET['msg'] === 'eliminado'): ?>
                <div class="alert alert-success">
                  ✅ Cliente eliminado correctamente.
                </div>
              <?php endif; ?>

              <table class="table table-bordered table-hover text-center">
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
                    <th>Puntos</th>
                    <th>Encuesta</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($clientes as $cliente): 
                    $respondio = in_array($cliente['dni_cliente'], $respondieron);
                  ?>
                    <tr>
                      <td><?= htmlspecialchars($cliente['dni_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['nombres_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['apellidos_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['correo_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['telefono_cliente']) ?></td>
                      <td><?= htmlspecialchars($cliente['lugar_nacimiento']) ?></td>
                      <td><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></td>
                      <td><?= htmlspecialchars($cliente['estado_civil']) ?></td>
                      <td><?= htmlspecialchars($cliente['puntos']) ?></td>

                      <!-- 🔹 Indicador visual de si respondió -->
                      <td>
                        <?php if ($respondio): ?>
                          <i class="fa fa-check-circle respondio status-icon" title="Ya respondió encuesta"></i>
                        <?php else: ?>
                          <i class="fa fa-times-circle no-respondio status-icon" title="No ha respondido encuesta"></i>
                        <?php endif; ?>
                      </td>

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
                          data-lugar="<?= $cliente['lugar_nacimiento'] ?>"
                          data-fecha="<?= $cliente['fecha_nacimiento'] ?>"
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

      <!-- ==================== MODAL EDITAR CLIENTE ==================== -->
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
                  <input type="date" class="form-control" name="fecha_c" id="fecha_nacimiento">
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
    <?php require_once("default/footer.php"); ?>
  </div>

  <?php require_once("default/links-script.php"); ?>

  <!-- 🧩 SCRIPT PARA LLENAR EL MODAL -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const botonesEditar = document.querySelectorAll('.btnEditarCliente');

    botonesEditar.forEach(boton => {
      boton.addEventListener('click', function() {
        document.getElementById('edit_dni').value = this.dataset.dni;
        document.getElementById('dni_cliente').value = this.dataset.dni;
        document.getElementById('nombres_cliente').value = this.dataset.nombres;
        document.getElementById('apellidos_cliente').value = this.dataset.apellidos;
        document.getElementById('correo_cliente').value = this.dataset.correo;
        document.getElementById('telefono_cliente').value = this.dataset.telefono;
        document.getElementById('lugar_nacimiento').value = this.dataset.lugar;
        document.getElementById('fecha_nacimiento').value = this.dataset.fecha;
        document.getElementById('estado_c').value = this.dataset.estado;
      });
    });
  });
  </script>

</body>
</html>
