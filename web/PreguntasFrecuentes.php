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
            <h1 class="fw-bold display-5">Preguntas Frecuentes</h1>
            <p class="lead">Respuestas claras para tus dudas comunes</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <section class="mb-5">
                <div class="accordion" id="faqAccordion">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                ¿Cuánto tarda en llegar mi pedido?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Los pedidos realizados en nuestra tienda se entregan entre 1 y 3 días hábiles,
                                dependiendo de la zona de entrega.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                ¿Puedo devolver un producto si no estoy satisfecho?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí. Puedes devolver productos dentro de los 7 días posteriores a la compra siempre que
                                estén en perfecto estado y con su empaque original.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                ¿Qué métodos de pago aceptan?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Aceptamos pagos en efectivo contra entrega, transferencias bancarias y tarjetas de
                                crédito o débito.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                ¿Puedo hacer mi pedido por teléfono?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí. Puedes comunicarte con nosotros al (COD)779-009 y realizar tu pedido con ayuda de
                                nuestro equipo de atención al cliente.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                ¿Cómo puedo obtener mi comprobante electrónico?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Una vez finalizada la compra, recibirás un correo con el comprobante electrónico.
                                También puedes solicitarlo en nuestra sección de contacto.
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <?php require_once("default/footer.php") ?>
</body>

</html>