<?php

require_once("../models/Productos.php");

$objeto = new Productos();
//Hacemos una condicional si existe el GET['dni_c']
if(isset($_GET['id_P'])){
    $variable_id = $_GET['id_P']; //almacenamos en una variable el dato GET
    //Almacenamos la funcion en la variable $resultado_lista
    $resultado_lista = $objeto->consultar_producto($variable_id); 

    //Almacenamos dentro de un Array
    $datos_productos = [];

    // hacemos un bucle para consultar a los clientes
    // $fila es la variable que almacenaremos todos los datos del cliente
    while($fila = $resultado_lista->fetch_array(MYSQLI_ASSOC)){
        // print_r($fila);
        $datos_productos[] = $fila;
    }

    //Creamos el formato JSON
    header('Content-Type: application/json');
    echo json_encode($datos_productos);
}


?>