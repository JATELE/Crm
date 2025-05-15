<?php
session_start();
require_once("../models/Clientes.php");

$objeto = new Clientes();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion === 'editar' && isset($_GET['dni'])) {
        $dni = $_GET['dni'];
        header("Location: ../views/editar_clientes.php?dni=$dni");
        exit;
    }

    if ($accion === 'eliminar' && isset($_GET['dni'])) {
        $dni = $_GET['dni'];
        $objeto->eliminarCliente($dni);
        header("Location: ../views/listar_clientes.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $dni = $_POST['dni_c'];
    $nombre = $_POST['nombre_c'];
    $telefono = $_POST['telefono_c'];
    $direccion = $_POST['direccion_c'];
    $correo = $_POST['correo_c'];

    if ($accion === 'actualizar') {
        $dniOriginal = $_POST['dni_original'];
        $objeto->actualizarCliente($dniOriginal, $dni, $nombre, $telefono, $direccion, $correo);
        header("Location: ../views/listar_clientes.php");
        exit;
    }


    $errores = [];

    if ($accion === 'registrar') {
        if ($objeto->existeDNI($dni)) {
            $errores['dni_c'] = "El DNI ya está registrado.";
        }
        if ($objeto->existeTelefono($telefono)) {
            $errores['telefono_c'] = "El teléfono ya está registrado.";
        }
        if ($objeto->existeCorreo($correo)) {
            $errores['correo_c'] = "El correo ya está registrado.";
        }
    }

    if ($accion === 'actualizar') {
        $dniOriginal = $_POST['dni_original'];

        if ($dni !== $dniOriginal && $objeto->existeDNI($dni)) {
            $errores['dni_c'] = "El nuevo DNI ya está registrado.";
        }

        $clienteOriginal = $objeto->obtenerClientePorDNI($dniOriginal);

        if ($telefono !== $clienteOriginal['telefono'] && $objeto->existeTelefono($telefono)) {
            $errores['telefono_c'] = "El teléfono ya está registrado.";
        }

        if ($correo !== $clienteOriginal['correo'] && $objeto->existeCorreo($correo)) {
            $errores['correo_c'] = "El correo ya está registrado.";
        }
    }

 
    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;

        if ($accion === 'actualizar') {
            header("Location: ../views/editar_clientes.php?dni=" . urlencode($_POST['dni_original']));
        } else {
            header("Location: ../views/panel_clientes.php");
        }
        exit();
    }


    if ($accion === 'registrar') {
        if ($objeto->registrar_cliente($dni, $nombre, $telefono, $direccion, $correo)) {
            unset($_SESSION['datos_registro']);
        }
        header("Location: ../views/panel_clientes.php");
        exit;
    }

    if ($accion === 'actualizar') {
        $dniOriginal = $_POST['dni_original'];
        $objeto->actualizarCliente($dniOriginal, $dni, $nombre, $telefono, $direccion, $correo);
        unset($_SESSION['datos_registro']);
        header("Location: ../views/listar_clientes.php");
        exit;
    }
}
?>
