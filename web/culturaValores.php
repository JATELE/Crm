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
   
  <main class="main-content py-5" style="background-color: #f1f6f5;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <!-- Título principal -->
        <div class="text-center mb-5">
          <h2 class="fw-bold">Nuestra Cultura</h2>
          <p class="text-muted fs-5">
            En Bodega July Company, nuestra cultura es el corazón de todo lo que hacemos. Fomentamos la innovación, la colaboración y el respeto mutuo como pilares del éxito. 
            Creemos en el poder de la comunidad y en fortalecer nuestras relaciones con clientes, empleados y socios.
          </p>
        </div>

        <!-- Valores en tarjetas -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-body bg-white rounded-3">
            <h3 class="fw-bold mb-4 text-center">Nuestros Valores</h3>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <strong>Integridad:</strong> Actuamos con honestidad y transparencia, guiados por altos estándares éticos.
              </li>
              <li class="list-group-item">
                <strong>Calidad:</strong> Nos enfocamos en brindar productos y servicios excepcionales que superen las expectativas.
              </li>
              <li class="list-group-item">
                <strong>Innovación:</strong> Adoptamos el cambio, exploramos nuevas ideas y mejoramos constantemente.
              </li>
              <li class="list-group-item">
                <strong>Responsabilidad Social:</strong> Buscamos generar un impacto positivo, apoyando a nuestras comunidades y al medio ambiente.
              </li>
              <li class="list-group-item">
                <strong>Trabajo en Equipo:</strong> Valoramos la diversidad y fomentamos un ambiente inclusivo y colaborativo.
              </li>
            </ul>
          </div>
        </div>

        <!-- Nuestra Promesa -->
        <div class="card shadow-sm border-0">
          <div class="card-body bg-white rounded-3">
            <h3 class="fw-bold text-center mb-3">Nuestra Promesa</h3>
            <p class="text-muted fs-5 text-center">
              En Bodega July Company, no solo vendemos productos, creamos experiencias. Nuestra cultura y valores nos impulsan a ser un socio confiable para nuestros clientes y un lugar donde nuestro equipo puede crecer y prosperar.
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>


  <?php require_once("default/footer.php") ?>
</body>

</html>