<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abarrotes Yuly</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="css/gym.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

  <!-- Scripts -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


</head>
<style>
    .banner {
    background-image: url('https://img.freepik.com/fotos-premium/carro-compras-rojo-vacio-fondo-borroso-abstracto-pasillo-interior-tienda-comestibles-supermercado_293060-7452.jpg?w=360');
    background-size: cover;
    background-position: center;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: black;
    font-size: 40px;
    font-weight: bold;
  }
  
</style>

<body>
  <!-- Top bar -->
  <div class="top-bar">
    🚚 ¡Envío gratuito a partir de S/. 150! 💬 WhatsApp: +51 906328260
  </div>
  

  <!-- Navegación -->
  <?php require_once("default/navigation.php"); ?>
  <div class="banner">
    -CONOCENOS-
  </div>
  <div class="container my-5">
  <div class="card shadow-lg border-0 rounded-4 p-4">
    <div class="row g-4 align-items-center">
      <div class="col-md-4 text-center">
        <img src="img/dueña.png" alt="Dueños" class="img-fluid rounded-circle border border-3 border-success shadow-sm" style="max-width: 200px;">
      </div>
      <div class="col-md-8">
        <h4 class="fw-bold mb-2">Dueños y Creadores</h4>
        <h5 class="text-muted mb-3">July Cárdenas &amp; Josue Pacaya</h5>
        <p><strong>Creación e inspiración de los dueños</strong></p>
        <p class="text-justify">
          Crear una tienda donde puedas encontrar abarrotes y verduras a precios razonables,
          con el cariño que nos representa y el gusto de poder llevarles los mejores productos
          de la zona hasta tu mesa.
        </p>
      </div>
    </div>
  </div>
</div>




  <!-- Footer -->
  <?php require_once("default/footer.php"); ?>

</body>

</html>