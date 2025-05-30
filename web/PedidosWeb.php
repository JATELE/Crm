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
    <main></main>
  <header style="text-align: center ; background-color: #f1f6f5;">
    <h1>Pedidos por la Web</h1>
  </header>

<!-- Contenido principal -->
<main class="main-content py-4" style="background-color: #f1f6f5;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Compra Fácil y Rápida desde Nuestra Web</h2>
      <p class="text-muted">Adquiere tus productos favoritos desde casa con Bodega July Company. ¡Rápido, seguro y sin complicaciones!</p>
    </div>

    <div class="row mb-5">
      <div class="col-md-12">
        <div class="card shadow-sm border-0">
          <div class="card-body bg-white rounded-3">
            <h4 class="card-title mb-3">Cómo Realizar un Pedido</h4>
            <ol class="list-group list-group-numbered">
              <li class="list-group-item">
                <strong>Explora nuestro catálogo:</strong> Visita la sección de <a href="../../abarrotes.html" class="text-decoration-underline">Productos</a> y descubre nuestra amplia selección.
              </li>
              <li class="list-group-item">
                <strong>Agrega al carrito:</strong> Selecciona los productos que deseas y añádelos al carrito de compras.
              </li>
              <li class="list-group-item">
                <strong>Revisa tu pedido:</strong> Verifica los artículos, ajusta cantidades y procede al pago.
              </li>
              <li class="list-group-item">
                <strong>Ingresa tus datos:</strong> Proporciona tu información de envío y selecciona tu método de pago.
              </li>
              <li class="list-group-item">
                <strong>Confirma tu compra:</strong> Revisa los detalles y finaliza tu pedido. ¡Recibirás una confirmación por correo!
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="row text-center mb-5">
      <h4 class="fw-bold mb-4">Beneficios de Comprar en Línea</h4>
      <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body bg-white rounded-3">
            <i class="bi bi-truck fs-1 text-success"></i>
            <h5 class="card-title mt-3">Envío Gratuito</h5>
            <p class="card-text text-muted">Gratis en pedidos desde S/. 150.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body bg-white rounded-3">
            <i class="bi bi-shield-lock fs-1 text-primary"></i>
            <h5 class="card-title mt-3">Pago Seguro</h5>
            <p class="card-text text-muted">Aceptamos tarjetas y transferencias bancarias.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body bg-white rounded-3">
            <i class="bi bi-box-seam fs-1 text-warning"></i>
            <h5 class="card-title mt-3">Seguimiento</h5>
            <p class="card-text text-muted">Sigue tu pedido en tiempo real desde tu cuenta.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body bg-white rounded-3">
            <i class="bi bi-headset fs-1 text-danger"></i>
            <h5 class="card-title mt-3">Atención Personalizada</h5>
            <p class="card-text text-muted">Contáctanos por WhatsApp: <br>+51 906328260<br>Tel: (COD) 779-009</p>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-5 text-center">
      <h4 class="fw-bold">Preguntas Frecuentes</h4>
      <p class="text-muted">¿Dudas sobre el proceso de compra? Visita nuestra sección de <a href="#">Preguntas Frecuentes</a> o contáctanos directamente.</p>
    </div>

    <div class="text-center">
      <h4 class="fw-bold">¡Empieza Ahora!</h4>
      <p class="text-muted">Explora nuestro catálogo y realiza tu pedido hoy mismo. Estamos comprometidos a que tu experiencia sea satisfactoria.</p>
      <a href="../../abarrotes.html" class="btn btn-primary px-4 py-2">Ver productos</a>
    </div>
  </div>
</main>

  <?php require_once("default/footer.php") ?>
</body>

</html>