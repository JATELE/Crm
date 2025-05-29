<?php 
  session_start();
  $errores = $_SESSION['errores_categoria'] ?? [];
  $datos = $_SESSION['datos_categoria'] ?? [];

  if(isset($_SESSION["usuario_sesion"])){
    $nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
    $apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
    $privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
  }else{
    header("location: ../index.php");
    exit();
  }

  function inputField($type, $name, $label, $errores, $datos) {
    $value = htmlspecialchars($datos[$name] ?? '');
    $isInvalid = isset($errores[$name]) ? 'is-invalid' : '';
    $errorMsg = $errores[$name] ?? '';

    echo "<div class='mb-3'>";
    echo "<label for='$name' class='form-label'>$label</label>";
    echo "<input type='$type' class='form-control $isInvalid' id='$name' name='$name' value='$value'>";
    if ($errorMsg) {
        echo "<div class='text-danger'>$errorMsg</div>";
    }
    echo "</div>";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Registro de Categorías</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    <?php include_once("default/links-head.php") ?>
    <style>
      .center-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
      }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php require_once("default/navigation.php") ?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1> Registro de categorías <small>Panel de control</small> </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Registro Categorías</li>
          </ol>
        </section>

        <section class="content">
          <div class="center-wrapper">
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border text-center">
                  <h3 class="box-title">Registrar Categoría</h3>
                </div>
                <form action="../controllers/CategoriaController.php" method="post">
                  <div class="box-body">
                    
                    <?php
                      inputField("text", "nombre", "Nombre de la categoría", $errores, $datos);
                    ?>
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
      <?php require_once("default/footer.php");?>
    </div>  
    <?php require_once("default/links-script.php");?>
  </body>
  <?php
    unset($_SESSION['errores_categoria']);
    unset($_SESSION['datos_categoria']);
  ?>
</html>
