<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comprobante de Pago</title>
  <link rel="stylesheet" href="css/stylesC.css">
  <?php require_once("default/heat.php") ?>
</head>
<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f1f6f5;;
}

.comprobante {
  width: 80%;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
}

header {
  text-align: center;
  margin-bottom: 20px;
}

header h1 {
  margin: 0;
  font-size: 24px;
  color: #333;
}

header p {
  margin: 5px 0;
  font-size: 14px;
  color: #555;
}

section h2 {
  font-size: 18px;
  color: #333;
  margin-bottom: 10px;
}

section p {
  font-size: 14px;
  color: #555;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

table th, table td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: center;
}

table th {
  background-color: #f2f2f2;
}

.footerYULY {
  text-align: center;
  font-size: 12px;
  color: #777;
}
</style>
<body>
    <div class="top-bar">
    ¡🚚 ¡Envío gratuito a partir de S/. 150! 💬 WhatsApp: +51 906328260
  </div>
  <?php require_once("default/navigation.php") ?>
  <div class="comprobante">
    <header>
      <h1>Comprobante de Pago Electrónico</h1>
      <p>RUC: 12345678901</p>
      <p>Fecha: 2025-05-29</p>
    </header>

    <section class="cliente">
      <h2>Datos del Cliente</h2>
      <p><strong>Nombre:</strong> Juan Pérez</p>
      <p><strong>DNI:</strong> 12345678</p>
      <p><strong>Dirección:</strong> Av. Siempre Viva 123</p>
    </section>

    <section class="detalle">
      <h2>Detalle de la Venta</h2>
      <table>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Producto A</td>
            <td>2</td>
            <td>S/ 50.00</td>
            <td>S/ 100.00</td>
          </tr>
          <tr>
            <td>Producto B</td>
            <td>1</td>
            <td>S/ 30.00</td>
            <td>S/ 30.00</td>
          </tr>
        </tbody>
      </table>
    </section>

    <section class="totales">
      <p><strong>Total a Pagar:</strong> S/ 130.00</p>
    </section>

    <footer class="footerYULY">
      <p>Emitido electrónicamente por Bodegas Yuly</p>
    </footer>
  </div>
  <?php require_once("default/footer.php") ?>
</body>
</html>
