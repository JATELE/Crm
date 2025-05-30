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
    background-image: url('https://static.vecteezy.com/system/resources/previews/034/078/501/non_2x/shopping-cart-full-of-product-in-grocery-store-generative-ai-photo.jpg');
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
    <h1 class="fw-bold display-5">Nuestra Compañía</h1>
    <p class="fs-5">Tradición, calidad e innovación peruana</p>
  </div>
</header>

<!-- Contenido principal -->
<main class="main-content py-5" style="background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <section class="mb-5">
          <h2 class="text-primary fw-semibold">¿Quiénes Somos?</h2>
          <p>Fundada en el corazón de Perú, <strong>Bodega July Company</strong> es una empresa dedicada a ofrecer productos de calidad que enriquecen la vida de nuestros clientes. Desde nuestros inicios, hemos trabajado con pasión para construir una marca que combine tradición, innovación y un compromiso inquebrantable con la excelencia.</p>
        </section>

        <section class="mb-5">
          <h2 class="text-primary fw-semibold">Nuestra Historia</h2>
          <p>Nacimos con la visión de conectar a las personas con productos esenciales a través de una experiencia de compra confiable y accesible. Desde una operación local hasta convertirnos en un referente en el mercado peruano, mantenemos nuestros valores de integridad y servicio al cliente.</p>
        </section>

        <section class="mb-5">
          <div class="row g-4">
            <div class="col-md-6">
              <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                  <h4 class="card-title text-success">Nuestra Misión</h4>
                  <p class="card-text">Facilitar el acceso a productos de alta calidad, satisfaciendo las necesidades de nuestros clientes mientras promovemos la sostenibilidad y el impacto positivo en las comunidades donde operamos.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                  <h4 class="card-title text-success">Nuestra Visión</h4>
                  <p class="card-text">Ser la empresa líder en el mercado peruano, reconocida por nuestra innovación, calidad y compromiso con el bienestar de nuestros clientes, empleados y socios.</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="mb-5">
          <h2 class="text-primary fw-semibold">Nuestro Compromiso</h2>
          <p>En <strong>Bodega July Company</strong>, nos esforzamos por superar las expectativas. Desde la selección de productos hasta el servicio al cliente, cada detalle está diseñado para ofrecer una experiencia excepcional. Estamos comprometidos con la sostenibilidad, la ética y el fortalecimiento de las comunidades locales.</p>
          <p><a href="#" class="btn btn-outline-primary mt-2">Contáctanos para saber más</a></p>
        </section>

      </div>
    </div>
  </div>
</main>





  <?php require_once("default/footer.php") ?>
</body>

</html>