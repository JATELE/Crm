$(document).ready(function () {
  function listarCategorias() {
    $.get("../controllers/CategoriaController.php?accion=listar", function (data) {
      let categorias = JSON.parse(data);
      let html = "";
      categorias.forEach(c => {
        html += `<tr>
          <td>${c.id_categoria}</td>
          <td>${c.nombre}</td>
          <td>
            <button class="btn btn-warning btnEditar" data-id="${c.id_categoria}" data-nombre="${c.nombre}">Editar</button>
            <button class="btn btn-danger btnEliminar" data-id="${c.id_categoria}">Eliminar</button>
          </td>
        </tr>`;
      });
      $("#tbodyCategorias").html(html);
    });
  }

  listarCategorias();

  $("#formAgregar").submit(function (e) {
    e.preventDefault();
    $.post("../controllers/CategoriaController.php?accion=registrar", $(this).serialize(), function (res) {
      if (res === "yes") {
        alert("Registrado correctamente");
        $("#modalAgregar").modal("hide");
        listarCategorias();
      } else {
        alert("Error al registrar");
      }
    });
  });

  $(document).on("click", ".btnEditar", function () {
    $("#edit_id").val($(this).data("id"));
    $("#edit_nombre").val($(this).data("nombre"));
    $("#modalEditar").modal("show");
  });

  $("#formEditar").submit(function (e) {
    e.preventDefault();
    $.post("../controllers/CategoriaController.php?accion=editar", $(this).serialize(), function (res) {
      if (res === "yes") {
        alert("Actualizado correctamente");
        $("#modalEditar").modal("hide");
        listarCategorias();
      } else {
        alert("Error al actualizar");
      }
    });
  });

  $(document).on("click", ".btnEliminar", function () {
    let id = $(this).data("id");
    if (confirm("¿Deseas eliminar esta categoría?")) {
      $.post("../controllers/CategoriaController.php?accion=eliminar", { id_categoria: id }, function (res) {
        if (res === "yes") {
          alert("Eliminado correctamente");
          listarCategorias();
        } else {
          alert("Error al eliminar");
        }
      });
    }
  });
});
