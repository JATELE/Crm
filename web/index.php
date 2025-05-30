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
            <img src="img/inkaG.png" alt="Inca Kola 1L">
            <h4>INCA KOLA 3L</h4>
            <p>S/ 12.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/cocaG.png" alt="Coca Cola 3L">
            <h4>COCA COLA 3L</h4>
            <p>S/ 12.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/guaranitaCH.png" alt="Guaranita">
            <h4>GUARANITA</h4>
            <p>S/ 2.50</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/oroCH.png" alt="Oro 1L">
            <h4>ORO 1L</h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/cielo.png" alt="agua cielo">
            <h4>CIELO 600ML </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/agua_san_luis.png" alt="agua san luis">
            <h4>AGUA SAN LUIS 1L</h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/yogourtV.png" alt="YOGIURT GRANDE ">
            <h4>YOGOURT GRANDE </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/yogourtFG.png" alt="YOGOURT FRESA ">
            <h4>YOGOURT FRESA </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <!-- Fila 4 -->
          <div class="product">
            <img src="img/griego.png" alt="YOGOUT GRIEGO">
            <h4>YOGOUT GRIEGO </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/pulpCH.png" alt="PULP DURAZNO ">
            <h4>PULP DURAZNO </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/yogourtF.png" alt="YOGOURT FRESA">
            <h4>YOGOURT FRESA</h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/chocolac.png" alt="CHOCOLAC">
            <h4>CHOCOLAC</h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <!-- Fila 5 -->
          <div class="product">
            <img src="img/battimixF.png" alt="BATIMIX FRESA ">
            <h4>BATIMIX FRESA </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/battimixV.png" alt="BATIMIX VAINILLA">
            <h4>BATIMIX VAINILLA </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="img/electolight.png" alt="electolight ">
            <h4>electolight </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
          <div class="product">
            <img src="imagenes/oro.png" alt="Oro 1L">
            <h4>ORO 1L </h4>
            <p>S/ 3.00</p>
            <button>AÑADIR AL CARRITO</button>
          </div>
        </section>
        <?php require_once("default/footer.php") ?>
</body>
<?php require_once("default/script.php") ?>

</html>