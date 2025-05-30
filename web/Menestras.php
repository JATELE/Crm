<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("default/heat.php") ?>
</head>

<body>
    <!-- Barra superior -->
    <div class="top-bar">
        ¡🚚 ¡Envío gratuito a partir de S/. 150! 💬 WhatsApp: +51 906328260
    </div>
    <!-- Navegación -->

    <?php require_once("default/navigation.php") ?>
    <?php require_once("default/buscador.php") ?>



    <!-- Categorías SOLO móviles -->
    <?php require_once("default/asidecel.php") ?>

    <!-- Contenido principal -->
     <main class="main-content py-3" style="background-color: #EDF8F6;">
        <div class="container-fluid">
            <div class="row">
                <!-- Categorías en escritorio -->
                <aside class="sidebar">
                    <h3>NUESTRAS
                        CATEGORÍAS</h3>
                    <ul>
                        <?php require_once("default/aside.php") ?>
                    </ul>
                </aside>
                <!-- Productos -->
                <section class="products" id="productos">
                    <!-- Fila 1 -->
                    <div class="product">
                        <img src="img/lentejaGrande.png"
                            alt="Tomates">
                        <h4>TRIGO GRANEL </h4>
                        <p>S/ 4.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="IMG/FREJOLPANITO.png" alt="Arroz 1kg">
                        <h4>FREJOL TOSTADO</h4>
                        <p>S/ 3.20</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/PALLARGRANEADO.png"
                            alt="Shampoo Herbal">
                        <h4>MORON ENTERO</h4>
                        <p>S/ 12.90</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/HABASPARTIDAS.png"
                            alt="Lentejas">
                        <h4>ALVERJITA PARTIDA</h4>
                        <p>S/ 5.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/frejolcastilla.png"
                            alt="Leche Gloria">
                        <h4>FREJOL CASTILLA</h4>
                        <p>S/ 4.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/maiz.png" alt="Queso Fresco">
                        <h4>MAIZ</h4>
                        <p>S/ 15.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/moronpartido.png"
                            alt="Jamón de pavo">
                        <h4>MORON PARTIDO</h4>
                        <p>S/ 8.90</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/LENTEJABEBE.png"
                            alt="Salchicha">
                        <h4>LENTEJA BEBE</h4>
                        <p>S/ 6.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/LENTEJAGRANDEGRANEL.png"
                            alt="Jugo de naranja">
                        <h4>LENTEJA GRANDE</h4>
                        <p>S/ 7.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/FREJOLPANAMITO.png"
                            alt="Coca Cola 1.5L">
                        <h4>FREJOL PANAMITO</h4>
                        <p>S/ 5.90</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/PALLARGRANEL.png"
                            alt="Papa blanca">
                        <h4>PALLAR GRANEL</h4>
                        <p>S/ 2.80</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/GARBANZO.png"
                            alt="Detergente Bolívar">
                        <h4>GARBANZO</h4>
                        <p>S/ 9.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/PAPASECA.png"
                            alt="Detergente Bolívar">
                        <h4>PAPA SECA</h4>
                        <p>S/ 9.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/HABASPARTIDA.png"
                            alt="Detergente Bolívar">
                        <h4>HABAS PARTIDAS</h4>
                        <p>S/ 9.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/MAIZBLANCO.png"
                            alt="Detergente Bolívar">
                        <h4>MAIZ BLANCO</h4>
                        <p>S/ 9.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/MOTE.png"
                            alt="Detergente Bolívar">
                        <h4>MOTE</h4>
                        <p>S/ 9.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/FREJOLCAMANEJO.png"
                            alt="Detergente Bolívar">
                        <h4>FREJOL CAMANEJO</h4>
                        <p>S/ 9.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                </section>
                <?php require_once("default/footer.php") ?>
</body>
<?php require_once("default/script.php") ?>


</html>