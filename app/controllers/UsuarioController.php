<?php 
session_start();
require_once("../models/Usuario.php");

$objeto = new Usuario(); 


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion === 'eliminar' && isset($_GET['id_usuario'])) {
    $id = intval($_GET['id_usuario']); // aseguramos que sea numérico
    if ($objeto->eliminarUsuario($id)) {
        header("Location: ../views/panel_usuarios_reportes.php?msg=eliminado");
    } else {
        header("Location: ../views/panel_usuarios_reportes.php?msg=error");
    }
    exit;
}


    if ($accion === 'editar' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $resultado = $objeto->consultar_usuario_por_id($id);
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario_editar'] = $usuario;
        header("Location: ../views/editar_usuario.php?id=" . $id);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];
    $id_rol = $_POST['id_rol'];

    if ($accion === 'registrar') {
    $password = $_POST['password'];

    if ($objeto->existe_usuario($usuario)) {
        $_SESSION['mensaje_usuario'] = [
            'tipo' => 'error',
            'titulo' => 'Error',
            'texto' => 'El nombre de usuario ya está en uso.'
        ];
        header("Location: ../views/panel_usuarios_registrar.php");
        exit;
    }

    if ($objeto->registrar_usuario($nombre, $apellido, $usuario, $password, $telefono, $id_rol)) {
        $_SESSION['mensaje_usuario'] = [
            'tipo' => 'success',
            'titulo' => '¡Éxito!',
            'texto' => 'Usuario registrado con éxito.'
        ];
    } else {
        $_SESSION['mensaje_usuario'] = [
            'tipo' => 'error',
            'titulo' => 'Error',
            'texto' => 'Hubo un problema al registrar el usuario.'
        ];
    }

    header("Location: ../views/panel_usuarios_registrar.php");
    exit;
}



    if ($accion === 'editar') {
        $id_usuario = $_POST['id_usuario'];
        $estado = $_POST['estado'] ?? 1;
        if ($objeto->editar_usuario($id_usuario, $nombre, $apellido, $usuario, $telefono, $id_rol, $estado)) {
            unset($_SESSION['usuario_editar']);
        }
        header("Location: ../views/editar_usuario.php");
        exit;
    }
}
?>
