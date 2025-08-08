<?php
session_start();
if (!isset($_SESSION["usuario_sesion"])) {
  header("location: ../index.php");
}
$nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
$apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
$privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];

// Cargar campañas
require_once '../models/conexion.php';


$conexion = new Conexion();
$conexion->conectar();

$categorias = [];
$sqlCategorias = "SELECT id_campaña, nombre_campaña FROM campaña2 ORDER BY nombre_campaña ASC";
$resultadoCategorias = $conexion->getConexion()->query($sqlCategorias);

if ($resultadoCategorias) {
  while ($fila = $resultadoCategorias->fetch_assoc()) {
    $categorias[] = $fila;
  }
} else {
  echo "Error al consultar categorías: " . $conexion->getConexion()->error;
}

// Ahora sí cierro la conexión

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Registro de Encuesta</title>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
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
<div class="wrapper">
  <?php require_once("default/navigation.php") ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Registro de Encuestas <small>Panel de control</small> </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Registro Encuesta</li>
      </ol>
    </section>

    <section class="content">
      <div class="center-wrapper">
        <div class="col-md-6">
          <div class="box box-primary p-4">
            <div class="box-header with-border text-center mb-3">
              <h3 class="box-title">Registrar Nueva Encuesta</h3>
            </div>
            <form action="../controllers/EncuestaRegistrarController.php" method="post">
              <div class="box-body">
                

            <div class="form-group mb-3">
              <label for="id_campaña">Campaña</label>
              <select class="form-control" id="id_campaña" name="id_campaña" required>
                <option value="" disabled selected>Seleccione una Campaña</option>
                <?php foreach ($categorias as $cat): ?>
                  <option value="<?= htmlspecialchars($cat['id_campaña']) ?>">
                    <?= htmlspecialchars($cat['nombre_campaña']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
                <!-- NOMBRE ENCUESTA -->
                <div class="form-group mb-3">
                  <label for="nombre_encuesta">Nombre de la Encuesta</label>
                  <input type="text" class="form-control" id="nombre_encuesta" name="nombre_encuesta" required>
                </div>

                <!-- DESCRIPCIÓN -->
                <div class="form-group mb-3">
                  <label for="descripcion">Descripción</label>
                  <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>

                <!-- FECHA CREACIÓN -->
                <div class="form-group mb-3">
                  <label for="fecha_creacion">Fecha de Creación</label>
                  <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" required>
                </div>

                <div class="form-group mb-3">
                  <label for="puntos_encuesta">Puntos</label>
                  <input type="text" class="form-control" id="puntos_encuesta" name="puntos_encuesta" required>
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
  <?php require_once("default/footer.php"); ?>
</div>
<?php require_once("default/links-script.php"); ?>
</body>
</html>
