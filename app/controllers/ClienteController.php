<?php
session_start();
require_once("../models/Clientes.php");

$objeto = new Clientes();

// Eliminar cliente por DNI (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion === 'eliminar' && isset($_GET['dni'])) {
        $dni = $_GET['dni'];
        $objeto->eliminar_cliente_por_dni($dni);
        header("Location: ../views/listar_clientes.php");
        exit;
    }
}

// Registrar o actualizar cliente (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    $dni = $_POST['dni_c'];
    $nombres = $_POST['nombre_c'];
    $apellidos = $_POST['apellidos_c'];
    $correo = $_POST['correo_c'];
    $telefono = $_POST['telefono_c'];
    $lugar_nacimiento = $_POST['lugar_c'];
    $fecha_nacimiento = $_POST['fecha_c'];
    $estado_civil = $_POST['estado_c'];
    $contraseña = $_POST['contraseña'];

    $errores = [];

    // Validaciones si se va a registrar
    if ($accion === 'registrar' || $accion === 'registrarte') {
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

    // Si hay errores, redirigir con errores
    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;
        if ($accion === 'actualizar') {
            header("Location: ../views/editar_clientes.php?dni=" . urlencode($_POST['dni_original']));
        } elseif ($accion === 'registrarte') {
            header("Location: ../indexRegister.php");
        } else {
            header("Location: ../views/panel_clientes.php");
        }
        exit();
    }

    // Actualizar
    if ($accion === 'actualizar') {
        $dni_original = $_POST['dni_original'];
        if ($objeto->editar_cliente($dni_original, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)) {
            unset($_SESSION['datos_registro']);
        }
        header("Location: ../views/listar_clientes.php");
        exit;
    }

    // Registrar desde panel
    if ($accion === 'registrar') {
        if ($objeto->registrar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)) {
            unset($_SESSION['datos_registro']);
        }
        header("Location: ../views/panel_clientes.php");
        exit;
    }

    // Registrar desde indexRegister
    if ($accion === 'registrarte') {
        if ($objeto->registrar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)) {
            unset($_SESSION['datos_registro']);
        }
        header("Location: ../../web/iniciotienda.php");
        exit;
    }
}
?>
