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
</head>

<body>
  <div class="top-bar">
    <div class="moving-text">
      🚚 ¡Gana <span class="highlight">descuentos increíbles</span> con tus puntos! 🎁
      🚀 Canjea y ahorra en tus compras favoritas 💳
    </div>
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
    <div class="row g-4 justify-content-center">
      <div class="col-md-8">
        <h3 class="text-center mb-4 titulo-imagen">Planes turísticos</h3>
        <p class="text-center text-muted mb-5">
          Explora los mejores servicios turísticos en Ucayali. Desde alojamientos confortables hasta experiencias
          inolvidables, todo al alcance de un clic.
        </p>

        <style>
          .titulo-imagen {
            font-size: 3rem;
            /* Tamaño grande */
            font-weight: 900;
            /* Muy grueso */
            background: url('img/pucallpa.jpg') no-repeat center/cover;
            /* Imagen de fondo */
            -webkit-background-clip: text;
            /* Safari/Chrome */
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
            text-transform: uppercase;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
          }
        </style>



        <div class="row g-4 justify-content-center">

          <section class="container my-5">


            <!-- Tours -->
            <div class="row align-items-center mb-5 bg-light p-4 rounded-4 shadow-sm flex-wrap">
              <div class="col-12 col-md-6 d-flex justify-content-center mb-3 mb-md-0">
                <!-- 🔹 Video adaptable -->
                <div class="video-container">
                  <video autoplay muted loop playsinline>
                    <source src="img/tour.mp4" type="video/mp4">
                    Tu navegador no soporta la reproducción de video.
                  </video>
                </div>
              </div>

              <div class="col-12 col-md-6 text-center text-md-start">
                <h4 class="fw-bold text-primary">Tours y Excursiones</h4>
                <ul class="list-unstyled">
                  <li>✅ Tours culturales y históricos</li>
                  <li>✅ Aventuras eco-turísticas</li>
                  <li>✅ Recorridos gastronómicos</li>
                  <li>✅ Excursiones personalizadas</li>
                  <li>✅ Guías expertos locales</li>
                </ul>
                <a href="#" class="btn btn-outline-primary mt-3 rounded-pill">Ver Tours Disponibles</a>
              </div>
            </div>


            <!-- 🔸 Estilos -->
            <style>
              .video-container {
                position: relative;
                width: 300%;
                max-width: 600px;
                /* tamaño máximo en pantallas grandes */
                aspect-ratio: 3 / 2;
                /* mantiene proporción 300x200 */
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
              }

              .video-container video {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                border-radius: 15px;
                background-color: #000;
              }

              /* 📱 En celular, se centra el video y el texto va debajo */
              @media (max-width: 768px) {
                .video-container {
                  max-width: 90%;
                  margin: 0 auto 15px;
                }

                .row.align-items-center {
                  text-align: center;
                }
              }
            </style>



            <!-- Hoteles -->
            <div class="row align-items-center mb-5 bg-light p-4 rounded-4 shadow-sm flex-md-row-reverse">
              <div class="col-12 col-md-6 d-flex justify-content-center mb-3 mb-md-0">
                <!-- 🔹 Video adaptable -->
                <div class="video-container">
                  <video autoplay muted loop playsinline>
                    <source src="img/hospedaje.mp4" type="video/mp4">
                    Tu navegador no soporta la reproducción de video.
                  </video>
                </div>
              </div>

              <div class="col-md-6">
                <h4 class="fw-bold text-primary">Hospedaje</h4>
                <ul class="list-unstyled">
                  <li>✅ Hoteles 4 y 5 estrellas</li>
                  <li>✅ Boutique y resorts exclusivos</li>
                  <li>✅ Mejores tarifas garantizadas</li>
                  <li>✅ Reservas instantáneas</li>
                  <li>✅ Asistencia 24/7</li>
                </ul>
                <a href="#" class="btn btn-outline-success mt-3 rounded-pill">Buscar Hoteles</a>
              </div>
            </div>

            <!-- Restaurantes -->
            <div class="row align-items-center mb-5 bg-light p-4 rounded-4 shadow-sm">
              <div class="col-12 col-md-6 d-flex justify-content-center mb-3 mb-md-0">
                <!-- 🔹 Video adaptable -->
                <div class="video-container">
                  <video autoplay muted loop playsinline>
                    <source src="img/gastronomia.mp4" type="video/mp4">
                    Tu navegador no soporta la reproducción de video.
                  </video>
                </div>
              </div>
              <div class="col-md-6">
                <h4 class="fw-bold text-primary">Experiencias Gastronómicas</h4>
                <ul class="list-unstyled">
                  <li>✅ Reservas en restaurantes exclusivos</li>
                  <li>✅ Tours culinarios guiados</li>
                  <li>✅ Clases de cocina tradicional</li>
                  <li>✅ Degustaciones premium</li>
                  <li>✅ Recomendaciones personalizadas</li>
                </ul>
                <a href="#" class="btn btn-outline-warning mt-3 rounded-pill">Descubrir Restaurantes</a>
              </div>
            </div>

            <!-- Viajes -->
            <section class="py-5">
              <div class="container">
                <div class="row align-items-center mb-5 bg-light p-4 rounded-4 shadow-sm flex-wrap">

                  <!-- 🔹 Texto a la izquierda -->
                  <div class="col-12 col-md-6 text-center text-md-start">
                    <h4 class="fw-bold text-success">Viajes Inolvidables</h4>
                    <ul class="list-unstyled">
                      <li>✅ Paquetes nacionales e internacionales</li>
                      <li>✅ Viajes en familia o pareja</li>
                      <li>✅ Experiencias únicas</li>
                      <li>✅ Alojamientos exclusivos</li>
                      <li>✅ Atención personalizada</li>
                    </ul>
                    <a href="#" class="btn btn-outline-success mt-3 rounded-pill">Ver Viajes</a>
                  </div>

                  <!-- 🔹 Video o imagen a la derecha -->
                  <div class="col-12 col-md-6 d-flex justify-content-center mb-3 mb-md-0 order-md-last">
                    <div class="video-container">
                      <video autoplay muted loop playsinline>
                        <source src="img/viaje.mp4" type="video/mp4">
                        Tu navegador no soporta la reproducción de video.
                      </video>
                    </div>
                  </div>

                </div>
              </div>
            </section>


            <!-- 🌟 SECCIÓN RECOMPENSAS -->
            <section class="py-5" style="background-color: #f0f0f0;">
              <div class="container text-center position-relative">
                <h2 class="fw-bold mb-5 titulo-imagen">Explora tus recompensas</h2>

                <!-- 🔹 Carrusel -->
                <div id="recompensasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                  <div class="carousel-inner">

                    <!-- 🔸 Grupo 1 -->
                    <div class="carousel-item active">
                      <div class="row justify-content-center">
                        <!-- Hotel -->
                        <div class="col-md-4 col-sm-6 mb-3">
                          <div class="reward-card mx-auto">
                            <div class="reward-img-container">
                              <img src="img/hotel.jpg" class="reward-img" alt="Hoteles">
                            </div>
                            <div class="reward-body text-start">
                              <h5 class="fw-bold mb-1">20% Descuento en Hoteles</h5>
                              <p class="text-muted small mb-2">
                                Canjea <strong>500 puntos</strong> y disfruta de una estadía más económica en hoteles
                                asociados.
                              </p>
                              <span class="price">500 pts</span>
                            </div>
                          </div>
                        </div>

                        <!-- Cena -->
                        <div class="col-md-4 col-sm-6 mb-3">
                          <div class="reward-card mx-auto">
                            <div class="reward-img-container">
                              <img src="img/cena.jpg" class="reward-img" alt="Cena para 2">
                            </div>
                            <div class="reward-body text-start">
                              <h5 class="fw-bold mb-1">Cena para 2 Personas</h5>
                              <p class="text-muted small mb-2">
                                Por <strong>800 puntos</strong> disfruta de una cena en un restaurante seleccionado.
                              </p>
                              <span class="price">800 pts</span>
                            </div>
                          </div>
                        </div>

                        <!-- Tour -->
                        <div class="col-md-4 col-sm-6 mb-3">
                          <div class="reward-card mx-auto">
                            <div class="reward-img-container">
                              <img src="img/ruta.jpg" class="reward-img" alt="Tour Gratuito">
                            </div>
                            <div class="reward-body text-start">
                              <h5 class="fw-bold mb-1">Tour Gratuito</h5>
                              <p class="text-muted small mb-2">
                                Canjea <strong>1000 puntos</strong> y accede a un tour guiado por las mejores rutas
                                turísticas.
                              </p>
                              <span class="price">1000 pts</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- 🔸 Grupo 2 -->
                    <div class="carousel-item">
                      <div class="row justify-content-center">
                        <!-- Chocolates -->
                        <div class="col-md-4 col-sm-6 mb-3">
                          <div class="reward-card mx-auto">
                            <div class="reward-img-container">
                              <img src="img/chocolate.jpg" class="reward-img" alt="Chocolates">
                            </div>
                            <div class="reward-body text-start">
                              <h5 class="fw-bold mb-1">Caja de Chocolates</h5>
                              <p class="text-muted small mb-2">
                                Endulza tu día con una selección de chocolates artesanales.
                              </p>
                              <span class="price">150 pts</span>
                            </div>
                          </div>
                        </div>

                        <!-- Galletas -->
                        <div class="col-md-4 col-sm-6 mb-3">
                          <div class="reward-card mx-auto">
                            <div class="reward-img-container">
                              <img src="img/galletas.jpg" class="reward-img" alt="Galletas">
                            </div>
                            <div class="reward-body text-start">
                              <h5 class="fw-bold mb-1">Galletas Artesanales</h5>
                              <p class="text-muted small mb-2">
                                Un snack perfecto para acompañar tu café o té favorito.
                              </p>
                              <span class="price">100 pts</span>
                            </div>
                          </div>
                        </div>

                        <!-- Bebida -->
                        <div class="col-md-4 col-sm-6 mb-3">
                          <div class="reward-card mx-auto">
                            <div class="reward-img-container">
                              <img src="img/bebida.jpg" class="reward-img" alt="Bebida">
                            </div>
                            <div class="reward-body text-start">
                              <h5 class="fw-bold mb-1">Bebida Personal</h5>
                              <p class="text-muted small mb-2">
                                Refresca tu día con tu bebida favorita en presentación individual.
                              </p>
                              <span class="price">50 pts</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- 🔹 Flechas fuera del carrusel -->
                  <button class="carousel-control-prev custom-prev" type="button" data-bs-target="#recompensasCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  </button>
                  <button class="carousel-control-next custom-next" type="button" data-bs-target="#recompensasCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  </button>
                </div>
              </div>
            </section>

            <!-- 🌈 ESTILOS -->
            <style>
              /* 🌟 Tarjetas principales */
              .reward-card {
                background: #e6dedeff;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                height: 100%;
                transition: box-shadow 0.3s ease;
                display: flex;
                flex-direction: column;
              }

              .reward-card:hover {
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
              }

              /* 🔹 Imagen con efecto zoom */
              .reward-img-container {
                overflow: hidden;
                height: 180px;
              }

              .reward-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
              }

              .reward-card:hover .reward-img {
                transform: scale(1.08);
              }

              /* 🔹 Cuerpo de la tarjeta */
              .reward-body {
                flex-grow: 1;
                padding: 15px;
                min-height: 150px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
              }

              .price {
                color: #f7941d;
                font-weight: bold;
                font-size: 1rem;
                margin-top: auto;
              }

              /* 🌟 Flechas personalizadas */
              .carousel-control-prev.custom-prev,
              .carousel-control-next.custom-next {
                width: 5%;
                top: 50%;
                transform: translateY(-50%);
                opacity: 0.8;
                transition: all 0.3s ease;
              }

              .carousel-control-prev.custom-prev {
                left: -60px;
              }

              .carousel-control-next.custom-next {
                right: -60px;
              }

              .carousel-control-prev-icon,
              .carousel-control-next-icon {
                filter: invert(1);
                width: 2rem;
                height: 2rem;
              }

              .carousel-control-prev:hover,
              .carousel-control-next:hover {
                opacity: 1;
                transform: scale(1.1) translateY(-50%);
              }

              /* 🌟 Responsivo móvil */
              @media (max-width: 768px) {
                .carousel-control-prev.custom-prev {
                  left: -35px;
                }

                .carousel-control-next.custom-next {
                  right: -35px;
                }

                .reward-img-container {
                  height: 150px;
                }

                .price {
                  font-size: 0.85rem;
                }
              }
            </style>

            <!-- ⚙️ SCRIPT -->
            <script>
              const btn = document.getElementById('toggleServicesBtn');
              const extraServices = document.querySelectorAll('.extra-service');
              btn.addEventListener('click', () => {
                const show = extraServices[0].style.display === 'none';
                extraServices.forEach(el => el.style.display = show ? 'block' : 'none');
                btn.textContent = show ? 'Ver menos' : 'Ver más';
              });
            </script>


            <!-- 🎨 ESTILOS -->
            <style>
              .offer-card {
                position: relative;
                height: 300px;
                border-radius: 20px;
                overflow: hidden;
                background-size: cover;
                background-position: center;
                transition: transform 0.4s ease, box-shadow 0.4s ease;
                cursor: pointer;
              }

              .offer-card:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
              }

              .offer-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                transition: background 0.3s ease;
              }

              .offer-card:hover .offer-overlay {
                background: rgba(0, 0, 0, 0.6);
              }

              .offer-content {
                position: absolute;
                bottom: 0;
                color: #f7e6e6ff;
                text-align: left;
                padding: 20px;
                width: 100%;
                background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
              }

              .offer-content h5 {
                font-size: 1.3rem;
                margin-bottom: 8px;
              }

              .offer-content p {
                font-size: 0.95rem;
                margin-bottom: 10px;
              }

              .price {
                background: rgba(255, 255, 255, 0.2);
                padding: 6px 12px;
                border-radius: 8px;
                font-weight: bold;
                font-size: 0.9rem;
              }

              #toggleServicesBtn {
                background-color: #007bff;
                border: none;
                border-radius: 25px;
                padding: 10px 25px;
                transition: all 0.3s ease;
              }

              #toggleServicesBtn:hover {
                background-color: #0056b3;
                transform: scale(1.05);
              }
            </style>

            <!-- ⚙️ SCRIPT -->
            <script>
              const btn = document.getElementById('toggleServicesBtn');
              const extraServices = document.querySelectorAll('.extra-service');
              btn.addEventListener('click', () => {
                const show = extraServices[0].style.display === 'none';
                extraServices.forEach(el => el.style.display = show ? 'block' : 'none');
                btn.textContent = show ? 'Ver menos' : 'Ver más';
              });
            </script>


            <style>
              .offer-card {
                position: relative;
                background-size: cover;
                background-position: center;
                height: 300px;
                border-radius: 20px;
                overflow: hidden;
                cursor: pointer;
                transition: transform 0.5s ease, box-shadow 0.5s ease;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
              }

              .offer-card:hover {
                transform: scale(1.05);
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
              }

              .offer-content {
                position: absolute;
                bottom: 0;
                width: 100%;
                padding: 20px;
                background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
                color: white;
                text-align: left;
              }

              .offer-content h5 {
                margin-bottom: 5px;
                font-size: 1.3rem;
              }

              .offer-content p {
                font-size: 0.95rem;
                margin-bottom: 8px;
              }

              .price {
                font-size: 1.1rem;
                font-weight: bold;
                background: rgba(255, 255, 255, 0.2);
                padding: 5px 10px;
                border-radius: 8px;
                display: inline-block;
              }

              .titulo-imagen {
                font-size: 3rem;
                font-weight: 900;
                background: url('img/pucallpa.jpg') no-repeat center/cover;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent;
                text-transform: uppercase;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
              }
            </style>

            <script>
              const btn = document.getElementById('toggleServicesBtn');
              const extraServices = document.querySelectorAll('.extra-service');

              btn.addEventListener('click', () => {
                const isHidden = extraServices[0].style.display === 'none';
                extraServices.forEach(el => {
                  el.style.display = isHidden ? 'block' : 'none';
                });
                btn.textContent = isHidden ? 'Ver menos' : 'Ver más';
              });
            </script>


            <style>
              .service-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: pointer;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
              }

              .service-card:hover,
              .service-card:focus-within {
                transform: translateY(-8px);
                box-shadow: 0 12px 25px rgba(29, 78, 216, 0.3);
                outline: none;
              }

              .service-card i {
                font-size: 3rem;
                display: block;
                margin: 0 auto 15px;
              }
            </style>

            <script>
              const btn = document.getElementById('toggleServicesBtn');
              const extraServices = document.querySelectorAll('.extra-service');

              btn.addEventListener('click', () => {
                const isHidden = extraServices[0].style.display === 'none';

                extraServices.forEach(el => {
                  el.style.display = isHidden ? 'block' : 'none';
                });

                btn.textContent = isHidden ? 'Ver menos' : 'Ver más';
              });
            </script>

            </p>
        </div>
      </div>
    </div>
    </div>
  </section>

  <style>
    /* Todos los íconos de las tarjetas uniformes y centrados */
    .card-body i {
      font-size: 3rem;
      /* mismo tamaño para todos */
      display: block;
      /* que cada ícono sea un bloque */
      margin: 0 auto 15px;
      /* centrado horizontal y espacio inferior */
    }

    .titulo-imagen {
      font-size: 3rem;
      /* Tamaño grande */
      font-weight: 900;
      /* Muy grueso */
      background: url('img/pucallpa.jpg') no-repeat center/cover;
      /* Imagen de fondo */
      -webkit-background-clip: text;
      /* Safari/Chrome */
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: transparent;
      text-transform: uppercase;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
      text-align: center;
      /* centrado de "Explora Ucayali" */
    }
  </style>
  <style>
    /* Solo para centrar el título de recompensas */
    .titulo-imagen {
      font-size: 3rem;
      font-weight: 900;
      background: url('img/pucallpa.jpg') no-repeat center/cover;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: transparent;
      text-transform: uppercase;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
    }
  </style>


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