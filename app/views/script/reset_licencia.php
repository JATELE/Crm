<?php
session_start();
require_once __DIR__ . '/../../models/conexion.php';

// Solo admin
if (!isset($_SESSION['usuario_sesion']) || $_SESSION['usuario_sesion']['id_rol'] != 1) {
    die("No tienes permisos para ejecutar esta acción.");
}

$db = new Conexion();
$db->conectar();
$conn = $db->getConexion();

// --- Desactivar licencia usada ---
$conn->query("UPDATE licencias 
               SET usado = 0, activado_por = NULL, fecha_activacion = NULL 
               WHERE usado = 1");

// --- Resetear configuración ---
$conn->query("UPDATE configuracion 
               SET version_pro = 'N', licencia_id = NULL, updated_at = NOW() 
               WHERE id = 1");

echo "<h3 style='color:green;'>✅ Licencia reiniciada correctamente.</h3>";
echo "<p>Puedes volver a probar la activación desde el panel de clientes.</p>";
?>
