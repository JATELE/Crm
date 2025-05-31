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
                    <div class="product" data-nombre="ACEITE PRIMOR 900ML" data-precio="8.00">
                        <img src="img/aceiteprimor.webp" alt="ACEITE PRIMOR 900ML">
                        <h4>ACEITE PRIMOR 900ML</h4>
                        <p>S/ 8.00</p>
                        <button class="btn btn-success add-to-cart">AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product" data-nombre="AZUCAR RUBIA 1KG" data-precio="4.50">
                        <img src="img/azucarrubia.jpg" alt="AZUCAR RUBIA 1KG">
                        <h4>AZUCAR RUBIA 1KG</h4>
                        <p>S/ 4.50</p>
                        <button class="btn btn-success add-to-cart">AÑADIR AL CARRITO</button>
                    </div>

                    <div class="product">
                        <img src="img/azucarblanca.webp" alt="AZUCAR BLANCA 1KG">
                        <H4>AZUCAR BLANCA 1KG</H4>
                        <P>S/ 4.80</P>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/fideos.webp" alt="FIDEOS 500G">
                        <H4>FIDEOS 500G</H4>
                        <P>S/ 4.00</P>
                        <button>AÑADIR AL CARRITO</button>
                    </div>

                    <!-- Fila 2 -->
                    <div class="product">
                        <img src="img/arroz.webp" alt="ARROZ 1KG">
                        <H4>ARROZ 1KG</H4>
                        <P>S/ 5.00</P>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/maizchulpi.jpg" alt="MAIZ CHULPI 500G">
                        <H4>MAIZ CHULLPI 500G</H4>
                        <p>S/3.50</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/oregano.jpg" alt="OREGANO 50G">
                        <H4>OREGANO 50G</H4>
                        <p>S/ 2.00</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/comino.jpg" alt="COMINO 50G">
                        <H4>COMINO 50G</H4>
                        <p>S/ 2.50</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>

                    <!-- Fila 3 -->
                    <div class="product">
                        <img src="img/ajinomoto.webp" alt="AJI-NO-MOTO 100G">
                        <H4>AJINOMOTO 100G</H4>
                        <p>S/ 3.00</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/sal.webp" alt="SAL 1KG">
                        <H4>SAL 1KG</H4>
                        <p>S/ 2.50</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/harina.jpg" alt="HARINA 1KG">
                        <H4>HARINA 1KG</H4>
                        <p>S/ 5.00</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/pimienta.png" alt="PIMIENTA 50G">
                        <H4>PIMIENTA 50G</H4>
                        <p>S/ 2.80</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>

                    <!-- Fila 4 -->
                    <div class="product">
                        <img src="img/maizcancha.jpg" alt="MAIZ CANCHA 500G">
                        <H4>MAIZ CANCHA 500G</H4>
                        <p>S/ 3.80</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/avena.jpg" alt="AVENA 500G">
                        <H4>AVENA 500G</H4>
                        <p>S/ 4.50</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/azucarmorena.jpg" alt="AZUCAR MORENA 1KG">
                        <H4>AZUCAR MORENA 1KG</H4>
                        <p>S/ 4.20</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/canela.jpg" alt="CANELA 50G">
                        <H4>CANELLA 50G</H4>
                        <p>S/ 2.30</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>

                    <!-- Fila 5 -->
                    <div class="product">
                        <img src="img/chocolateenpolvo.jpg" alt="CHOCOLATE EN POLVO 200G">
                        <h4>CHOCOLATE EN POLVO 200G</h4>
                        <p>S/ 6.00</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/lecheenpolvo.jpg" alt="LECHE EN POLVO 400G">
                        <h4>LECHE EN POLVO 400G</h4>
                        <p>S/ 10.00</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/galleta.jpg" alt="GALLETAS 200G">
                        <h4>GALLETAS 200G</h4>
                        <p>S/ 3.50</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="img/cafe.jpg" alt="CAFE 200G">
                        <h4>CAFE 200G</h4>
                        <p>S/ 8.00</p>
                        <button>AÑADIR AL CARRITO</button>
                    </div>
                </section>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const botonesAgregar = document.querySelectorAll(".add-to-cart");

                        botonesAgregar.forEach(boton => {
                            boton.addEventListener("click", function () {
                                const producto = this.closest(".product");
                                const nombre = producto.getAttribute("data-nombre");
                                const precio = parseFloat(producto.getAttribute("data-precio"));

                                let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

                                const index = carrito.findIndex(p => p.nombre === nombre);
                                if (index !== -1) {
                                    carrito[index].cantidad += 1;
                                } else {
                                    carrito.push({ nombre, precio, cantidad: 1 });
                                }

                                localStorage.setItem("carrito", JSON.stringify(carrito));
                                actualizarContador();
                                
                            });
                        });

                        function actualizarContador() {
                            const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
                            const totalCantidad = carrito.reduce((acc, item) => acc + item.cantidad, 0);
                            document.getElementById("cart-count").textContent = totalCantidad;
                        }

                        actualizarContador(); // al cargar la página
                    });
                </script>

                <?php require_once("default/footer.php") ?>


</body>
<?php require_once("default/script.php") ?>


</html>