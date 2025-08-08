<?php
require_once("../models/Encuesta.php");

$encuesta = new Encuesta();

$id_encuesta = trim($_POST['id_encuesta']);
$id_preguntas = $_POST['id_pregunta']; // Esto es un array

$todoCorrecto = true;

foreach ($id_preguntas as $id_pregunta) {
    if (!$encuesta->crear_encuesta($id_encuesta, $id_pregunta)) {
        $todoCorrecto = false;
        break;
    }
}

if ($todoCorrecto) {
    header("Location: ../views/panel_crear_encuesta.php?success=1");
} else {
    header("Location: ../views/panel_crear_encuesta.php?error=1");
}
?>
