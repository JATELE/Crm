<?php
require_once("../models/Encuesta.php");

$encuesta = new Encuesta();

$id_campaña = trim($_POST['id_campaña']);
$nombre = trim($_POST['nombre_encuesta']);
$descripcion = trim($_POST['descripcion']);
$fecha_creacion = trim($_POST['fecha_creacion']);
$puntos = trim($_POST['puntos_encuesta']);

if ($encuesta->registrar_encuesta($id_campaña, $nombre, $descripcion, $fecha_creacion,$puntos )) {
    header("Location: ../views/panel_encuesta_registrar.php?success=1");
} else {
    header("Location: ../views/panel_encuesta_registrar.php?error=1");
}
?>
