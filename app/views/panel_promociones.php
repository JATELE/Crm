<?php
session_start();
if (isset($_SESSION["usuario_sesion"])) {
    $nombre_usuario = $_SESSION["usuario_sesion"]["nombre"];
    $apellido_usuario = $_SESSION["usuario_sesion"]["apellido"];
    $privilegios_usuario = $_SESSION["usuario_sesion"]["id_rol"];
} else {
    header("location: ../index.php");
    // echo "No existe la sessión";
    // exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registro de Promoción</title>
    <?php include_once("default/links-head.php") ?>

</head>
<style>
    select.form-select {
        max-height: 200px;
        overflow-y: auto;
    }

    .center-wrapper {
        display: flex;
        justify-content: center;
        padding: 20px;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require_once("default/navigation.php") ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Registro de Promoción <small>Control panel</small></h1>
                <ol class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Registro Promoción</li>
                </ol>
            </section>
            <section class="content">
                <div class="center-wrapper d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="box box-primary p-4">
                            <div class="box-header with-border text-center mb-3">
                                <h3 class="box-title">Registrar Promoción</h3>
                            </div>
                            <!-- Formulario de registro -->
                            <form action="../controllers/PromocionController.php" method="post">
                                <div class="box-body">
                                    <input type="hidden" name="accion" value="guardar">
                                    <div class="form-group mb-3">
                                        <label for="descripcion">Descripción de la Promoción</label>
                                        <textarea class="form-control text-center" id="descripcion" name="descripcion"
                                            rows="4" placeholder="Escribe aquí tu promoción 🎉✨🔥" required></textarea>
                                    </div>
                                </div>
                                <div class="box-footer text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Registrar
                                    </button>
                                    <button type="reset" class="btn btn-default">
                                        <i class="fa fa-eraser"></i> Limpiar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Listado de promociones -->
                <div class="row mt-4">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Promociones Registradas</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Descripción</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once "../models/Promocion.php";
                                        $promocion = new Promocion();
                                        $resultado = $promocion->listar();
                                        while ($row = $resultado->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $row['id_promocion'] ?></td>
                                                <td><?= nl2br($row['descripcion']) ?></td>
                                                <td><?= $row['created_at'] ?></td>
                                                <td class="text-center">
                                                    <!-- Botón Editar abre modal -->
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editarModal" data-id="<?= $row['id_promocion'] ?>"
                                                        data-descripcion="<?= htmlspecialchars($row['descripcion']) ?>">
                                                        <i class="fa fa-edit"></i> Editar
                                                    </button>

                                                    <!-- Botón Eliminar -->
                                                    <form class="form-eliminar"
                                                        action="../controllers/PromocionController.php" method="post"
                                                        style="display:inline;">
                                                        <input type="hidden" name="accion" value="eliminar">
                                                        <input type="hidden" name="id_promocion"
                                                            value="<?= $row['id_promocion'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modal Editar Promoción -->
            <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
                <div class="modal-dialog" role="document">
                    <form id="form-editar" action="../controllers/PromocionController.php" method="post">
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" id="edit_id" name="id_promocion">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="editarModalLabel">Editar Promoción</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Cerrar">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="edit_descripcion">Descripción</label>
                                    <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="4"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Guardar cambios
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Cancelar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Script para pasar datos al modal -->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    $('#editarModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget);
                        var id = button.data('id');
                        var descripcion = button.data('descripcion');

                        var modal = $(this);
                        modal.find('#edit_id').val(id);
                        modal.find('#edit_descripcion').val(descripcion);
                    });
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {

                    // Confirmación de Eliminar
                    $(".form-eliminar").on("submit", function (e) {
                        e.preventDefault(); // Evita enviar directamente
                        let form = this;
                        Swal.fire({
                            title: "¿Estás seguro?",
                            text: "Esta promoción se eliminará permanentemente",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Sí, eliminar",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });

                    // Confirmación de Guardar Cambios
                    document.getElementById("form-editar").addEventListener("submit", function (e) {
                        e.preventDefault();
                        let form = this;
                        Swal.fire({
                            title: "¿Deseas guardar los cambios?",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonColor: "#28a745",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Sí, guardar",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });

                    // Mensajes de éxito según parámetros en URL
                    const urlParams = new URLSearchParams(window.location.search);
                    const msg = urlParams.get("msg");

                    if (msg === "edit_ok") {
                        Swal.fire("¡Éxito!", "La promoción fue actualizada correctamente.", "success");
                    }
                    if (msg === "save_ok") {
                        Swal.fire("¡Guardado!", "La promoción fue registrada con éxito.", "success");
                    }
                    if (msg === "delete_ok") {
                        Swal.fire("¡Eliminada!", "La promoción se eliminó correctamente.", "success");
                    }
                });
            </script>

        </div>
        <?php require_once("default/footer.php"); ?>
    </div>
    <?php require_once("default/links-script.php"); ?>
</body>

</html>