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
            height: 260px;
            position: relative;
        }

        .header-banner .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .z-1 {
            z-index: 1;
        }

        footer {
            font-size: 0.9rem;
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



    <header class="header-banner d-flex flex-column justify-content-center align-items-center text-white text-center">
  <div class="overlay"></div>
  <div class="z-1 position-relative">
    <h1 class="fw-bold display-5">Política de Privacidad</h1>
    <p class="lead">Comprometidos con tu seguridad y confianza</p>
  </div>
</header>

<!-- Contenido principal -->
<main class="py-5" style="background-color: #f8f9fa;">
  <div class="container">
    <!-- Sección 1 -->
    <section class="mb-5">
      <h2 class="text-primary fw-semibold">1. Introducción</h2>
      <p>En <strong>Bodega July Company</strong>, valoramos y protegemos tu privacidad. Esta política describe cómo recopilamos, usamos y protegemos tu información personal.</p>
    </section>

    <!-- Sección 2 -->
    <section class="mb-5">
      <h2 class="text-primary fw-semibold">2. Datos que recopilamos</h2>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Nombre completo</li>
        <li class="list-group-item">Correo electrónico</li>
        <li class="list-group-item">Dirección de entrega</li>
        <li class="list-group-item">Número de teléfono</li>
        <li class="list-group-item">Historial de pedidos</li>
      </ul>
    </section>

    <!-- Sección 3 -->
    <section class="mb-5">
      <h2 class="text-primary fw-semibold">3. Uso de la información</h2>
      <p>La información que recopilamos es utilizada para:</p>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Gestionar tus compras</li>
        <li class="list-group-item">Confirmar entregas</li>
        <li class="list-group-item">Enviar promociones (si lo aceptas)</li>
        <li class="list-group-item">Mejorar nuestro servicio</li>
      </ul>
    </section>

    <!-- Sección 4 -->
    <section class="mb-5">
      <h2 class="text-primary fw-semibold">4. Seguridad</h2>
      <p>Implementamos medidas de seguridad para proteger tu información personal contra accesos no autorizados.</p>
    </section>

    <!-- Sección 5 -->
    <section class="mb-5">
      <h2 class="text-primary fw-semibold">5. Uso de cookies</h2>
      <p>Este sitio utiliza cookies para mejorar tu experiencia. Puedes desactivarlas desde la configuración de tu navegador.</p>
    </section>

    <!-- Sección 6 -->
    <section class="mb-5">
      <h2 class="text-primary fw-semibold">6. Tus derechos</h2>
      <p>Puedes acceder, actualizar o eliminar tu información personal escribiéndonos a <strong>soporte@bodegajuly.com</strong>.</p>
    </section>

    <!-- Sección 7 -->
    <section class="mb-4">
      <h2 class="text-primary fw-semibold">7. Cambios en esta política</h2>
      <p>Podemos modificar esta política. Te notificaremos a través del sitio si hay cambios importantes.</p>
    </section>

    <!-- Fecha de actualización -->
    <p><strong>Última actualización:</strong> 29 de mayo de 2025</p>

    
  </div>
</main>

    <?php require_once("default/footer.php") ?>
</body>

</html>