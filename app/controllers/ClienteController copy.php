<?php
session_start();
require_once("../models/Clientes.php");

$objeto = new Clientes();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    $accion = $_GET['accion'];


}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrarte';
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

    if ($accion === 'registrarte') {
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
    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;


        header("Location: ../indexRegister.php");
    }
    exit();
}





if ($accion === 'registrarte') {
    if ($objeto->registrar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)) {
        unset($_SESSION['datos_registro']);
    }
    header("Location: ../../web/InicioEncuestasInkarian.php");
    exit;
}


?>