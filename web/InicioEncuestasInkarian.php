<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$logueado = isset($_SESSION["cliente_sesion"]);
$nombre = $logueado ? $_SESSION["cliente_sesion"]["nombre"] : "";
$apellido = $logueado ? $_SESSION["cliente_sesion"]["apellido"] : "";

// Recuperar errores y datos guardados en sesión (para login/registro)
$errores = $_SESSION['errores_registro'] ?? [];
$datos = $_SESSION['datos_registro'] ?? [];
$success = $_SESSION['success_registro'] ?? "";

// Limpiar solo si ya los mostramos
if (!empty($errores) || !empty($success)) {
  unset($_SESSION['errores_registro'], $_SESSION['datos_registro'], $_SESSION['success_registro']);
}

// Función auxiliar para inputs
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
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encuentas Inkarián</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="css/gym.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background-color: #f1f6f5;
    }

    .carousel-indicators [data-bs-target] {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: #28a745;
      border: none;
      opacity: 0.5;
      margin: 0 4px;
    }

    .carousel-indicators .active {
      background-color: #145c2a;
      opacity: 1;
    }

    @media (max-width: 768px) {
      .carousel-inner .carousel-item>.row {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
      }

      .carousel-inner .carousel-item .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
        scroll-snap-align: center;
      }

      .carousel-control-prev,
      .carousel-control-next {
        display: none;
      }

      .categoria-slide {
        padding: 15px;
      }
    }

    .top-bar {
      background-color: #f89406;
      color: white;
      text-align: center;
      padding: 8px 0;
      font-weight: bold;
    }

    /* Footer general */
    #main-footer .footer-widget img {
      width: 15px;
      /* cambia el tamaño */
      height: auto;
      /* mantiene la proporción */
    }

    #main-footer {
      background-color: #222;
      /* fondo oscuro */
      color: #fff;
      /* texto blanco */
      padding: 40px 0;
      font-family: Arial, sans-serif;
    }

    /* Contenedor de columnas */
    #footer-widgets {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
    }

    /* Cada columna */
    .footer-widget {
      flex: 1;
      min-width: 200px;
    }

    /* Títulos */
    .footer-widget .title {
      color: #ff6600;
      /* naranja */
      font-size: 18px;
      margin-bottom: 15px;
    }

    /* Listas */
    .footer-widget ul {
      list-style: disc;
      margin: 0;
      padding-left: 20px;
    }

    .footer-widget ul li {
      margin-bottom: 8px;
    }

    .footer-widget ul li a {
      color: #ddd;
      text-decoration: none;
      transition: color 0.3s;
    }

    .footer-widget ul li a:hover {
      color: #ff6600;
      /* hover en naranja */
    }

    /* Contacto */
    .footer-widget p,
    .footer-widget a {
      color: #ddd;
      font-size: 14px;
    }

    /* Botones */
    .wp-block-button__link {
      display: inline-block;
      padding: 8px 20px;
      border-radius: 25px;
      border: 2px solid #fff;
      background: transparent;
      color: #fff;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s;
    }

    .wp-block-button__link:hover {
      background: #ff6600;
      border-color: #ff6600;
      color: #fff;
    }

    /* Footer inferior */
    #footer-bottom {
      border-top: 1px solid #444;
      margin-top: 30px;
      padding-top: 15px;
      text-align: center;
      font-size: 13px;
      color: #aaa;
    }

    .et_pb_column .et_pb_blurb .et-pb-icon {
      font-size: 4px !important;
      /* Cambia el 24px al tamaño que prefieras */
    }
  </style>
</head>

