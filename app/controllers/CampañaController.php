<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../models/Campaña.php");

$objeto = new Campaña();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    // Eliminar campaña
    if ($accion === 'eliminar' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $objeto->eliminar_campaña($id);
        header("Location: ../views/panel_campaña_reportes.php"); // Cambia según tu vista
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $id = $_POST['id_campaña'] ?? null;
    $nombre = $_POST['nombre_campaña'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $errores = [];

    // Validación básica (puedes ampliar más)
    if (empty($nombre)) {
        $errores['nombre_campaña'] = "El nombre es obligatorio.";
    }

    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;
        header("Location: ../views/panel_campaña_reportes.php");
        exit();
    }

    // Registrar nueva campaña
    if ($accion === 'registrar') {
        $objeto->registrar_campaña($nombre, $descripcion, $fecha_inicio, $fecha_fin);
        header("Location: ../views/panel_campaña_reportes.php");
        exit;
    }

    // Editar campaña existente
    if ($accion === 'editar' && $id !== null) {
        $objeto->editar_campaña($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin);
        header("Location: ../views/panel_campaña.php");
        exit;
    }
}
?>
