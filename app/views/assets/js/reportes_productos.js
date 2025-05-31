// reportes_productos.js
document.addEventListener("DOMContentLoaded", function() {
  // Obtener todos los botones de editar producto
  const botonesEditar = document.querySelectorAll(".btnEditarProducto");

  botonesEditar.forEach(boton => {
    boton.addEventListener("click", function(event) {
      event.preventDefault();

      // Obtener datos del data-atributos
      const id = this.getAttribute("data-id");
      const nombre = this.getAttribute("data-nombre");
      const descripcion = this.getAttribute("data-descripcion");
      const precio = this.getAttribute("data-precio");
      const stock = this.getAttribute("data-stock");
      const id_categoria = this.getAttribute("data-id_categoria");

      // Asignar valores al formulario del modal
      document.getElementById("edit_id_producto").value = id;
      document.getElementById("edit_nombre").value = nombre;
      document.getElementById("edit_descripcion").value = descripcion;
      document.getElementById("edit_precio").value = precio;
      document.getElementById("edit_stock").value = stock;
      document.getElementById("edit_id_categoria").value = id_categoria;

      // Mostrar modal (usando Bootstrap 3 o 4)
      $('#modalEditarProducto').modal('show');
    });
  });
});
