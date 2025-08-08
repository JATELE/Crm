const variable_dni = document.getElementById("dni_cliente");

variable_dni.addEventListener("keyup", function () {
  // Solo números y limitar a 8 dígitos
  this.value = this.value.replace(/[^0-9]/g, '');

  if (this.value.length === 9) {
    alert("El DNI solo debe contar con 8 digitos")
    }else{
    console.log("El número es: " + this.value);

    $.ajax({
      url: "../controllers/ClienteConsultaController.php",
      type: "GET",
      data: {
        dni_c: this.value,
      },

      success: function (respuesta) {
        console.log(respuesta);
        const variable_tabla = document.getElementById("contenedor_datos");

       
          variable_tabla.innerHTML = `
            <tr>
              <td>${respuesta[0].dni_cliente}</td>
              <td>${respuesta[0].nombres_cliente}</td>
              <td>${respuesta[0].apellidos_cliente}</td>
              <td>${respuesta[0].correo_cliente}</td>
              <td>${respuesta[0].telefono_cliente}</td>
              <td>${respuesta[0].lugar_nacimiento}</td>
              <td>${respuesta[0].fecha_nacimiento}</td>
              <td>${respuesta[0].estado_civil}</td>
            </tr>
          `
         }
        })
        // ******** FIN  DE AJAX ******** 
    }

    
});

