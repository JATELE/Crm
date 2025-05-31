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

// Consulta productos con categoría
$sql = "SELECT 
          p.id_producto, 
          p.nombre, 
          p.descripcion, 
          p.precio, 
          p.stock, 
          c.nombre AS nombre_categoria
        FROM productos p 
        LEFT JOIN categorias c ON p.id_categoria = c.id_categoria";

$resultado = $conexion->getEjecutionQuery($sql);

$productos = [];
if ($resultado && $resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    $productos[] = $row;
  }
}

// Consulta categorías para el select
$categorias = [];
$sqlCategorias = "SELECT id_categoria, nombre FROM categorias ORDER BY nombre ASC";
$resultadoCategorias = $conexion->getConexion()->query($sqlCategorias);

if ($resultadoCategorias) {
  while ($fila = $resultadoCategorias->fetch_assoc()) {
    $categorias[] = $fila;
  }
} else {
  echo "Error al consultar categorías: " . $conexion->getConexion()->error;
}

// Ahora sí cierro la conexión
$conexion->cerrarConexion();
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Reporte de Productos</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <?php include_once("default/links-head.php") ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php require_once("default/navigation.php") ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1> Reportes Productos <small>Control panel</small> </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Reportes Productos</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Productos Registrados</h3>
              </div>
              <div class="box-body table-responsive">
                <?php if (count($productos) > 0): ?>
                  <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($productos as $producto): ?>
                        <tr>
                          <td><?= htmlspecialchars($producto['id_producto']) ?></td>
                          <td><?= htmlspecialchars($producto['nombre']) ?></td>
                          <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                          <td><?= htmlspecialchars($producto['precio']) ?></td>
                          <td><?= htmlspecialchars($producto['stock']) ?></td>
                          <td><?= htmlspecialchars($producto['nombre_categoria']) ?></td>
                          <td>
                            <a href="../controllers/ProduController.php?accion=eliminar&id=<?= $producto['id_producto'] ?>"
                              class="btn btn-danger btn-sm"
                              onclick="return confirm('¿Eliminar este producto?');">Eliminar</a>
                            <a href="#" class="btn btn-warning btn-sm btnEditarProducto"
                              data-id="<?= $producto['id_producto'] ?>"
                              data-nombre="<?= htmlspecialchars($producto['nombre'], ENT_QUOTES) ?>"
                              data-descripcion="<?= htmlspecialchars($producto['descripcion'], ENT_QUOTES) ?>"
                              data-precio="<?= $producto['precio'] ?>" data-stock="<?= $producto['stock'] ?>"
                              data-id_categoria="<?= $producto['id_categoria'] ?? '' ?>">
                              Editar
                            </a>




                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                <?php else: ?>
                  <p>No se encontraron productos.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <form action="../controllers/ProduEditarController.php" method="post">

        <div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Producto</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" id="edit_id_producto" name="id_p">

                <div class="form-group">
                  <label for="edit_nombre">Nombre</label>
                  <input type="text" class="form-control" id="edit_nombre" name="nombre_p">
                </div>

                <div class="form-group">
                  <label for="edit_descripcion">Descripción</label>
                  <input type="text" class="form-control" id="edit_descripcion" name="descripcion_p">
                </div>

                <div class="form-group">
                  <label for="edit_precio">Precio</label>
                  <input type="number" class="form-control" step="0.01" id="edit_precio" name="precio_p">
                </div>

                <div class="form-group">
                  <label for="edit_stock">Stock</label>
                  <input type="number" class="form-control" id="edit_stock" name="stock_p">
                </div>

                <div class="form-group">
                  <label for="edit_id_categoria">Categoría</label>
                  <select class="form-control" id="edit_id_categoria" name="categoria_p" required>
                    <option value="">Seleccione una categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                      <option value="<?= $cat['id_categoria'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnActualizarProducto">Actualizar</button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>

    <?php require_once("default/footer.php"); ?>
  </div>

  <!-- MODAL EDITAR PRODUCTO -->

  <script src="../views/assets/js/reportes_productos.js"></script>

  <?php require_once("default/links-script.php"); ?>

  <!-- Script para activar modal de edición -->


</body>

</html>