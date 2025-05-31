<?php
session_start();
require_once("../models/Productos.php");

$objeto = new Productos();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion === 'eliminar' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $objeto->eliminar_producto($id);
        header("Location: ../views/panel_productos_reportes.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    $errores = [];

    if ($accion === 'registrar') {
        if ($objeto->existeID($id)) {
            $errores['id_producto'] = "El ID del producto ya está registrado.";
        }
    }

    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;
        header("Location: ../views/panel_productos_reportes.php");
        exit();
    }

    if ($accion === 'registrar') {
        if ($objeto->registrar_producto($id, $nombre, $descripcion, $precio, $stock, $id_categoria)) {
            unset($_SESSION['datos_registro']);
        }
        header("Location: ../views/panel_productos_reportes.php");
        exit;
    }

    
}
?>
