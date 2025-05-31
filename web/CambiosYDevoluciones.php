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



    <header class="header-banner d-flex align-items-center justify-content-center text-white text-center">
        <div class="overlay"></div>
        <div class="z-1 position-relative">
            <h1 class="fw-bold display-5">Cambios, Devoluciones y Términos & Condiciones</h1>
        </div>
    </header>

    <!-- Contenido principal con secciones claras -->
    <main class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <!-- Política de Cambios -->
            <section class="mb-5">
                <h2 class="text-primary fw-semibold">Política de Cambios y Devoluciones</h2>
                <p>En <strong>Bodega July Company</strong>, queremos que estés completamente satisfecho con tu compra.
                    Si necesitas realizar un cambio o devolución, ten en cuenta lo siguiente:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Los productos pueden ser devueltos dentro de los 7 días calendario desde
                        la fecha de compra.</li>
                    <li class="list-group-item">Debe presentarse el comprobante de pago original.</li>
                    <li class="list-group-item">Los productos deben estar en perfecto estado y en su empaque original.
                    </li>
                    <li class="list-group-item">No se aceptan devoluciones de productos perecibles o con sellos rotos.
                    </li>
                </ul>
            </section>

            <!-- Términos y Condiciones -->
            <section class="mb-5">
                <h2 class="text-primary fw-semibold">Términos y Condiciones de la Web</h2>
                <p>Al utilizar nuestro sitio web, aceptas lo siguiente:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">La información del sitio puede cambiar sin previo aviso.</li>
                    <li class="list-group-item">El uso no autorizado puede dar lugar a reclamaciones legales.</li>
                    <li class="list-group-item">Está prohibido copiar o distribuir contenidos sin autorización previa.
                    </li>
                </ul>
            </section>

            <!-- Canales de Atención -->
            <section class="mb-5">
                <h2 class="text-primary fw-semibold">Canales de Atención</h2>
                <p>Si necesitas ayuda, contáctanos a través de:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Teléfono:</strong> (COD) 779-009</li>
                    <li class="list-group-item"><strong>Correo:</strong> atencion@bodegajuly.com</li>
                    <li class="list-group-item"><strong>Formulario web:</strong> Sección de <a href="#">Contacto</a>
                    </li>
                </ul>
            </section>

            
        </div>
    </main>

    <?php require_once("default/footer.php") ?>
</body>

</html>