<body>
  <!-- Top bar -->
  <div class="top-bar">
    <div class="moving-text">
      🚚 ¡Gana <span class="highlight">descuentos increíbles</span> con tus puntos! 🎁
      🚀 Canjea y ahorra en tus compras favoritas 💳
    </div>
  </div>

  <style>
    /* Estilo de la barra */
    .top-bar {
      background: linear-gradient(90deg, #f38c47ff, #1dd1a1, #54a0ff);
      background-size: 400% 400%;
      animation: moveGradient 8s ease infinite;
      overflow: hidden;
      white-space: nowrap;
      padding: 10px 0;
      position: relative;
      font-size: 1.1rem;
      font-weight: bold;
      color: #fff;
      text-shadow: 0 0 6px rgba(0, 0, 0, 0.4);
    }

    /* Movimiento del fondo */
    @keyframes moveGradient {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    /* Texto desplazándose */
    .moving-text {
      display: inline-block;
      padding-left: 100%;
      animation: moveText 18s linear infinite;
    }

    @keyframes moveText {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-100%);
      }
    }

    /* Palabra destacada */
    .highlight {
      color: #fff;
      text-shadow: 0 0 10px #fff, 0 0 20px #ffe066;
    }
  </style>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg border-bottom border-body py-4 p-3" style="background-color: #f7f3ec;">
    <div class="container-fluid position-relative">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar -->
      <div class="collapse navbar-collapse nav justify-content-center" id="navbarContent">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link M11" href="inicioEncuestasInkarian.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link M11" href="servicios.php">Servicios</a></li>
          <li class="nav-item"><a class="nav-link M11" href="encuentas.php">Encuestas</a></li>
        </ul>
      </div>

      <style>
        /* ===== Navbar estilo moderno solo con línea animada ===== */
        .navbar-nav .nav-item .nav-link.M11 {
          color: #333;
          /* color base del texto */
          font-weight: 600;
          font-size: 1.05rem;
          padding: 10px 0;
          /* solo espacio vertical */
          border-radius: 0;
          /* sin esquinas redondeadas */
          transition: color 0.3s ease;
          position: relative;
          text-transform: uppercase;

          /* Animación al cargar */
          opacity: 0;
          transform: translateY(-20px);
          animation: slideDown 0.6s ease forwards;
        }

        /* Animación escalonada para cada link */
        .navbar-nav .nav-item:nth-child(1) .nav-link.M11 {
          animation-delay: 0.2s;
        }

        .navbar-nav .nav-item:nth-child(2) .nav-link.M11 {
          animation-delay: 0.4s;
        }

        .navbar-nav .nav-item:nth-child(3) .nav-link.M11 {
          animation-delay: 0.6s;
        }

        /* Hover elegante: solo color y línea */
        .navbar-nav .nav-item .nav-link.M11:hover {
          color: #ff6600;
        }

        /* Línea animada debajo del link */
        .navbar-nav .nav-item .nav-link.M11::after {
          content: '';
          display: block;
          width: 0;
          height: 3px;
          /* grosor de la línea */
          background: #ff6600;
          transition: width 0.3s ease;
          border-radius: 2px;
          margin-top: 5px;
        }

        .navbar-nav .nav-item .nav-link.M11:hover::after {
          width: 100%;
        }

        /* Espaciado entre links aumentado para mayor separación */
        .navbar-nav .nav-item {
          margin-left: 3rem;
          /* más separación horizontal */
          margin-right: 3rem;
        }

        /* ===== Keyframes de animación al entrar ===== */
        @keyframes slideDown {
          from {
            opacity: 0;
            transform: translateY(-20px);
          }

          to {
            opacity: 1;
            transform: translateY(0);
          }
        }

        /* ===== Responsive ===== */
        @media (max-width: 992px) {
          .navbar-nav .nav-item {
            margin-left: 2rem;
            margin-right: 2rem;
          }
        }

        @media (max-width: 768px) {
          .navbar-nav .nav-item .nav-link.M11 {
            font-size: 0.95rem;
            padding: 8px 0;
          }

          .navbar-nav .nav-item {
            margin-left: 1.5rem;
            margin-right: 1.5rem;
          }
        }

        @media (max-width: 576px) {
          .navbar-nav .nav-item {
            margin-left: 1rem;
            margin-right: 1rem;
          }
        }
      </style>

      <div class="redes position-absolute top-50 end+110 translate-middle-y pe-3"> <img
          src="https://inkarian.com/wp-content/uploads/2023/03/Logo-web512x512.png" class="img-fluid rounded-circle"
          alt="Logo Inkrian" style="width: 150px; height: 80px;"> </div>

      <div class="position-absolute top-50 end-0 translate-middle-y pe-3 d-flex align-items-center">
        <?php if ($logueado): ?>
          <span class="me-3 fw-bold">👋 Hola, <?= htmlspecialchars($nombre) ?>   <?= htmlspecialchars($apellido) ?></span>
          <a href="../app/controllers/cerrar_sesion.php" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
        <?php else: ?>
          <a href="../app/index.php" class="btn btn-outline-primary btn-sm me-2">Inicia sesión</a>
          <a href="#" data-bs-toggle="modal" data-bs-target="#modalRegistro" class="btn btn-success btn-sm">Regístrate</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <!-- Carrusel -->
  <div class="carrusel">
    <div><img src="https://inkarian.com/wp-content/uploads/2023/10/WhatsApp-Image-2023-10-28-at-10.42.30-AM.jpeg"
        alt="Banner 1" class="w-100"></div>
    <div><img src="https://inkarian.com/wp-content/uploads/2023/12/open-graph-3.jpg" alt="Banner 2" class="w-100"></div>
    <div><img src="https://inkarian.com/wp-content/uploads/2023/10/WhatsApp-Image-2023-10-28-at-10.42.30-AM-1.jpeg"
        alt="Banner 3" class="w-100"></div>
    <div><img src="https://inkarian.com/wp-content/uploads/2023/04/WhatsApp-Image-2023-08-01-at-11.40.50-AM.jpeg"
        alt="Banner 4" class="w-100"></div>
  </div>


  <!-- Sección About / Encuestas -->
  <section class="about-encuestas py-5" style="background-color: #f7f7f7;">
    <div class="container">
      <div class="row align-items-center">
        <!-- Columna de texto -->
        <div class="col-lg-6 mb-4 mb-lg-0 texto-animado">
          <h2 class="fw-bold mb-3" style="color:#ff6600;">Inkarián Encuestas</h2>
          <p class="lead text-muted">
            Esta página está dedicada a <strong>encuestas generales para clientes</strong> de la empresa
            <strong>Inkarián</strong>.
            Cada encuesta respondida te otorga <span style="color:#ff6600;font-weight:600;">puntos</span>
            que luego podrás canjear por <strong>descuentos increíbles</strong>.
          </p>
          <ul class="list-unstyled mt-3">
            <li>✅ Responde encuestas rápidas y fáciles</li>
            <li>🎁 Gana puntos por tu participación</li>
            <li>💸 Usa tus puntos para obtener descuentos exclusivos</li>
          </ul>
          <a href="encuestas.php" class="btn btn-warning btn-lg mt-3" data-bs-toggle="modal"
            data-bs-target="#modalRegistro" style="border-radius: 30px;">¡Regístrate y empieza a responder
            encuestas!</a>
        </div>

        <!-- Columna de imagen -->
        <div class="col-lg-6 text-center logo-animado">
          <img src="https://inkarian.com/wp-content/uploads/2023/03/Logo-web512x512.png" alt="Encuestas Inkarián"
            class="img-fluid rounded shadow-lg" style="max-width: 500px;">
        </div>
      </div>
    </div>
  </section>

  <style>
    /* ===== Animación del texto desde la izquierda ===== */
    .texto-animado {
      opacity: 0;
      transform: translateX(-50px);
      animation: slideFromLeft 1s ease-out forwards;
    }

    /* ===== Animación del logo desde la derecha ===== */
    .logo-animado {
      opacity: 0;
      transform: translateX(50px);
      animation: slideFromRight 1s ease-out forwards;
      animation-delay: 0.5s;
      /* Retraso para que el texto aparezca primero */
    }

    /* ===== Keyframes ===== */
    @keyframes slideFromLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideFromRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* ===== Botón animado ===== */
    .about-encuestas .btn-warning {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-encuestas .btn-warning:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .about-encuestas h2 {
        font-size: 1.8rem;
      }

      .about-encuestas .lead {
        font-size: 1rem;
      }

      .about-encuestas img {
        max-width: 300px;
      }
    }
  </style>

  <!-- SECCIÓN BENEFICIOS -->
  <section class="beneficios text-center" data-aos="fade-up">
    <div class="container">
      <h2 class="mb-5" style="color:#ff6600; font-weight:700;">¿Por qué elegir Inkarián?</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="flip-left">
          <div class="beneficio-card">
            <i class="fa-solid fa-gift"></i>
            <h5>Recompensas reales</h5>
            <p>Gana premios por tu tiempo y opiniones valiosas.</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="flip-up">
          <div class="beneficio-card">
            <i class="fa-solid fa-stopwatch"></i>
            <h5>Encuestas rápidas</h5>
            <p>Responde en minutos desde cualquier dispositivo.</p>
          </div>
        </div>
        <div class="col-md-4" data-aos="flip-right">
          <div class="beneficio-card">
            <i class="fa-solid fa-people-group"></i>
            <h5>Comunidad activa</h5>
            <p>Únete a miles de personas que ya disfrutan de Inkarián.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    /* ===== ANIMACIÓN GENERAL AL ABRIR LA PÁGINA ===== */
    .beneficios {
      opacity: 0;
      transform: translateY(40px);
      animation: fadeInUp 1.2s ease-out forwards;
    }

    /* ===== ANIMACIÓN INDIVIDUAL DE LAS TARJETAS ===== */
    .beneficio-card {
      opacity: 0;
      transform: scale(0.9);
      animation: popUp 1s ease-out forwards;
    }

    /* Retraso escalonado para que aparezcan una por una */
    .col-md-4:nth-child(1) .beneficio-card {
      animation-delay: 0.4s;
    }

    .col-md-4:nth-child(2) .beneficio-card {
      animation-delay: 0.7s;
    }

    .col-md-4:nth-child(3) .beneficio-card {
      animation-delay: 1s;
    }

    /* ===== KEYFRAMES ===== */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes popUp {
      from {
        opacity: 0;
        transform: scale(0.9);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    /* ===== ESTILO DE LAS TARJETAS ===== */
    .beneficio-card {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .beneficio-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    /* Íconos dentro de las tarjetas */
    .beneficio-card i {
      font-size: 2.5rem;
      color: #ff6600;
      margin-bottom: 15px;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    /* Efecto al pasar el mouse sobre el ícono */
    .beneficio-card:hover i {
      transform: scale(1.2);
      color: #ff8800;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .beneficio-card {
        padding: 20px;
      }

      .beneficio-card i {
        font-size: 2rem;
      }
    }
  </style>


  <!-- Footer -->
  <?php require_once("default/footer.php"); ?>

  <!-- Modal Registro (al final del body) -->
  <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalRegistroLabel">Registro de Cliente</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form id="formRegistro" action="../app/controllers/ClienteController.php" method="POST" class="row g-3">
            <?php
            inputField("text", "dni_c", "DNI", $errores, $datos);
            inputField("text", "nombre_c", "Nombre", $errores, $datos);
            inputField("text", "apellidos_c", "Apellido", $errores, $datos);
            inputField("email", "correo_c", "Correo electrónico", $errores, $datos);
            inputField("password", "contraseña", "Contraseña", $errores, $datos);
            inputField("text", "telefono_c", "Teléfono", $errores, $datos);
            inputField("text", "lugar_c", "Lugar de Nacimiento", $errores, $datos);
            inputField("date", "fecha_c", "Fecha de Nacimiento", $errores, $datos);
            ?>
            <div class="col-md-12">
              <label class="form-label">Estado Civil</label>
              <select name="estado_c" class="form-control" required>
                <option value="">Seleccione una opción</option>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Viudo">Viudo</option>
                <option value="Conviviente">Conviviente</option>
              </select>
            </div>
            <div class="modal-footer mt-3">
              <input type="hidden" name="accion" value="registrarte">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Registrarte</button>
              <button type="button" class="btn btn-default" id="btnLimpiar"><i class="fa fa-eraser"></i>
                Limpiar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts al final -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

  <script>
    $(document).ready(function () {
      // Inicializar carrusel
      $('.carrusel').slick({
        dots: true,
        infinite: true,
        speed: 1000,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
          breakpoint: 768,
          settings: {
            arrows: false
          }
        }]
      });

      <?php if (!empty($errores)): ?>
        var modalEl = document.getElementById("modalRegistro");
        var myModal = new bootstrap.Modal(modalEl, { backdrop: 'static', keyboard: false });
        myModal.show();

        modalEl.addEventListener('hidden.bs.modal', function () {
          document.querySelectorAll('.modal-backdrop').forEach(function (backdrop) { backdrop.remove(); });
        });
      <?php endif; ?>

      // Botón limpiar formulario
      var btnLimpiar = document.getElementById("btnLimpiar");
      if (btnLimpiar) {
        btnLimpiar.addEventListener("click", function () {
          const form = this.closest("form");
          if (!form) return;
          form.querySelectorAll("input, textarea").forEach(el => el.value = "");
          form.querySelectorAll("select").forEach(el => el.selectedIndex = 0);
          form.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
          form.querySelectorAll(".text-danger").forEach(el => el.innerHTML = "");
        });
      }
    });
  </script>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success text-center">
      <?= htmlspecialchars($success) ?>
    </div>
  <?php endif; ?>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const encuestaLink = document.querySelector("a[href='encuentas.php']");

      if (encuestaLink) {
        encuestaLink.addEventListener("click", function (e) {
          e.preventDefault(); // Evita redirección
          Swal.fire({
            icon: 'warning',
            title: 'Necesitas registrarte',
            text: 'Debes iniciar sesión o registrarte para responder las encuestas.',
            confirmButtonText: 'Registrarme',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              // Redirige al registro
              window.location.href = "#modalRegistro";
              let modal = new bootstrap.Modal(document.getElementById("modalRegistro"));
              modal.show();
            }
          });
        });
      }
    });
  </script>
</body>

</html>