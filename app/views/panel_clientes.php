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

function inputField($type, $name, $label, $errores, $datos)
{
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
  <title>Registro de clientes</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <?php include_once("default/links-head.php") ?>
  <style>
    .center-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }

    .label-success {
      background: linear-gradient(90deg, #d4af37, #f9d976);
      color: #222 !important;
      font-weight: bold;
      box-shadow: 0 0 8px rgba(212, 175, 55, 0.6);
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- NAV -->
    <?php require_once("default/navigation.php") ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>Registro de clientes <small>Control panel</small></h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Registro Clientes</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="center-wrapper">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border text-center">
                <h3 class="box-title">Registrar Cliente</h3>
              </div>

              <form action="../controllers/ClienteController.php" method="post">
                <div class="box-body">
                  <?php
                  inputField("text", "dni_c", "DNI", $errores, $datos);
                  inputField("text", "nombre_c", "Nombre", $errores, $datos);
                  inputField("text", "apellidos_c", "Apellido", $errores, $datos);
                  inputField("email", "correo_c", "Correo electrónico", $errores, $datos);
                  inputField("text", "telefono_c", "Teléfono", $errores, $datos);
                  inputField("text", "lugar_c", "Lugar de Nacimiento", $errores, $datos);
                  inputField("date", "fecha_c", "Fecha de Nacimiento", $errores, $datos);
                  inputField("text", "contraseña", "Contraseña", $errores, $datos);
                  ?>

                  <input type="hidden" name="accion" value="registrar">

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
                      <span class="text-danger"><?php echo $errores['estado_c']; ?></span>
                    <?php endif; ?>
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
  </div>

  <?php require_once("default/links-script.php"); ?>

  <!-- Modal para activar licencia -->
  <div id="modalActivarLicencia" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="modalActivarLicenciaLabel">
    <div class="modal-dialog" role="document" style="margin-top: 10%;">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="modalActivarLicenciaLabel">Activar Licencia</h4>
        </div>
        <div class="modal-body">
          <form id="formActivarLicencia">
            <div class="form-group">
              <label for="codigo_licencia">Ingrese su código de licencia:</label>
              <input type="text" class="form-control" id="codigo_licencia" name="codigo_licencia"
                placeholder="Ejemplo: ABCD-1234-EFGH" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnActivarLicencia" class="btn btn-primary">Activar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script para enviar el código -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('btnActivarLicencia');
  const input = document.getElementById('codigo_licencia');

  btn.addEventListener('click', async () => {
    const codigo = input.value.trim();

    if (!codigo) {
      return Swal.fire('Error', 'Ingresa un código de licencia', 'error');
    }

    try {
      const response = await fetch('script/activar_licencia.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ codigo })
      });

      const data = await response.json();

      if (data.status === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Licencia activada',
          text: data.message,
          confirmButtonText: 'Aceptar'
        }).then(() => {
          // ✅ recarga la página para reflejar el cambio a "Versión PRO"
          location.reload();
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: data.message
        });
      }

    } catch (error) {
      console.error('Error:', error);
      Swal.fire('Error', 'Ocurrió un problema de conexión o respuesta inválida.', 'error');
    }
  });
});
</script>


  <?php if (isset($_SESSION['errores_registro']['limite'])): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
          icon: 'warning',
          title: 'Límite alcanzado',
          text: '<?php echo $_SESSION['errores_registro']['limite']; ?>',
          showCancelButton: true,
          confirmButtonText: 'Activar Licencia',
          cancelButtonText: 'Entendido',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#aaa'
        }).then((result) => {
          if (result.isConfirmed) {
            // Abrir modal en Bootstrap 3
            $('#modalActivarLicencia').modal('show');
          }
        });
      });
    </script>
    <?php unset($_SESSION['errores_registro']['limite']); ?>
  <?php endif; ?>


</body>

<?php
unset($_SESSION['errores_registro']);
unset($_SESSION['datos_registro']);
?>

</html>