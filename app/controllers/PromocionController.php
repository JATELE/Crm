<?php
require_once "../models/Promocion.php";

$promocion = new Promocion();

if (isset($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case "guardar":
            $promocion->guardar($_POST["descripcion"]);
            break;

        case "editar":
            $promocion->editar($_POST["id_promocion"], $_POST["descripcion"]);
            break;

        case "eliminar":
            $promocion->eliminar($_POST["id_promocion"]);
            break;
    }
    header("Location: ../views/panel_promociones.php");
    exit;
}
