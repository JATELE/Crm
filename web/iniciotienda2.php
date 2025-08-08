<?php
session_start();
if (!isset($_SESSION["cliente_sesion"])) {
  header("Location: ../index.php");
  exit;
}

$nombre = $_SESSION["cliente_sesion"]["nombre"];
$apellido = $_SESSION["cliente_sesion"]["apellido"];

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRM turísticos</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="css/gym.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />



  <!-- Scripts -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

  <style>
    body {

      background: #f0f0f0;

    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-button {
      background-color: #3498db;
      color: white;
      padding: 12px 20px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .dropdown-button:hover {
      background-color: #2980b9;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 180px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      z-index: 1;
      overflow: hidden;
      animation: fadeIn 0.3s ease-in-out;
    }

    .dropdown-content a {
      color: #333;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      transition: background-color 0.2s ease, padding-left 0.2s ease;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
      padding-left: 24px;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .top-bar {
      background-color: #28a745;
      color: white;
      text-align: center;
      padding: 8px 0;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <!-- Top bar -->
  <div class="top-bar">
    🚚 Gana descuentos increibles con tus puntos
  </div>

  <nav class="navbar navbar-expand-lg border-bottom border-body py-4 p-3" style="background-color: #f7f3ec;">
    <div class="container-fluid position-relative">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav justify-content-center" id="navbarContent">
        <ul class="navbar-nav">
          <li class="nav-item mx-5"><a class="nav-link M11" href="iniciotienda2.php">Inicio</a></li>
          <li class="nav-item mx-5"><a class="nav-link M11" href="servicios.php">Servicios</a></li>
          <li class="nav-item mx-5"><a class="nav-link M11" href="encuentas.php">Encuesta</a></li>
        </ul>
      </div>
      <div class="redes position-absolute top-50 end 0 translate-middle-y pe-3">
        <a class="nav-item mx-0">logo</a>

      </div>

      <div class="dropdown">
        <button class="dropdown-button">👤 Mi cuenta</button>
        <div class="dropdown-content">
          <a href="#">Perfil</a>
          <a href="../app/controllers/cerrar_sesion.php">Cerrar sesión</a>
        </div>
      </div>



    </div>
  </nav>
</body>

</html>