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
$sqlCategorias = "SELECT id_encuesta, nombre_encuesta FROM encuestas2 ORDER BY nombre_encuesta ASC";
$resultadoCategorias = $conexion->getConexion()->query($sqlCategorias);

if ($resultadoCategorias) {
  while ($fila = $resultadoCategorias->fetch_assoc()) {
    $categorias[] = $fila;
  }
} else {
  echo "Error al consultar Encuesta: " . $conexion->getConexion()->error;
}
$preguntas = [];
require_once '../models/Encuesta.php';
$encuestaModel = new Encuesta();
$encuestasConPreguntasAgrupadas = $encuestaModel->obtenerEncuestasAgrupadas();


$sqlCategorias = "SELECT id_pregunta, pregunta FROM preguntas2 ORDER BY pregunta ASC";
$resultadoCategorias = $conexion->getConexion()->query($sqlCategorias);

if ($resultadoCategorias) {
  while ($fila = $resultadoCategorias->fetch_assoc()) {
    $preguntas[] = $fila;
  }
} else {
  echo "Error al consultar Preguntas: " . $conexion->getConexion()->error;
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
        <h1> Creacion de Encuestas <small>Panel de control</small> </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Creacion de Encuesta</li>
        </ol>
      </section>
      <section class="content">
        <div class="center-wrapper">
          <div class="col-md-6">
            <div class="box box-primary p-4">
              <div class="box-header with-border text-center mb-3">
                <h3 class="box-title">Crear Encuesta</h3>
              </div>
              <form action="../controllers/EncuestaCrearController.php" method="post">
                <div class="box-body">
                  <div class="form-group mb-3">
                    <label for="id_encuesta">Nombre de Encuesta</label>
                    <select class="form-control" id="id_encuesta" name="id_encuesta" required>
                      <option value="" disabled selected>Seleccione una Encuesta</option>
                      <?php foreach ($categorias as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['id_encuesta']) ?>">
                          <?= htmlspecialchars($cat['nombre_encuesta']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <div class="form-group mb-3">
                      <label for="id_pregunta">Preguntas</label>
                      <select class="form-control" id="id_pregunta" name="id_pregunta[]" multiple required>
                        <?php foreach ($preguntas as $cat): ?>
                          <option value="<?= htmlspecialchars($cat['id_pregunta']) ?>">
                            <?= htmlspecialchars($cat['pregunta']) ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                      <small class="form-text text-muted">Presione Ctrl (o Cmd en Mac) para seleccionar múltiples
                        preguntas.</small>
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
      <?php if (!empty($encuestasConPreguntasAgrupadas)): ?>
        <div class="box box-info mt-4">
          <div class="box-header with-border">
            <h3 class="box-title">Encuestas Registradas con sus Preguntas</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre de Encuesta</th>
                  <th>Preguntas Asociadas</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($encuestasConPreguntasAgrupadas as $item): ?>
                  <tr>
                    <td><?= htmlspecialchars($item['nombre_encuesta']) ?></td>
                    <td><?= "- " . $item['preguntas'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php else: ?>
        <div class="alert alert-info">Aún no hay encuestas registradas con preguntas.</div>
      <?php endif; ?>
    </div>

    <?php require_once("default/footer.php"); ?>
  </div>
  <?php require_once("default/links-script.php"); ?>
</body>

</html>