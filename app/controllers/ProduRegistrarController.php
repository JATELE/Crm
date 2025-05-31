<?php
//Llamos a la clase Clientes.php
require_once("../models/Productos.php");
 //Inicializamos el objeto de la clase Clientes.php
$objeto = new Productos();
//Almacenamos los datos del formulario del panel_clientes.php dentro de una variable
$id = trim($_POST['id_p']);
$nombre = trim($_POST['nombre_p']);
$descripcion = trim($_POST['descripcion_p']);
$precio = trim($_POST['precio_p']);
$stock = trim($_POST['stock_p']);
$id_categoria = trim($_POST['categoria_p']);
//Utilizamos el metodo o funcion para registrar
if($objeto->registrar_producto($id,$nombre,$descripcion,$precio,$stock,$id_categoria)){
    header("Location: ../views/panel_productos_registrar.php");
}else{
    header("Location: ../views/panel_productos_registrar.php");
}
?>