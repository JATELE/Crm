<?php require_once("default/auth.php"); ?>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRM turísticos</title>
  <link rel="stylesheet" href="css/gym.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {

      background: #f0f0f0;

    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-button {
      background-color: #3498db;
      color: white;
      padding: 12px 20px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .dropdown-button:hover {
      background-color: #2980b9;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 180px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      z-index: 1;
      overflow: hidden;
      animation: fadeIn 0.3s ease-in-out;
    }

    .dropdown-content a {
      color: #333;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      transition: background-color 0.2s ease, padding-left 0.2s ease;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
      padding-left: 24px;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
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
  <div class="top-bar">
    🚚 Gana descuentos increibles con tus puntos
  </div>

  <nav class="navbar navbar-expand-lg border-bottom border-body py-4 p-3" style="background-color: #f7f3ec;">
    <div class="container-fluid position-relative">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav justify-content-center" id="navbarContent">
        <ul class="navbar-nav">
          <?php if ($logueado): ?>
            <li class="nav-item mx-5"><a class="nav-link M11" href="EncuestasInkarian.php">Inicio</a></li>
          <?php else: ?>
            <li class="nav-item mx-5"><a class="nav-link M11" href="InicioEncuestasInkarian.php">Inicio</a></li>
          <?php endif; ?>

          <li class="nav-item mx-5"><a class="nav-link M11" href="servicios.php">Servicios</a></li>
          <li class="nav-item mx-5"><a class="nav-link M11" href="encuentas.php">Encuestas</a></li>
        </ul>
      </div>

      <div class="redes position-absolute top-50 end+110 translate-middle-y pe-3">
        <img src="https://inkarian.com/wp-content/uploads/2023/03/Logo-web512x512.png" class="img-fluid rounded-circle"
          alt="Logo Inkrian" style="width: 150px; height: 80px;">
      </div>

      <div class="position-absolute top-50 end-0 translate-middle-y pe-3 d-flex align-items-center">
        <?php if ($logueado): ?>
          <div class="dropdown">
            <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
              data-bs-toggle="dropdown" aria-expanded="false">
              👋 Hola, <?= htmlspecialchars($nombre) ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#">Perfil</a></li>
              <li><a class="dropdown-item" href="#">Puntos: <?= htmlspecialchars($puntos_cliente ?? 0) ?></a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="../app/controllers/cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a href="../app/index.php" class="btn btn-outline-primary btn-sm me-2">Inicia sesión</a>
          <a href="#" data-bs-toggle="modal" data-bs-target="#modalRegistro" class="btn btn-success btn-sm">Regístrate</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <section class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-success">🌍 Servicios Turísticos</h2>
    <div class="row g-4 justify-content-center">

      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-hotel fa-3x mb-3 text-primary"></i>
            <h5 class="card-title fw-bold">Hoteles</h5>
            <p class="card-text">Descansa en los mejores alojamientos de la región con precios accesibles y cómodas
              instalaciones.</p>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">Ver más</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-utensils fa-3x mb-3 text-danger"></i>
            <h5 class="card-title fw-bold">Restaurantes</h5>
            <p class="card-text">Disfruta de una variedad de platos locales e internacionales en los mejores
              restaurantes.</p>
            <a href="#" class="btn btn-outline-danger btn-sm rounded-pill">Ver más</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-route fa-3x mb-3 text-success"></i>
            <h5 class="card-title fw-bold">Planes Turísticos</h5>
            <p class="card-text">Explora rutas únicas con guías especializados y experiencias inolvidables para toda la
              familia.</p>
            <a href="#" class="btn btn-outline-success btn-sm rounded-pill">Ver más</a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-warning">🎁 Recompensas con tus Puntos</h2>
    <p class="text-center text-muted mb-5">
      Responde encuestas, acumula puntos y canjéalos por experiencias y productos increíbles.
      ¡Aquí algunos ejemplos de lo que puedes conseguir!
    </p>

    <div class="row g-4 justify-content-center">



      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-bed fa-3x mb-3 text-primary"></i>
            <h5 class="card-title fw-bold">20% Descuento en Hoteles</h5>
            <p class="card-text">Canjea <strong>500 puntos</strong> y disfruta de una estadía más económica en hoteles
              asociados.</p>
            <span class="badge bg-primary">500 pts</span>
          </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-utensils fa-3x mb-3 text-danger"></i>
            <h5 class="card-title fw-bold">Cena para 2 Personas</h5>
            <p class="card-text">Por <strong>800 puntos</strong> disfruta de una cena en un restaurante seleccionado.
            </p>
            <span class="badge bg-danger">800 pts</span>
          </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-bus fa-3x mb-3 text-success"></i>
            <h5 class="card-title fw-bold">Tour Gratuito</h5>
            <p class="card-text">Canjea <strong>1000 puntos</strong> y accede a un tour guiado por las mejores rutas
              turísticas.</p>
            <span class="badge bg-success">1000 pts</span>
          </div>
        </div>
      </div>


      <div class="col-md-3">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-candy-cane fa-3x mb-3 text-pink"></i>
            <h5 class="card-title fw-bold">Caja de Chocolates</h5>
            <p class="card-text">Endulza tu día con una selección de chocolates.
              <span class="badge bg-warning text-dark">150 pts</span>
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-cookie-bite fa-3x mb-3 text-success"></i>
            <h5 class="card-title fw-bold">Galletas Artesanales</h5>
            <p class="card-text">Un snack perfecto para acompañar tu café.
              <span class="badge bg-warning text-dark">100 pts</span>
            </p>
          </div>
        </div>
      </div>


      <div class="col-md-3">
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body text-center">
            <i class="fas fa-wine-bottle fa-3x mb-3 text-info"></i>
            <h5 class="card-title fw-bold">Gaseosa Personal</h5>
            <p class="card-text">Refresca tu día con tu bebida favorita.
              <span class="badge bg-warning text-dark">50 pts</span>
            </p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <?php require_once("default/footer.php"); ?>
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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const encuestaLink = document.querySelector("a[href='encuentas.php']");

      <?php if (!$logueado): ?>
        if (encuestaLink) {
          encuestaLink.addEventListener("click", function (e) {
            e.preventDefault();
            Swal.fire({
              icon: 'warning',
              title: 'Necesitas registrarte',
              text: 'Debes iniciar sesión o registrarte para responder las encuestas.',
              confirmButtonText: 'Registrarme',
              showCancelButton: true,
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
                let modal = new bootstrap.Modal(document.getElementById("modalRegistro"));
                modal.show();
              }
            });
          });
        }
      <?php endif; ?>
    });
  </script>


  <script>
    $(document).ready(function () {
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
</body>

</html>