<?php
// Llamamos a la clase Campaña.php (modelo)
require_once("../models/Campaña.php");

// Inicializamos el objeto de la clase Campaña
$objeto = new Campaña();

// Almacenamos los datos del formulario
$nombre = trim($_POST['nombre_campaña']);
$descripcion = trim($_POST['descripcion']);
$fecha_inicio = trim($_POST['fecha_inicio']);
$fecha_fin = trim($_POST['fecha_fin']);

// Utilizamos el método para registrar la campaña
if ($objeto->registrar_campaña($nombre, $descripcion, $fecha_inicio, $fecha_fin)) {
    header("Location: ../views/panel_campaña_registrar.php?success=1");
} else {
    header("Location: ../views/panel_campaña_registrar.php?error=1");
}
?>