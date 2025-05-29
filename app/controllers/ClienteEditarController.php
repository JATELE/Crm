<?php
// Importar la clase Clientes.php
require_once("../models/Clientes.php");

// Verificar si se recibieron todos los datos necesarios por POST
if (
    isset($_POST['dni_c']) &&
    isset($_POST['name_c']) &&
    isset($_POST['telefono_c']) &&
    isset($_POST['direccion_c']) &&
    isset($_POST['correo_c'])
) {
    // Asignar las variables desde el POST
    $variable_dni = $_POST['dni_c'];
    $variable_nombre = $_POST['name_c'];
    $variable_telefono = $_POST['telefono_c'];
    $variable_direccion = $_POST['direccion_c'];
    $variable_correo = $_POST['correo_c'];

    // Crear una instancia del modelo Clientes
    $objeto = new Clientes();

    // Llamar al método de edición
    if ($objeto->editar_cliente($variable_dni, $variable_nombre, $variable_telefono, $variable_direccion, $variable_correo)) {
        echo "yes";
    } else {
        echo "nope";
    }
} else {
    // Datos incompletos
    echo "nope";
}
?>
