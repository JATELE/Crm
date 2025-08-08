<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abarrotes Yuly</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="css/gym.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

  <!-- Scripts -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

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
      background-color: #28a745;
      color: white;
      text-align: center;
      padding: 8px 0;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <!-- Top bar -->
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
          <li class="nav-item mx-5"><a class="nav-link M11" href="iniciotienda.php">Inicio</a></li>
          <li class="nav-item mx-5"><a class="nav-link M11" href="Abarrotes.php">Servicios</a></li>
          <li class="nav-item mx-5"><a class="nav-link M11" href="Conocenos.php">Encuesta</a></li>
        </ul>
      </div>
      <div class="redes position-absolute top-50 end-0 translate-middle-y pe-3">
        <a class="nav-item mx-0" href="../app/index.php">Inicia sesión </a>
        <a class="nav-item mx-0" href="../app/indexRegister.php">Registrate</a>
      </div>

    </div>
  </nav>

  <!-- Carrusel principal con slick -->
  <div class="carrusel">
    <div><img src="img/composition-from-various-vegetables-wooden-tabletop.jpg" alt="Banner 1" class="w-100"></div>
    <div><img src="img/fast-rocketpropelled-shopping-cart-flying-260nw-2264355237.webp" alt="Banner 2" class="w-100">
    </div>
    <div><img src="img/top-view-copy-space-colored-bell-peppers-with-broccoli-wooden-background.jpg" alt="Banner 3"
        class="w-100"></div>
    <div><img src="img/top-view-food-donation-with-fruits-other-provisions.jpg" alt="Banner 4" class="w-100"></div>
  </div>

  <script>
    $(document).ready(function () {
      $('.carrusel').slick({
        dots: true,
        infinite: true,
        speed: 3000,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 1000,
        responsive: [{
          breakpoint: 768,
          settings: {
            arrows: false
          }
        }]
      });
    });
  </script>

  <div class="carousel-categorias">
    <?php
    $categorias = [
      ["img" => "img/abarrotes.png", "href" => "Abarrotes.php", "label" => "Ver Abarrotes"],
      ["img" => "img/vegetales.png", "href" => "Vegetales.php", "label" => "Ver Vegetales"],
      ["img" => "img/cuidado.png", "href" => "AseoPersonal.php", "label" => "Ver Aseo Personal"],
      ["img" => "img/ChatGPT Image 29 may 2025, 21_47_08.png", "href" => "Menestras.php", "label" => "Ver Menestras"],
      ["img" => "img/ChatGPT Image 29 may 2025, 21_45_24.png", "href" => "Vegetales.php", "label" => "Ver Lácteos y Embutidos"],
      ["img" => "img/bedida.png", "href" => "index.html", "label" => "Ver Bebidas"]
    ];
    foreach ($categorias as $cat) {
      echo '
    <div class="categoria-slide text-center p-3">
      <img src="' . $cat['img'] . '" class="rounded-circle shadow mx-auto" style="width: 150px; height: 150px;" alt="">
      <a href="' . $cat['href'] . '" class="btn btn-success mt-3 rounded-pill fw-bold d-block mx-auto" style="width: 160px;">' . $cat['label'] . '</a>
    </div>';
    }
    ?>
  </div>
  </div>

  <!-- Controles -->
 


  <!-- Footer -->
  <?php require_once("default/footer.php"); ?>
  <script>
    $(document).ready(function () {
      $('.carousel-categorias').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: true,
        dots: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              arrows: false
            }
          }
        ]
      });
    });
  </script>
  
</body>

</html>