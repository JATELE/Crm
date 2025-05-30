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
    background-image: url('https://wallpapers.com/images/hd/teamwork-1920-x-1280-background-qo4zfogji84971wi.jpg');
    background-size: cover;
    background-position: center;
    height: 350px;
    position: relative;
  }

  .header-banner .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.45); /* Oscurece ligeramente la imagen */
    z-index: 0;
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
    <h1 class="fw-bold display-5">Trabaja con Nosotros</h1>
    <p class="fs-5">Construye tu futuro junto a Bodega July Company</p>
  </div>
</header>


<main class="main-content py-5" style="background-color: #f1f6f5;">
  <div class="container">
    <div class="row g-4">
      <!-- Columna izquierda -->
      <div class="col-lg-6">
        <div class="p-4 bg-white shadow rounded-4 h-100">
          <h3 class="fw-bold mb-3">¿Por Qué Unirte?</h3>
          <div class="d-flex mb-3">
            <div class="me-3 text-success fs-3"><i class="bi bi-people-fill"></i></div>
            <div>
              <strong>Ambiente Colaborativo:</strong>
              <p class="mb-0 text-muted">Tu voz cuenta y el trabajo en equipo es nuestra base.</p>
            </div>
          </div>
          <div class="d-flex mb-3">
            <div class="me-3 text-primary fs-3"><i class="bi bi-graph-up"></i></div>
            <div>
              <strong>Desarrollo Profesional:</strong>
              <p class="mb-0 text-muted">Capacitación constante y oportunidades de crecimiento.</p>
            </div>
          </div>
          <div class="d-flex mb-3">
            <div class="me-3 text-warning fs-3"><i class="bi bi-globe"></i></div>
            <div>
              <strong>Impacto Positivo:</strong>
              <p class="mb-0 text-muted">Contribuye a una empresa comprometida con la comunidad.</p>
            </div>
          </div>
          <div class="d-flex">
            <div class="me-3 text-danger fs-3"><i class="bi bi-heart-fill"></i></div>
            <div>
              <strong>Cultura Inclusiva:</strong>
              <p class="mb-0 text-muted">Valoramos la diversidad y fomentamos el respeto.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Columna derecha -->
      <div class="col-lg-6">
        <div class="p-4 bg-white shadow rounded-4 h-100">
          <h3 class="fw-bold mb-3">Tu Oportunidad Empieza Aquí</h3>
          <p class="text-muted">
            En Bodega July Company, ofrecemos vacantes en múltiples áreas: atención al cliente, ventas, logística, administración y más. ¡Explora lo que tenemos para ti!
          </p>
          <div class="text-center my-4">
            <a href="https://wa.me/51906328260" class="btn btn-outline-success px-4 py-2">Ver Vacantes</a>
          </div>
          <h4 class="fw-bold">Nuestro Proceso de Selección</h4>
          <p class="text-muted">
            Envíanos tu CV, pasa por una entrevista personalizada y prepárate para integrarte a un equipo que te valora. ¡Estamos listos para conocerte!
          </p>
        </div>
      </div>
    </div>
  </div>
</main>




  <?php require_once("default/footer.php") ?>
</body>

</html>