<?php
require_once("../models/Usuario.php");
$objeto = new Usuario();

// Obtener los datos del formulario
$id_usuario = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$telefono = $_POST['telefono'];
$id_rol = $_POST['id_rol'];
$estado = $_POST['estado'];

// Verificación básica
if (empty($id_usuario) || empty($id_rol)) {
    echo "ID de usuario o rol no válido.";
    exit;
}

// Ejecutar actualización
$objeto->editar_usuario($id_usuario, $nombre, $apellido, $usuario, $telefono, $id_rol, $estado);

// Redirigir después de editar
header("Location: ../views/panel_usuarios_reportes.php");
exit();
