<?php
session_start();
if (!isset($_SESSION["usuario_sesion"])) {
  header("location: ../index.php");
  exit();
}

$nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
$apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
$privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];

$host = "localhost";
$user = "root";
$pass = "";
$db = "crm2";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error)
  die("Error de conexión: " . $conn->connect_error);

// Cargar promociones
$promociones = [];
$sql_promos = "SELECT id_promocion, descripcion FROM promociones2 ORDER BY created_at DESC";
$res_promos = $conn->query($sql_promos);
while ($row = $res_promos->fetch_assoc())
  $promociones[] = $row;

$resultados = [];

if (isset($_POST['buscar'])) {
  $consulta = strtolower(trim($_POST['consulta_ia']));
  $condiciones = [];

  // Detectar consultas inteligentes en clientes2
  if ($consulta !== "" && $consulta !== "muestrame todos los clientes") {
    // Estado civil
    $estados_civiles = ['soltero', 'casado', 'viudo', 'divorciado'];
    foreach ($estados_civiles as $estado) {
      if (strpos($consulta, $estado) !== false)
        $condiciones[] = "c.estado_civil LIKE '%$estado%'";
    }

    // Lugar de nacimiento
    if (preg_match('/nacid[oa]s?\s+en\s+([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $lugarDetectado = trim($matches[1]);
      $condiciones[] = "c.lugar_nacimiento LIKE '%" . $conn->real_escape_string($lugarDetectado) . "%'";
    }

    // Fecha de nacimiento
    if (preg_match('/(?:el|del)\s+(\d{4}-\d{2}-\d{2})/', $consulta, $matches)) {
      $fechaDetectada = $matches[1];
      $condiciones[] = "c.fecha_nacimiento = '" . $conn->real_escape_string($fechaDetectada) . "'";
    }

    // Presupuesto deseado
    if (preg_match('/presupuesto\s+de\s+(\d+)/i', $consulta, $matches)) {
      $presupuesto = intval($matches[1]);
      $condiciones[] = "d.presupuesto_estimado = $presupuesto";
    }

    // Experiencia visitada
    if (preg_match('/lugar\s+visitado\s+([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $lugar_exp = trim($matches[1]);
      $condiciones[] = "e.lugar LIKE '%" . $conn->real_escape_string($lugar_exp) . "%'";
    }
    if (preg_match('/destino\s+([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
    $destino_detectado = trim($matches[1]);
    $condiciones[] = "d.destino LIKE '%" . $conn->real_escape_string($destino_detectado) . "%'";
}
  }

  // Consulta base con LEFT JOIN para traer datos aunque falten algunas tablas
  $sql = "SELECT c.*, d.destino, d.presupuesto_estimado, d.tiempo_estimado,
                 e.bien_adquirido, e.calificacion, e.lugar AS lugar_experiencia,
                 e.tipo_de_viaje, e.fecha_visita,
                 i.fecha AS fecha_interaccion, i.canal AS canal_interaccion, i.descripcion AS descripcion_interaccion
          FROM clientes2 c
          LEFT JOIN deseo2 d ON c.dni_cliente = d.dni_cliente
          LEFT JOIN experiencia2 e ON c.dni_cliente = e.dni_cliente
          LEFT JOIN interacciones2 i ON c.dni_cliente = i.dni_cliente";

  if (!empty($condiciones)) {
    $sql .= " WHERE " . implode(" AND ", $condiciones);
  }

  $res = $conn->query($sql);
  while ($row = $res->fetch_assoc())
    $resultados[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Reporte de Clientes</title>
  <?php include_once("default/links-head.php") ?>
  <style>
    /* Scroll horizontal y vertical */
    .table-container {
      max-height: 600px; /* altura máxima de la tabla con scroll vertical */
      overflow-y: auto;
      overflow-x: auto;
      border: 1px solid #ddd;
      padding: 5px;
      background: #fff;
    }

    table.table th,
    table.table td {
      white-space: nowrap; /* Evita que el texto se rompa */
    }
  </style>
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

          <div class="col-lg-12 table-container">
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
                  <th>Puntos</th>
                  <th>Contraseña</th>
                  <th>Destino</th>
                  <th>Presupuesto</th>
                  <th>Tiempo Estimado</th>
                  <th>Bien Adquirido</th>
                  <th>Calificación</th>
                  <th>Lugar Experiencia</th>
                  <th>Tipo de Viaje</th>
                  <th>Fecha Visita</th>
                  <th>Fecha Interacción</th>
                  <th>Canal Interacción</th>
                  <th>Descripción Interacción</th>
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
                      <td><?= $cliente['puntos'] ?? 0 ?></td>
                      <td><?= $cliente['password_cliente'] ?? '' ?></td>
                      <td><?= $cliente['destino'] ?? '' ?></td>
                      <td><?= $cliente['presupuesto_estimado'] ?? '' ?></td>
                      <td><?= $cliente['tiempo_estimado'] ?? '' ?></td>
                      <td><?= $cliente['bien_adquirido'] ?? '' ?></td>
                      <td><?= $cliente['calificacion'] ?? '' ?></td>
                      <td><?= $cliente['lugar_experiencia'] ?? '' ?></td>
                      <td><?= $cliente['tipo_de_viaje'] ?? '' ?></td>
                      <td><?= $cliente['fecha_visita'] ?? '' ?></td>
                      <td><?= $cliente['fecha_interaccion'] ?? '' ?></td>
                      <td><?= $cliente['canal_interaccion'] ?? '' ?></td>
                      <td><?= $cliente['descripcion_interaccion'] ?? '' ?></td>
                      <td>
                        <?php
                        $telefono = preg_replace('/\D/', '', $cliente['telefono_cliente']);
                        ?>
                        <?php if (!empty($telefono)): ?>
                          <button type="button" class="btn btn-success btn-sm enviar-wsp"
                            data-telefono="<?= $telefono ?>">
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
                    <td colspan="22" class="text-center">No se encontraron resultados.</td>
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
    const promociones = <?= json_encode($promociones) ?>;
    document.querySelectorAll(".enviar-wsp").forEach(btn => {
      btn.addEventListener("click", () => {
        const telefono = btn.dataset.telefono;
        const promoId = document.getElementById("promocion").value;
        let mensaje = "";
        if (promoId) {
          const promo = promociones.find(p => p.id_promocion == promoId);
          if (promo) mensaje += " 🎉 Promoción especial: " + promo.descripcion;
        }
        const url = `https://wa.me/51${telefono}?text=${encodeURIComponent(mensaje)}`;
        window.open(url, "_blank");
      });
    });
  </script>

</body>
</html>
