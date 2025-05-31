<script>
  // Esperar que el DOM esté completamente cargado
  document.addEventListener("DOMContentLoaded", () => {
    const opciones = document.querySelectorAll(".opciones-filtro .dropdown-item");
    const contenedor = document.getElementById("productos");

    opciones.forEach(opcion => {
      opcion.addEventListener("click", (e) => {
        e.preventDefault();
        const orden = opcion.getAttribute("data-order");
        const productos = Array.from(contenedor.querySelectorAll(".product"));

        productos.sort((a, b) => {
          const precioA = parseFloat(a.querySelector("p").textContent.replace("S/", "").trim());
          const precioB = parseFloat(b.querySelector("p").textContent.replace("S/", "").trim());

          return orden === "asc" ? precioA - precioB : precioB - precioA;
        });

        // Reordenar productos en el DOM
        productos.forEach(producto => contenedor.appendChild(producto));
      });
    });
  });
</script>
<script>
  const filtroContainer = document.querySelector('.filtro-container');
  const filtroBtn = document.querySelector('.filtro-btn');

  filtroBtn.addEventListener('click', () => {
    filtroContainer.classList.toggle('active');
  });
</script>
<script>
  const btnBuscar = document.getElementById('btnBuscar');
  const inputBusqueda = document.getElementById('inputBusqueda');
  const productos = document.querySelectorAll('.product');

  btnBuscar.addEventListener('click', () => {
    const texto = inputBusqueda.value.toLowerCase().trim();

    productos.forEach(producto => {
      const nombre = producto.querySelector('h4').textContent.toLowerCase();
      if (nombre.includes(texto)) {
        producto.style.display = 'block';
      } else {
        producto.style.display = 'none';
      }
    });
  });

  //Presionar Enter también activa la búsqueda
  inputBusqueda.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      btnBuscar.click();
    }
  });
  
</script>