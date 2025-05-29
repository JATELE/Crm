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
require_once("../models/Categorias.php");
$obj = new categorias();
$categorias = $obj->obtenerCategorias(); // Este método debes tenerlo en tu modelo

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Categorías Registradas</title>
  <?php include_once("default/links-head.php"); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include_once("default/navigation.php"); ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>Categorías</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Categorías</li>
        </ol>
      </section>

      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Listado de Categorías</h3>
          </div>
          <div class="box-body table-responsive">
            <?php if (count($categorias) > 0): ?>
              <table class="table table-bordered table-hover">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categorias as $cat): ?>
                    <tr>
                      <td><?= htmlspecialchars($cat['id_categoria']) ?></td>
                      <td><?= htmlspecialchars($cat['nombre']) ?></td>
                      <td>
                        <a href="../controllers/CategoriaController.php?accion=eliminar&id_categoria=<?= $cat['id_categoria'] ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('¿Estás seguro de eliminar esta categoría?');">
                          Eliminar
                        </a>

                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>No se encontraron categorías.</p>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </div>

    <?php include_once("default/footer.php"); ?>
  </div>

  <?php include_once("default/links-script.php"); ?>
</body>

</html>