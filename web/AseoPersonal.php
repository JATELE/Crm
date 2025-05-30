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
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThNXQAd6nHGiFAZXd1EgFM1A2mTxIEUoJ0Dg&s"
                            alt="Tomates">
                        <h4>SHAMPOO CAMAY 75ML</h4>
                        <p>S/ 4.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://www.lagranbodega.com.pe/public/images/products/671873.jpg" alt="Arroz 1kg">
                        <h4>JABON REXONA SAMSOO ALOE</h4>
                        <p>S/ 3.20</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://deliverycajabamba.com/wp-content/uploads/2024/03/JABONCILLO-REXONA-MEN-ANTIBACTERIAL-ACTIVE-SPORTS-CONT.NETO-85-GR.jpg"
                            alt="Shampoo Herbal">
                        <h4>REXONA ACTIVE SPORTS</h4>
                        <p>S/ 12.90</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://production-tailoy-repo-magento-statics.s3.amazonaws.com/imagenes/872x872/productos/i/j/a/jabon-neko-extra-suave-x-75-grs-14095-default-1.jpg"
                            alt="Lentejas">
                        <h4>JABON NEKO EXTRA SUAVE</h4>
                        <p>S/ 5.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://triomcbo.com/wp-content/uploads/2022/05/C151-Jabon-Antibacterial-Rexona-120g.jpg"
                            alt="Leche Gloria">
                        <h4>REXONA LIMPIEZA PROFUNDA</h4>
                        <p>S/ 4.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://www.lagranbodega.com.pe/public/images/products/841597.jpg" alt="Queso Fresco">
                        <h4>JABON CAMAY ROSAS</h4>
                        <p>S/ 15.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://oechsle.vteximg.com.br/arquivos/ids/7167227-1000-1000/image-c5382db6f7f949ec9b848812a766bc0d.jpg?v=637801314381330000"
                            alt="Jamón de pavo">
                        <h4>REXONA ANTIBACTERIAL</h4>
                        <p>S/ 8.90</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://plazavea.vteximg.com.br/arquivos/ids/29522389-512-512/20146113.jpg"
                            alt="Salchicha">
                        <h4>JABON DOVE</h4>
                        <p>S/ 6.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://www.palmolive.com.pe/content/dam/cp-sites/personal-care/palmolive-latam/redesign-2020/andina/pdp/aloe-y-oliva/palmolive-jabon-en-barra-aloe-y-oliva-front.jpg"
                            alt="Jugo de naranja">
                        <h4>PALMOLIVE NATURALS</h4>
                        <p>S/ 7.00</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://barakibodegon.net/cdn/shop/files/unnamed_5daca39e-0a93-4d60-8331-f587a5c10981.jpg?v=1723828823"
                            alt="Coca Cola 1.5L">
                        <h4>PROTEX 3X1 ACTIVE SPORTS</h4>
                        <p>S/ 5.90</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://vegaperu.vtexassets.com/arquivos/ids/157674/7708872634035.jpg?v=637630156647930000"
                            alt="Papa blanca">
                        <h4>MONCLER ENERGIA</h4>
                        <p>S/ 2.80</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                    <div class="product">
                        <img src="https://oechsle.vteximg.com.br/arquivos/ids/9074561-1000-1000/image-226e4cb4111b4d12bd282021609bd255.jpg?v=637903091491130000"
                            alt="Detergente Bolívar">
                        <h4>MONCLER REFRESH</h4>
                        <p>S/ 9.50</p>
                        <button>AÑADIR CARRITO</button>
                    </div>
                </section>
                <?php require_once("default/footer.php") ?>
</body>
<?php require_once("default/script.php") ?>



</html>