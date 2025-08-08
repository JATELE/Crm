const btnEditar = document.querySelectorAll(".btnEditarCliente");

btnEditar.forEach((boton) => {
  boton.addEventListener("click", () => {
    $('#modalEditarCliente').modal('show'); // CORREGIDO

    document.getElementById("dni_cliente").value = boton.dataset.dni;
    document.getElementById("nombres_cliente").value = boton.dataset.nombres;
    document.getElementById("apellidos_cliente").value = boton.dataset.apellidos;
    document.getElementById("correo_cliente").value = boton.dataset.correo;
    document.getElementById("telefono_cliente").value = boton.dataset.telefono;
    document.getElementById("lugar_nacimiento").value = boton.dataset.lugar;
    document.getElementById("fecha_nacimiento").value = boton.dataset.fecha;
    document.getElementById("estado_civil").value = boton.dataset.estado;
  });
});

document.getElementById("btnEditarCliente").addEventListener("click", function (e) {
  e.preventDefault(); // EVITA ENVÍO DEL FORMULARIO

  $.ajax({
    url: "../controllers/ClienteController.php",
    type: "POST",
    data: {
      accion: "actualizar", // MUY IMPORTANTE
      dni_original: document.getElementById("dni_cliente").value,
      nombres: document.getElementById("nombres_cliente").value,
      apellidos: document.getElementById("apellidos_cliente").value,
      correo: document.getElementById("correo_cliente").value,
      telefono: document.getElementById("telefono_cliente").value,
      lugar_nacimiento: document.getElementById("lugar_nacimiento").value,
      fecha_nacimiento: document.getElementById("fecha_nacimiento").value,
      estado_civil: document.getElementById("estado_civil").value,
    },
    success: function (respuesta) {
      if (respuesta.trim() === "yes") {
        alert("ACTUALIZACIÓN CORRECTA");
        location.reload();
      } else {
        alert("Error al actualizar");
      }
    },
    error: function () {
      alert("Error en la petición AJAX");
    }
  });
});
