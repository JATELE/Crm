<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Formulario de Compra</title>

  <?php require_once("default/heat.php") ?>

</head>

<body>
  <div class="top-bar">
    ¡🚚 ¡Envío gratuito a partir de S/. 150! 💬 WhatsApp: +51 906328260
  </div>
  <?php require_once("default/navigation.php") ?>

  <!-- Formulario de Facturación y Envío -->
  <div class="container my-4">
    <div class="row">
      <!-- Sección de formulario -->
      <div class="col-md-7">
        <h4 class="mb-3">Facturación y Envío</h4>
        <form>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            </div>
            <div class="col-sm-6">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="apellido" placeholder="Apellido">
            </div>
            <div class="col-12">
              <label for="distrito" class="form-label">Destino/Distrito (opcional)</label>
              <select class="form-select" id="distrito">
                <option selected>Seleccione una opción</option>
                <option value="1">Distrito 1</option>
                <option value="2">Distrito 2</option>
              </select>
            </div>
            <div class="col-12">
              <label for="direccion" class="form-label">Dirección de entrega</label>
              <input type="text" class="form-control" id="direccion" placeholder="Dirección completa">
            </div>
            <div class="col-sm-6">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="telefono" placeholder="Teléfono">
            </div>
            <div class="col-sm-6">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="correo" placeholder="Correo electrónico">
            </div>
            <div class="col-12">
              <div class="alert alert-secondary small">
                Programación de envío: Todos nuestros pedidos se envían al día siguiente de haber sido tomados
                (agendamos pedidos de 8am a 8pm).
              </div>
              <select class="form-select" id="dia-envio">
                <option>Envíos para mañana</option>
              </select>
            </div>
            <div class="col-12">
              <label for="hora-envio" class="form-label">Horario de entrega</label>
              <select class="form-select" id="hora-envio">
                <option>Entrega entre 10:30 am y 3:00 pm</option>
              </select>
              <small class="text-muted">Domingos y feriados no se realizan envíos.</small>
            </div>
          </div>

          <hr class="my-4">

          <h5 class="text-success fw-bold">Adicionar información</h5>
          <div class="mb-3">
            <label for="nota" class="form-label">Nota del pedido (opcional)</label>
            <textarea class="form-control" id="nota" rows="3"
              placeholder="Agregue los detalles de su pedido"></textarea>
          </div>
          <button class="btn btn-success w-100 mt-3" id="btnEnviarWhatsapp">
            Enviar pedido por WhatsApp
          </button>

        </form>
      </div>

      <!-- Sección resumen de orden -->
      <div class="col-md-5">
        <h4 class="mb-3">Tu Orden</h4>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Productos</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="carrito-body">
            <!-- Productos se insertarán aquí -->
          </tbody>
          <tfoot>
            <tr>
              <th>Total</th>
              <th id="total">S/. 0.00</th>
            </tr>
          </tfoot>
        </table>
        <button id="vaciar-carrito" class="btn btn-danger w-100 mt-2">Vaciar carrito</button>

        <div class="mb-3">
          <h5 class="fw-bold">Método de pago</h5>

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="pago" id="pago1" checked>
            <label class="form-check-label fw-bold text-success" for="pago1">
              Depósito, transferencia bancaria, Yape/Plin
            </label>
            <div class="alert alert-success mt-2 small">
              Realice el pago directamente en nuestras cuentas bancarias o Yape/Plin, y envíenos una captura de tu
              voucher de pago al correo xxxxxx@gmail.com o vía WhatsApp 9xx 2xx 8xx.
            </div>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="pago" id="pago2">
            <label class="form-check-label fw-bold" for="pago2">
              Pago contra entrega (efectivo, Yape/Plin y tarjeta)
            </label>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>

  <?php require_once("default/footer.php") ?>
  <script>
