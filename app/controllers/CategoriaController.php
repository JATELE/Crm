<?php
session_start();
require_once("../models/Categorias.php");

$objeto = new categorias();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    $accion = $_GET['accion'];

   

    if ($accion === 'eliminar' && isset($_GET['id_categoria'])) {
        $id = $_GET['id_categoria'];
        $objeto->eliminarCategoria($id);
        header("Location: ../views/editar_categoria.php");
        exit;
    }



    if ($accion === 'editar' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $resultado = $objeto->consultar_categoria_por_id($id);
        $categoria = $resultado->fetch_assoc();
        $_SESSION['categoria_editar'] = $categoria;
        header("Location: ../views/editar_categoria.php?id=" . $id);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $nombre = $_POST['nombre'];

    if ($accion === 'registrar') {
        if ($objeto->registrar_categoria($nombre)) {
            unset($_SESSION['datos_categoria']);
        }
        header("Location: ../views/panel_categoria_registar.php");
        exit;
    }

    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $nombre = $_POST['nombre'];

    if ($accion === 'registrar') {
        if ($objeto->registrar_categoria($nombre)) {

            unset($_SESSION['datos_categoria']);
        }
        header("Location: ../views/panel_categoria_registar.php");
        exit;
    }


}
?>