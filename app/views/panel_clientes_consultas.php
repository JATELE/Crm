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

// Buscar clientes inteligentes
$resultados = [];
if (isset($_POST['buscar'])) {
  $consulta = strtolower(trim($_POST['consulta_ia']));
  $condiciones = [];

  if ($consulta !== "" && $consulta !== "muestrame todos los clientes") {

    // 🔹 Buscar por DNI
    if (preg_match('/dni\s*(\d+)/i', $consulta, $matches)) {
      $dni = $conn->real_escape_string($matches[1]);
      $condiciones[] = "c.dni_cliente = '$dni'";
    }

    // 🔹 Buscar por nombre o apellido
    if (preg_match('/nombre\s+([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $nombre = $conn->real_escape_string(trim($matches[1]));
      $condiciones[] = "c.nombres_cliente LIKE '%$nombre%'";
    }
    if (preg_match('/apellido\s+([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $apellido = $conn->real_escape_string(trim($matches[1]));
      $condiciones[] = "c.apellidos_cliente LIKE '%$apellido%'";
    }

    // 🔹 Correo
    if (preg_match('/correo\s+([a-z0-9@._-]+)/i', $consulta, $matches)) {
      $correo = $conn->real_escape_string($matches[1]);
      $condiciones[] = "c.correo_cliente LIKE '%$correo%'";
    }

    // 🔹 Teléfono
    if (preg_match('/telefono\s*(\d+)/i', $consulta, $matches)) {
      $telefono = $conn->real_escape_string($matches[1]);
      $condiciones[] = "c.telefono_cliente LIKE '%$telefono%'";
    }

    // 🔹 Estado civil
    $estados_civiles = ['soltero', 'casado', 'viudo', 'divorciado', 'conviviente'];
    foreach ($estados_civiles as $estado) {
      if (strpos($consulta, $estado) !== false) {
        $condiciones[] = "c.estado_civil LIKE '%$estado%'";
      }
    }

    // 🔹 Lugar de nacimiento
    if (preg_match('/nacido en ([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $lugar = $conn->real_escape_string(trim($matches[1]));
      $condiciones[] = "c.lugar_nacimiento LIKE '%$lugar%'";
    }

    // 🔹 Fecha de nacimiento
    if (preg_match('/fecha de nacimiento (\d{4}-\d{2}-\d{2})/i', $consulta, $matches)) {
      $fecha = $conn->real_escape_string($matches[1]);
      $condiciones[] = "c.fecha_nacimiento = '$fecha'";
    }

    // 🔹 Presupuesto
    if (preg_match('/presupuesto de\s*(\d+)/i', $consulta, $matches)) {
      $presupuesto = intval($matches[1]);
      $condiciones[] = "d.presupuesto_estimado = $presupuesto";
    }

    // 🔹 Destino
    if (preg_match('/destino\s+([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $destino = $conn->real_escape_string(trim($matches[1]));
      $condiciones[] = "d.destino LIKE '%$destino%'";
    }

    // 🔹 Experiencia / lugar visitado
    if (preg_match('/experiencia en ([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $lugar_exp = $conn->real_escape_string(trim($matches[1]));
      $condiciones[] = "e.lugar LIKE '%$lugar_exp%'";
    }

    // 🔹 Tipo de viaje
    if (preg_match('/tipo de viaje ([a-záéíóúñ\s]+)/i', $consulta, $matches)) {
      $tipo = $conn->real_escape_string(trim($matches[1]));
      $condiciones[] = "e.tipo_de_viaje LIKE '%$tipo%'";
    }

    // 🔹 Fecha de visita
    if (preg_match('/fecha de visita (\d{4}-\d{2}-\d{2})/i', $consulta, $matches)) {
      $fecha_visita = $conn->real_escape_string($matches[1]);
      $condiciones[] = "e.fecha_visita = '$fecha_visita'";
    }

    // 🔹 Interacciones
    if (preg_match('/interaccion (.+)/i', $consulta, $matches)) {
      $interaccion = $conn->real_escape_string(trim($matches[1]));
      $condiciones[] = "(i.canal LIKE '%$interaccion%' OR i.descripcion LIKE '%$interaccion%')";
    }
  }

  $sql = "SELECT DISTINCT c.dni_cliente, c.nombres_cliente, c.apellidos_cliente,
               c.correo_cliente, c.telefono_cliente, c.lugar_nacimiento,
               c.fecha_nacimiento, c.estado_civil, c.puntos, c.password_cliente,
               d.destino, d.presupuesto_estimado, d.tiempo_estimado,
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
  $resultados = [];
  while ($row = $res->fetch_assoc()) {
    $resultados[] = $row;
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Clientes - Búsqueda y Gestión</title>
  <?php include_once("default/links-head.php") ?>
  <style>
    .table-container {
      max-height: 600px;
      overflow-y: auto;
      overflow-x: auto;
      border: 1px solid #ddd;
      padding: 5px;
      background: #fff;
    }

    .editable {
      cursor: pointer;
      background-color: #fcfcfc;
    }

    .editable:focus {
      background-color: #fff6cc;
      outline: 2px solid #ffc107;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php require_once("default/navigation.php") ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Clientes <small>Búsqueda inteligente y gestión</small></h1>
      </section>

      <section class="content">
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
          <div class="form-group col-md-4 d-flex align-items-end">
            <button class="btn btn-success w-100" name="buscar">Consultar</button>
          </div>
        </form>
        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
          <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark sticky-top">
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
                <th>Experiencia Vivida</th>
                <th>Tipo de Viaje</th>
                <th>Fecha Visita</th>
                <th>Fecha Interacción</th>
                <th>Canal Interacción</th>
                <th>Descripción Interacción</th>
                <th>Encuesta</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($resultados)): ?>
                <?php foreach ($resultados as $cliente): ?>
                  <tr>
                    <td><?= htmlspecialchars($cliente['dni_cliente']) ?></td>
                    <td contenteditable="true" data-campo="nombres_cliente" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable text-start"><?= htmlspecialchars($cliente['nombres_cliente']) ?></td>
                    <td contenteditable="true" data-campo="apellidos_cliente" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable text-start"><?= htmlspecialchars($cliente['apellidos_cliente']) ?></td>
                    <td contenteditable="true" data-campo="correo_cliente" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable text-start"><?= htmlspecialchars($cliente['correo_cliente']) ?></td>
                    <td contenteditable="true" data-campo="telefono_cliente" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['telefono_cliente']) ?></td>
                    <td contenteditable="true" data-campo="lugar_nacimiento" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['lugar_nacimiento']) ?></td>
                    <td contenteditable="true" data-campo="fecha_nacimiento" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></td>
                    <td contenteditable="true" data-campo="estado_civil" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['estado_civil']) ?></td>
                    <td contenteditable="true" data-campo="puntos" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['puntos'] ?? 0) ?></td>
                    <td contenteditable="true" data-campo="password_cliente" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable text-start"><?= htmlspecialchars($cliente['password_cliente'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="destino" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable text-start"><?= htmlspecialchars($cliente['destino'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="presupuesto_estimado" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['presupuesto_estimado'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="tiempo_estimado" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['tiempo_estimado'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="bien_adquirido" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['bien_adquirido'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="calificacion" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['calificacion'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="lugar_experiencia" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable text-start"><?= htmlspecialchars($cliente['lugar_experiencia'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="tipo_de_viaje" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['tipo_de_viaje'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="fecha_visita" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['fecha_visita'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="fecha_interaccion" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable"><?= htmlspecialchars($cliente['fecha_interaccion'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="canal_interaccion" data-dni="<?= $cliente['dni_cliente'] ?>"
                      class="editable text-start"><?= htmlspecialchars($cliente['canal_interaccion'] ?? '') ?></td>
                    <td contenteditable="true" data-campo="descripcion_interaccion"
                      data-dni="<?= $cliente['dni_cliente'] ?>" class="editable text-start">
                      <?= htmlspecialchars($cliente['descripcion_interaccion'] ?? '') ?>
                    </td>

                    <td>
                      <?php
                      $respondio = $conn->query("SELECT 1 FROM respuestas2 WHERE dni_cliente = '{$cliente['dni_cliente']}' LIMIT 1")->num_rows > 0;
                      ?>
                      <i class="fa <?= $respondio ? 'fa-check-circle text-success' : 'fa-times-circle text-muted' ?>"
                        title="<?= $respondio ? 'Ya respondió' : 'No respondió' ?>"></i>
                    </td>

                    <td>
                      <!-- 🗑️ Eliminar -->
                      <a href="#" class="btn btn-danger btn-sm eliminar-cliente" data-dni="<?= $cliente['dni_cliente'] ?>"
                        title="Eliminar cliente">
                        <i class="fas fa-trash"></i>
                      </a>

                      <!-- 💬 WhatsApp -->
                      <?php if (!empty($cliente['telefono_cliente'])): ?>
                        <a href="https://wa.me/<?= $cliente['telefono_cliente'] ?>?text=Hola%20👋,%20te%20contactamos%20desde%20nuestra%20agencia."
                          target="_blank" class="btn btn-success btn-sm" title="Enviar WhatsApp">
                          <i class="fa fa-whatsapp"></i>
                        </a>
                      <?php else: ?>
                        <i class="fa fa-ban text-muted" title="Sin número"></i>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="23" class="text-center">No se encontraron resultados.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

      </section>
    </div>
    <?php require_once("default/footer.php"); ?>
  </div>

  <?php require_once("default/links-script.php"); ?>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.editable').forEach(cell => {

        // --- Guardar al salir del campo (blur) ---
        cell.addEventListener('blur', guardarCambio);

        // --- Guardar también al presionar Enter ---
        cell.addEventListener('keydown', function (e) {
          if (e.key === 'Enter') {
            e.preventDefault(); // evita salto de línea
            this.blur(); // fuerza el blur para que dispare el guardado
          }
        });
      });

      // --- Función para enviar actualización al servidor ---
      function guardarCambio() {
        const nuevoValor = this.innerText.trim();
        const dni = this.dataset.dni;
        const campo = this.dataset.campo;

        fetch('../controllers/ClienteController.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: accion = actualizar_inline & dni=${ dni } & campo=${ campo } & valor=${ encodeURIComponent(nuevoValor) }
        })
      .then(res => res.text())
      .then(resp => {
        if (resp.trim() === "ok") {
          this.style.backgroundColor = "#c8f7c5"; // verde clarito = guardado
          setTimeout(() => this.style.backgroundColor = "", 800);
        } else {
          this.style.backgroundColor = "#f8d7da"; // rojo = error
          setTimeout(() => this.style.backgroundColor = "", 800);
          console.error("Error al guardar:", resp);
        }
      })
      .catch(err => console.error("❌ Error de red:", err));
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const urlParams = new URLSearchParams(window.location.search);

      // Mensaje de eliminación correcta
      if (urlParams.get('msg') === 'eliminado') {
        Swal.fire({
          icon: 'success',
          title: 'Cliente eliminado correctamente',
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true
        }).then(() => {
          // 🔹 Eliminar los parámetros de la URL para evitar recarga
          window.history.replaceState(null, '', window.location.pathname);
        });
      }

      // Mensaje de relación (no se puede eliminar)
      if (urlParams.get('error') === 'relacion') {
        Swal.fire({
          icon: 'warning',
          title: 'No puedes eliminar este cliente',
          text: 'Ya respondió una encuesta.',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true
        }).then(() => {
          window.history.replaceState(null, '', window.location.pathname);
        });
      }
    });
  </script>
  <!-- ✅ SCRIPT: Edición inline de campos -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.editable').forEach(cell => {
        // --- Guardar al salir del campo (blur)
        cell.addEventListener('blur', guardarCambio);

        // --- Guardar también al presionar Enter
        cell.addEventListener('keydown', function (e) {
          if (e.key === 'Enter') {
            e.preventDefault(); // evita salto de línea
            this.blur(); // fuerza el blur para que dispare el guardado
          }
        });
      });

      // --- Función para enviar actualización al servidor
      function guardarCambio() {
        const nuevoValor = this.innerText.trim();
        const dni = this.dataset.dni;
        const campo = this.dataset.campo;

        fetch('../controllers/ClienteController.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `accion=actualizar_inline&dni=${encodeURIComponent(dni)}&campo=${encodeURIComponent(campo)}&valor=${encodeURIComponent(nuevoValor)}`
        })
          .then(res => res.text())
          .then(resp => {
            if (resp.trim() === "ok") {
              this.style.backgroundColor = "#c8f7c5"; // verde clarito = guardado
              setTimeout(() => this.style.backgroundColor = "", 800);
            } else {
              this.style.backgroundColor = "#f8d7da"; // rojo = error
              setTimeout(() => this.style.backgroundColor = "", 800);
              console.error("Error al guardar:", resp);
            }
          })
          .catch(err => console.error("❌ Error de red:", err));
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      document.querySelectorAll(".eliminar-cliente").forEach(btn => {
        btn.addEventListener("click", async (e) => {
          e.preventDefault();

          const dni = btn.dataset.dni;
          const fila = btn.closest("tr");
          const url = `../controllers/ClienteController.php?accion=eliminar&dni=${encodeURIComponent(dni)}`;

          const confirm = await Swal.fire({
            title: "¿Eliminar cliente?",
            text: `Se eliminará el cliente con DNI ${dni}.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
          });

          if (!confirm.isConfirmed) return;

          try {
            const res = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
            const texto = await res.text();

            if (texto.includes("ok")) {
              fila.style.transition = "opacity 0.4s, transform 0.4s";
              fila.style.opacity = "0";
              fila.style.transform = "translateX(-20px)";
              setTimeout(() => fila.remove(), 400);

              Swal.fire({
                icon: "success",
                title: "Cliente eliminado",
                showConfirmButton: false,
                timer: 1200
              });

            } else if (texto.includes("relacion")) {
              Swal.fire({
                icon: "warning",
                title: "No puedes eliminar este cliente",
                text: "Ya respondió una encuesta.",
                confirmButtonText: "Entendido"
              });

            } else {
              Swal.fire({
                icon: "error",
                title: "Error al eliminar",
                text: texto || "Error desconocido"
              });
            }

          } catch (err) {
            console.error(err);
            Swal.fire({
              icon: "error",
              title: "Error de conexión",
              text: "No se pudo conectar con el servidor."
            });
          }
        });
      });
    });

  </script>


</body>

</html>