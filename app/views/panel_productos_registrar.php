<?php
session_start();
if (isset($_SESSION["usuario_sesion"])) {
  $nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
  $apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
  $privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
} else {
  header("location: ../index.php");
  // echo "No existe la sessión";
  // exit();
}
require_once '../models/conexion.php';
$conexion = new Conexion();
$conexion->conectar();

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
  <title>Registro de Producto</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <!-- Incluir una vez todos los links -->
  <?php include_once("default/links-head.php") ?>
</head>
<style>
  select.form-select {
    max-height: 200px;
    overflow-y: auto;
  }
  .center-wrapper {
  display: flex;
  justify-content: center;
  padding: 20px;
}

</style>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper"> <!-- INICIO DEL DIV DEL CONTENEDOR -->
    <!-- Cabezera y Nav del lado izquierdo -->
    <?php require_once("default/navigation.php") ?>
    <!-- Content Wrapper - Contenido Principal-->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> Registro de Producto <small>Control panel</small> </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Registro Productos</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
  <div class="center-wrapper d-flex justify-content-center">
    <div class="col-md-6">
      <div class="box box-primary p-4">
        <div class="box-header with-border text-center mb-3">
          <h3 class="box-title">Registrar Producto</h3>
        </div>
        <form action="../controllers/ProduRegistrarController.php" method="post">
          <div class="box-body">
            <div class="form-group mb-3">
              <label for="id_producto">ID Producto</label>
              <input type="text" class="form-control" id="id_producto" name="id_p" required>
            </div>
            <div class="form-group mb-3">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre_p" required>
            </div>
            <div class="form-group mb-3">
              <label for="descripcion">Descripción</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion_p" required>
            </div>
            <div class="form-group mb-3">
              <label for="precio">Precio</label>
              <input type="number" step="0.01" class="form-control" id="precio" name="precio_p" required>
            </div>
            <div class="form-group mb-3">
              <label for="stock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock_p" required>
            </div>
            <div class="form-group mb-3">
              <label for="categoria">Categoría</label>
              <select class="form-control" id="categoria" name="categoria_p" required>
                <option value="" disabled selected>Seleccione una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                  <option value="<?= htmlspecialchars($cat['id_categoria']) ?>">
                    <?= htmlspecialchars($cat['nombre']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-save"></i> Registrar
            </button>
            <button type="reset" class="btn btn-default">
              <i class="fa fa-eraser"></i> Limpiar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>




    </div>
    <!-- Footer -->
    <?php require_once("default/footer.php"); ?>
  </div> <!-- FINAL DEL DIV DEL CONTENEDOR -->
  <!-- Todos los scripts -->

  <?php require_once("default/links-script.php"); ?>
</body>

</html>