<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abarrotes Yuly</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/gym.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .carousel-indicators [data-bs-target] {
      width: 12px !important;
      height: 12px !important;
      border-radius: 50% !important;
      background-color: #28a745 !important;
      border: none !important;
      opacity: 0.5 !important;
      margin: 0 4px !important;
    }
    
    .carousel-indicators .active {
      opacity: 1 !important;
      background-color: #145c2a !important;
    }
    .header-banner {
    background-image: url('https://mapamentalweb.com/wp-content/uploads/2020/06/mapa-mental-etica-ni%C3%B1os.jpg');
    background-size: cover;
    background-position: center;
    height: 320px;
    position: relative;
  }

  .header-banner .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.45);
    z-index: 0;
  }

  .z-1 {
    z-index: 1;
  }
    </style>
    
</head>

<body style="background-color: #f1f6f5;">
  <div class="top-bar">
    ¡🚚 ¡Envío gratuito a partir de S/. 150! 💬 WhatsApp: +51 906328260
  </div>

  <?php require_once("default/navigation.php") ?>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false
            }
          }
        ]
      });
    });

  </script>
    


<header class="header-banner d-flex align-items-center justify-content-center text-white text-center">
  <div class="overlay"></div>
  <div class="z-1 position-relative">
    <h1 class="fw-bold display-5">Línea y Ética</h1>
    <p class="fs-5">Comprometidos con la integridad y la transparencia</p>
  </div>
</header>

<!-- Contenido principal -->
<main class="main-content py-5" style="background-color: #f1f6f5;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <section class="mb-5">
          <h2 class="text-primary fw-semibold">Nuestro Compromiso con la Ética</h2>
          <p>En <strong>Bodega July Company</strong>, la ética es la base de nuestras operaciones. Nos esforzamos por mantener los más altos estándares de integridad en todas nuestras acciones, asegurando que nuestras decisiones y prácticas reflejen nuestros valores fundamentales.</p>
        </section>

        <section class="mb-5">
          <h2 class="text-primary fw-semibold">Nuestra Línea Ética</h2>
          <p>Hemos establecido una Línea Ética para garantizar un entorno transparente y seguro. Este canal permite reportar cualquier preocupación de forma confidencial y sin temor a represalias.</p>
          <div class="card bg-white shadow-sm border-0 p-3">
            <h5 class="mb-3 text-dark">¿Cómo funciona?</h5>
            <ul class="list-unstyled">
              <li><strong>📞 Teléfono:</strong> (COD) 779-010</li>
              <li><strong>📧 Correo:</strong> <a href="#">etica@bodegajulycompany.com</a></li>
              
            </ul>
            <p class="mb-0">Todos los reportes se manejan con confidencialidad y son evaluados por un equipo especializado.</p>
          </div>
        </section>

        <section class="mb-5">
          <h2 class="text-primary fw-semibold">Nuestros Principios Éticos</h2>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="card border-0 shadow-sm p-3 h-100">
                <h5 class="text-success">Transparencia</h5>
                <p>Operamos con claridad para fomentar la confianza en todas nuestras relaciones.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card border-0 shadow-sm p-3 h-100">
                <h5 class="text-success">Respeto</h5>
                <p>Promovemos un entorno inclusivo y valoramos la diversidad de cada individuo.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card border-0 shadow-sm p-3 h-100">
                <h5 class="text-success">Responsabilidad</h5>
                <p>Asumimos nuestras decisiones con compromiso social y ambiental.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card border-0 shadow-sm p-3 h-100">
                <h5 class="text-success">Cumplimiento</h5>
                <p>Respetamos las leyes y aplicamos nuestros propios códigos de conducta.</p>
              </div>
            </div>
          </div>
        </section>

        <section>
          <h2 class="text-primary fw-semibold">Nuestra Promesa</h2>
          <p>En <strong>Bodega July Company</strong>, actuar con ética es una oportunidad para construir relaciones duraderas. Nuestra Línea Ética y nuestros principios nos guían para ser una empresa confiable, comprometida y transparente.</p>
        </section>

      </div>
    </div>
  </div>
</main>

  <?php require_once("default/footer.php") ?>
</body>

</html>