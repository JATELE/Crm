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

// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "crm2";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Cargar promociones SIEMPRE
$promociones = [];
$sql_promos = "SELECT id_promocion, descripcion FROM promociones2 ORDER BY created_at DESC";
$res_promos = $conn->query($sql_promos);
while ($row = $res_promos->fetch_assoc()) {
  $promociones[] = $row;
}

$resultados = [];

if (isset($_POST['buscar'])) {
  $consulta = strtolower(trim($_POST['consulta_ia']));
  $condiciones = [];

  // Detectar estado civil
  $estados_civiles = ['soltero', 'casado', 'viudo', 'divorciado'];
  foreach ($estados_civiles as $estado) {
    if (strpos($consulta, $estado) !== false) {
      $condiciones[] = "estado_civil LIKE '%$estado%'";
    }
  }

  // Detectar lugar de nacimiento
  if (preg_match('/nacid[oa]s?\s+en\s+([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
    $lugarDetectado = trim($matches[1]);
    $condiciones[] = "lugar_nacimiento LIKE '%" . $conn->real_escape_string($lugarDetectado) . "%'";
  }

  // Detectar fecha de nacimiento
  if (preg_match('/(?:el|del)\s+(\d{4}-\d{2}-\d{2})/', $consulta, $matches)) {
    $fechaDetectada = $matches[1];
    $condiciones[] = "fecha_nacimiento = '" . $conn->real_escape_string($fechaDetectada) . "'";
  }

  if (!empty($condiciones)) {
    $sql = "SELECT * FROM clientes2 WHERE " . implode(" AND ", $condiciones);
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
      $resultados[] = $row;
    }
  }

}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Reporte de Clientes</title>
  <?php include_once("default/links-head.php") ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php require_once("default/navigation.php") ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1> Consultas clientes <small>Control panel</small></h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Consultas Clientes</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <form method="POST" class="row g-3 mb-4">
              <div class="form-group col-md-6">
                <label for="consulta_ia">Consulta Inteligente</label>
                <input type="text" id="consulta_ia" name="consulta_ia" class="form-control"
                  placeholder="Ej: Muéstrame los solteros nacidos en Lima el 1990-01-01" required>
              </div>

              <div class="form-group col-md-4">
                <label for="promocion">Seleccionar Promoción</label>
                <select id="promocion" name="promocion" class="form-control">
                  <option value="">-- Ninguna --</option>
                  <?php foreach ($promociones as $promo): ?>
                    <option value="<?= $promo['id_promocion'] ?>">
                      <?= substr($promo['descripcion'], 0, 60) ?>...
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group col-md-2 d-flex align-items-end">
                <button class="btn btn-success w-100" name="buscar">Consultar</button>
              </div>
            </form>

          </div>

          <div class="col-lg-12">
            <table class="table table-hover table-responsive" style="background:#ffff">
              <thead class="table-dark">
                <tr>
                  <th>DNI</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Lugar Nacimiento</th>
                  <th>Fecha Nacimiento</th>
                  <th>Estado Civil</th>
                  <th>WhatsApp</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($resultados)): ?>
                  <?php foreach ($resultados as $cliente): ?>
                    <tr>
                      <td><?= $cliente['dni_cliente'] ?></td>
                      <td><?= $cliente['nombres_cliente'] ?></td>
                      <td><?= $cliente['apellidos_cliente'] ?></td>
                      <td><?= $cliente['correo_cliente'] ?></td>
                      <td><?= $cliente['telefono_cliente'] ?></td>
                      <td><?= $cliente['lugar_nacimiento'] ?></td>
                      <td><?= $cliente['fecha_nacimiento'] ?></td>
                      <td><?= $cliente['estado_civil'] ?></td>
                      <td>
                        <?php
                        $telefono = preg_replace('/\D/', '', $cliente['telefono_cliente']);
                        ?>
                        <?php if (!empty($telefono)): ?>
                          <button type="button" class="btn btn-success btn-sm enviar-wsp" data-telefono="<?= $telefono ?>">
                            WhatsApp
                          </button>
                        <?php else: ?>
                          <span class="text-muted">Sin número</span>
                        <?php endif; ?>
                      </td>

                    </tr>
                  <?php endforeach; ?>
                <?php elseif (isset($_POST['buscar'])): ?>
                  <tr>
                    <td colspan="9" class="text-center">No se encontraron resultados.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
    <?php require_once("default/footer.php"); ?>
  </div>

  <?php require_once("default/links-script.php"); ?>
  <script>
    // Pasamos las promociones de PHP a JS
    const promociones = <?= json_encode($promociones) ?>;
  </script>
  <script>
    document.querySelectorAll(".enviar-wsp").forEach(btn => {
      btn.addEventListener("click", () => {
        const telefono = btn.dataset.telefono;
        const promoId = document.getElementById("promocion").value;

        // Mensaje base
        let mensaje = "";

        // Si hay promo seleccionada
        if (promoId) {
          const promo = promociones.find(p => p.id_promocion == promoId);
          if (promo) {
            mensaje += " 🎉 Promoción especial: " + promo.descripcion;
          }
        }

        // Abrir WhatsApp
        const url = `https://wa.me/51${telefono}?text=${encodeURIComponent(mensaje)}`;
        window.open(url, "_blank");
      });
    });
  </script>

</body>

</html>