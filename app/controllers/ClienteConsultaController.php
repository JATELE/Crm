<?php
require_once("../models/Clientes.php");
$objeto = new Clientes();

if (isset($_GET['dni_c'])) {
    $variable_dni = $_GET['dni_c'];
    $resultado_lista = $objeto->consultar_dni_cliente($variable_dni);
    $datos_cliente = [];

    while ($fila = $resultado_lista->fetch_array(MYSQLI_ASSOC)) {
        $datos_cliente[] = $fila;
    }

    header('Content-Type: application/json');
    echo json_encode($datos_cliente); // CORREGIDO
}
?>