document.addEventListener("DOMContentLoaded", () => {
  function actualizarCarrito() {
    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    const carritoBody = document.getElementById("carrito-body");
    const totalElemento = document.getElementById("total");
    const cartCount = document.getElementById("cart-count");

    carritoBody.innerHTML = "";
    let total = 0;
    let cantidadTotal = 0;

    carrito.forEach((producto, index) => {
      const subtotal = producto.precio * producto.cantidad;
      total += subtotal;
      cantidadTotal += producto.cantidad;

      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td>
          ${producto.nombre} x${producto.cantidad}<br>
          <button class="btn btn-sm btn-outline-secondary disminuir" data-index="${index}">-</button>
          <button class="btn btn-sm btn-outline-primary aumentar" data-index="${index}">+</button>
          <button class="btn btn-sm btn-outline-danger eliminar" data-index="${index}">Eliminar</button>
        </td>
        <td>S/. ${subtotal.toFixed(2)}</td>
      `;
      carritoBody.appendChild(fila);
    });

    totalElemento.textContent = `S/. ${total.toFixed(2)}`;
    if (cartCount) {
      cartCount.textContent = cantidadTotal;
    }

    // Botón disminuir cantidad
    document.querySelectorAll(".disminuir").forEach(btn => {
      btn.addEventListener("click", () => {
        const index = btn.getAttribute("data-index");
        if (carrito[index].cantidad > 1) {
          carrito[index].cantidad--;
        } else {
          carrito.splice(index, 1);
        }
        localStorage.setItem("carrito", JSON.stringify(carrito));
        actualizarCarrito();
      });
    });

    // Botón aumentar cantidad
    document.querySelectorAll(".aumentar").forEach(btn => {
      btn.addEventListener("click", () => {
        const index = btn.getAttribute("data-index");
        carrito[index].cantidad++;
        localStorage.setItem("carrito", JSON.stringify(carrito));
        actualizarCarrito();
      });
    });

    // Botón eliminar producto
    document.querySelectorAll(".eliminar").forEach(btn => {
      btn.addEventListener("click", () => {
        const index = btn.getAttribute("data-index");
        carrito.splice(index, 1);
        localStorage.setItem("carrito", JSON.stringify(carrito));
        actualizarCarrito();
      });
    });
  }

  actualizarCarrito();
});
</script>


  <script>
  document.getElementById("btnEnviarWhatsapp").addEventListener("click", function () {
    // Recolectar datos del formulario
    const direccion = document.getElementById("direccion").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const dia = document.getElementById("dia-envio").value;
    const hora = document.getElementById("hora-envio").value;
    const nota = document.getElementById("nota").value.trim();

    // Validar datos obligatorios
    if (!direccion || !telefono || !correo) {
      alert("Por favor completa todos los campos requeridos.");
      return;
    }

    // Obtener carrito desde localStorage
    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    if (carrito.length === 0) {
      alert("Tu carrito está vacío.");
      return;
    }

    // Armar mensaje para WhatsApp
    let mensaje = `*Nuevo pedido desde la web:*\n\n`;
    mensaje += `📍 *Dirección:* ${direccion}\n📞 *Teléfono:* ${telefono}\n📧 *Correo:* ${correo}\n📅 *Día de envío:* ${dia}\n🕒 *Hora:* ${hora}\n`;
    if (nota) mensaje += `📝 *Nota:* ${nota}\n`;
    mensaje += `\n🛒 *Productos:* \n`;

    let total = 0;
    carrito.forEach(item => {
      const subtotal = item.precio * item.cantidad;
      total += subtotal;
      mensaje += `- ${item.nombre} x${item.cantidad} = S/. ${subtotal.toFixed(2)}\n`;
    });

    mensaje += `\n💵 *Total:* S/. ${total.toFixed(2)}`;

    // Número de WhatsApp (ajusta este número)
    const numero = "51915231221";
    const url = `https://wa.me/${numero}?text=${encodeURIComponent(mensaje)}`;

    // Limpiar carrito del localStorage y tabla HTML
    localStorage.removeItem("carrito");
    document.getElementById("carrito-body").innerHTML = "";
    document.getElementById("total").textContent = "S/. 0.00";
    const cartCount = document.getElementById("cart-count");
    if (cartCount) cartCount.textContent = "0";

    // Redirigir a WhatsApp
    window.open(url, "_blank");

    // Mensaje opcional
    alert("Pedido generado. Se abrirá WhatsApp para enviarlo.");
  });
  
</script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const btnVaciar = document.getElementById("vaciar-carrito");
    const carritoBody = document.getElementById("carrito-body");
    const totalElemento = document.getElementById("total");

    btnVaciar.addEventListener("click", () => {
      localStorage.removeItem("carrito");
      carritoBody.innerHTML = "";
      totalElemento.textContent = "S/. 0.00";

      // Actualiza el contador del ícono
      const cartCount = document.getElementById("cart-count");
      if (cartCount) {
        cartCount.textContent = "0";
      }
    });
  });
</script>



</body>

</html>