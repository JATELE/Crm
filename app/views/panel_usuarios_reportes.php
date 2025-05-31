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

require_once '../models/conexion.php';
$conexion = new Conexion();
$conexion->conectar();

// Consulta usuarios con su rol
$sql = "SELECT 
          u.id_usuario, 
          u.nombre, 
          u.apellido, 
          u.usuario, 
          u.telefono, 
          u.estado,
          r.nombre_rol,
          u.id_rol
        FROM tb_usuario u
        LEFT JOIN tb_rol r ON u.id_rol = r.id_rol";

$resultado = $conexion->getEjecutionQuery($sql);
$usuarios = [];
if ($resultado && $resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
  }
}

// Consulta roles para el select
$roles = [];
$sqlRoles = "SELECT id_rol, nombre_rol FROM tb_rol ORDER BY nombre_rol ASC";
$resultadoRoles = $conexion->getConexion()->query($sqlRoles);
if ($resultadoRoles) {
  while ($fila = $resultadoRoles->fetch_assoc()) {
    $roles[] = $fila;
  }
} else {
  echo "Error al consultar roles: " . $conexion->getConexion()->error;
}

$conexion->cerrarConexion();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Reporte de Usuarios</title>
  <?php include_once("default/links-head.php") ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php require_once("default/navigation.php") ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Reportes Usuarios <small>Control panel</small></h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Reportes Usuarios</li>
        </ol>
      </section>

      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Usuarios Registrados</h3>
          </div>
          <div class="box-body table-responsive">
            <?php if (count($usuarios) > 0): ?>
              <table class="table table-bordered table-hover">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($usuarios as $u): ?>
                    <tr>
                      <td><?= $u['id_usuario'] ?></td>
                      <td><?= htmlspecialchars($u['nombre']) ?></td>
                      <td><?= htmlspecialchars($u['apellido']) ?></td>
                      <td><?= htmlspecialchars($u['usuario']) ?></td>
                      <td><?= htmlspecialchars($u['telefono']) ?></td>
                      <td><?= htmlspecialchars($u['nombre_rol']) ?></td>
                      <td><?= $u['estado'] ? 'Activo' : 'Inactivo' ?></td>
                      <td>
                        <a href="../controllers/UsuarioController.php?accion=eliminar&id_usuario=<?= $u['id_usuario'] ?>"
                          class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este usuario?');">Eliminar</a>

                        <a href="#" class="btn btn-warning btn-sm btnEditarUsuario" data-id="<?= $u['id_usuario'] ?>"
                          data-nombre="<?= htmlspecialchars($u['nombre'], ENT_QUOTES) ?>"
                          data-apellido="<?= htmlspecialchars($u['apellido'], ENT_QUOTES) ?>"
                          data-usuario="<?= htmlspecialchars($u['usuario'], ENT_QUOTES) ?>"
                          data-telefono="<?= htmlspecialchars($u['telefono'], ENT_QUOTES) ?>"
                          data-id_rol="<?= $u['id_rol'] ?>" data-estado="<?= $u['estado'] ?>">
                          Editar
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>No se encontraron usuarios.</p>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <form action="../controllers/UsuarioEditarController.php" method="post">
        <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Usuario</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" id="edit_id_usuario" name="id_usuario">

                <div class="form-group">
                  <label for="edit_nombre">Nombre</label>
                  <input type="text" class="form-control" id="edit_nombre" name="nombre">
                </div>

                <div class="form-group">
                  <label for="edit_apellido">Apellido</label>
                  <input type="text" class="form-control" id="edit_apellido" name="apellido">
                </div>

                <div class="form-group">
                  <label for="edit_usuario">Usuario</label>
                  <input type="text" class="form-control" id="edit_usuario" name="usuario">
                </div>

                <div class="form-group">
                  <label for="edit_telefono">Teléfono</label>
                  <input type="text" class="form-control" id="edit_telefono" name="telefono">
                </div>

                <div class="form-group">
                  <label for="edit_id_rol">Rol</label>
                  <select class="form-control" id="edit_id_rol" name="id_rol" required>
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $rol): ?>
                      <option value="<?= $rol['id_rol'] ?>"><?= htmlspecialchars($rol['nombre_rol']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="edit_estado">Estado</label>
                  <select class="form-control" id="edit_estado" name="estado">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <?php require_once("default/footer.php"); ?>
  </div>

  <script>
    document.querySelectorAll('.btnEditarUsuario').forEach(btn => {
      btn.addEventListener('click', function () {
        document.getElementById('edit_id_usuario').value = this.dataset.id;
        document.getElementById('edit_nombre').value = this.dataset.nombre;
        document.getElementById('edit_apellido').value = this.dataset.apellido;
        document.getElementById('edit_usuario').value = this.dataset.usuario;
        document.getElementById('edit_telefono').value = this.dataset.telefono;
        document.getElementById('edit_id_rol').value = this.dataset.id_rol;
        document.getElementById('edit_estado').value = this.dataset.estado;

        $('#modalEditarUsuario').modal('show');
      });
    });
  </script>

  <?php require_once("default/links-script.php"); ?>
</body>

</html>