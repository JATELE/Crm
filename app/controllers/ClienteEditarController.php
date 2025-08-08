<?php
require_once("../models/Clientes.php");

if (
    isset($_POST['dni_c']) &&
    isset($_POST['nombres_c']) &&
    isset($_POST['apellidos_c']) &&
    isset($_POST['correo_c']) &&
    isset($_POST['telefono_c']) &&
    isset($_POST['lugar_c']) &&
    isset($_POST['fecha_c']) &&
    isset($_POST['estado_c'])
) {
    $dni = $_POST['dni_c'];
    $nombres = $_POST['nombres_c'];
    $apellidos = $_POST['apellidos_c'];
    $correo = $_POST['correo_c'];
    $telefono = $_POST['telefono_c'];
    $lugar_nacimiento = $_POST['lugar_c'];
    $fecha_nacimiento = $_POST['fecha_c'];
    $estado_civil = $_POST['estado_c'];

    $objeto = new Clientes();

    if ($objeto->editar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil)) {
        echo "yes";
    } else {
        echo "nope";
    }
} else {
    echo "nope";
}

