<?php
session_start();
require_once __DIR__ . '/../../models/conexion.php';
header('Content-Type: application/json');

// Solo admin
if (!isset($_SESSION['usuario_sesion']) || $_SESSION['usuario_sesion']['id_rol'] != 1) {
    echo json_encode(['status'=>'error','message'=>'No tienes permisos para realizar esta acción.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_ingresado = trim($_POST['codigo'] ?? '');

    if ($codigo_ingresado === '') {
        echo json_encode(['status'=>'error','message'=>'Ingresa un código de licencia.']);
        exit;
    }

    $db = new Conexion();
    $db->conectar();
    $conn = $db->getConexion();

    if (!$conn) {
        echo json_encode(['status'=>'error','message'=>'No se pudo conectar con la base de datos.']);
        exit;
    }

    // Buscar licencias no usadas
    $stmt = $conn->query("SELECT id, codigo_hash, usado FROM licencias WHERE usado = 0");
    $activado = false;

    while ($row = $stmt->fetch_assoc()) {
        if (password_verify($codigo_ingresado, $row['codigo_hash'])) {
            $licencia_id = (int)$row['id'];
            $usuario = $conn->real_escape_string($_SESSION['usuario_sesion']['nombre']);
            $now = date('Y-m-d H:i:s');

            // Actualizar licencia
            $conn->query("UPDATE licencias 
                          SET usado = 1, activado_por = '$usuario', fecha_activacion = '$now' 
                          WHERE id = $licencia_id");

            // Actualizar configuración
            $conn->query("UPDATE configuracion 
                          SET version_pro = 'S', licencia_id = $licencia_id, updated_at = '$now' 
                          WHERE id = 1");

            $activado = true;
            break;
        }
    }

    if ($activado) {
        echo json_encode(['status'=>'success','message'=>'Licencia activada correctamente.']);
    } else {
        echo json_encode(['status'=>'error','message'=>'Código inválido o ya usado.']);
    }

    exit;
}

echo json_encode(['status'=>'error','message'=>'Método no permitido.']);
exit;
