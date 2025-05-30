<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atención al Cliente</title>
  <?php require_once("default/heat.php") ?>
  <style>
    /* Estilos Generales */
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f4f7fc;
      color: #333;
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Contenedor Principal */
    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Título Principal */
    .title h2 {
      margin: 0;
      font-size: 1.5rem;
      font-weight: bold;
      color: #2c3e50;
      text-align: center;
    }

    .title p {
      font-size: 1rem;
      color: #7f8c8d;
      text-align: center;
      margin-top: 10px;
    }

    /* Sección de Contenido */
    .content {
      margin-top: 30px;
    }

    .sub-content {
      background-color: #ecf0f1;
      border-left: 4px solid #3498db;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .sub-content h6 {
      margin: 0;
      font-size: 1.2rem;
      color: #2980b9;
    }

    .sub-content p {
      margin: 5px 0 0;
      font-size: 1rem;
      color: #34495e;
    }

    /* Estilos para Dispositivos Móviles */
    @media (max-width: 600px) {
      .container {
        margin: 20px;
        padding: 15px;
      }

      .title h2 {
        font-size: 1.2rem;
      }

      .sub-content h6 {
        font-size: 1rem;
      }

      .sub-content p {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
    <div class="top-bar">
    ¡🚚 ¡Envío gratuito a partir de S/. 150! 💬 WhatsApp: +51 906328260
  </div>
  <?php require_once("default/navigation.php") ?>
  <div class="container">
    <div class="title">
      <h2>BIENVENIDOS A ATENCIÓN AL CLIENTE</h2>
      <p>"Si no puede encontrar lo que está buscando, aquí le mostramos cómo ponerse en contacto con nosotros."</p>
    </div>

    <div class="content">
      <div class="sub-content">
        <h6>Teléfono - Pucallpa</h6>
        <p>+51 906328260</p>
      </div>
      <div class="sub-content">
        <h6>Teléfono - Provincia</h6>
        <p>+51 906328260</p>
      </div>
    </div>
  </div>
  <?php require_once("default/footer.php") ?>
</body>
</html>

