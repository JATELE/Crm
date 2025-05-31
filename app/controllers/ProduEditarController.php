<?php
require_once("../models/Productos.php");
$objeto = new Productos();

$variable_dni = $_POST['id_p'];
$variable_nombre = $_POST['nombre_p'];
$variable_descripcion = $_POST['descripcion_p'];
$variable_precio = $_POST['precio_p'];
$variable_stock = $_POST['stock_p'];
$variable_categoria = $_POST['categoria_p'];

if($objeto->editar_producto($variable_dni, $variable_nombre, $variable_descripcion, $variable_precio, $variable_stock, $variable_categoria)){
    header("Location: ../views/panel_productos_reportes.php");
    exit();
}else{
    header("Location: ../views/panel_productos_reportes.php");
    exit();
}
?>
