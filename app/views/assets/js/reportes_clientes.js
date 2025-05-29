// Selecciona todos los botones con la clase 'btnEditarCliente'
const btnEditar = document.querySelectorAll(".btnEditarCliente");

// Recorremos cada botón y le añadimos un listener para abrir el modal y cargar los datos
btnEditar.forEach((boton) => {
  boton.addEventListener("click", () => {
    $('#modalEditar').modal('show');

    // Obtener los inputs
    const inputDNI = document.getElementById("dni");
    const inputNombre = document.getElementById("nombre");
    const inputTelefono = document.getElementById("telefono");
    const inputDireccion = document.getElementById("direccion");
    const inputCorreo = document.getElementById("email");

    // Asignar los valores desde los atributos data-
    inputDNI.value = boton.dataset.dni;
    inputNombre.value = boton.dataset.nombre;
    inputTelefono.value = boton.dataset.telefono;
    inputDireccion.value = boton.dataset.direccion;
    inputCorreo.value = boton.dataset.correo;
  });
});

// Botón para confirmar edición y enviar con AJAX
const btnActualizar = document.getElementById("btnEditarCliente");
btnActualizar.addEventListener("click", () => {
  const inputDNI = document.getElementById("dni");
  const inputNombre = document.getElementById("nombre");
  const inputTelefono = document.getElementById("telefono");
  const inputDireccion = document.getElementById("direccion");
  const inputCorreo = document.getElementById("email");

  $.ajax({
    url: "../controllers/ClienteEditarController.php",
    type: "POST",
    data: {
      dni_c: inputDNI.value,
      name_c: inputNombre.value,
      telefono_c: inputTelefono.value,
      direccion_c: inputDireccion.value,
      correo_c: inputCorreo.value,
    },
    success: function (respuesta) {
      if (respuesta === "yes") {
        alert("ACTUALIZACIÓN CORRECTA");
        location.reload(); // Recargar para ver cambios
      } else {
        alert("Error al actualizar");
      }
    },
    error: function () {
      alert("Error en la petición AJAX");
    },
  });
});
