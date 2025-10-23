<?php
// generar_codigo.php (ejecutar en consola o en entorno seguro)
function generarCodigo($prefijo = 'CRM') {
    $rand = bin2hex(random_bytes(6)); // 12 hex chars
    return strtoupper("{$prefijo}-" . substr($rand,0,6));
}

$codigo = generarCodigo('PRO');
$hash = password_hash($codigo, PASSWORD_DEFAULT);

// Muestra el código (texto) y el hash para insertar en BD
echo "CÓDIGO PUBLICO: $codigo\n";
echo "HASH (para DB): $hash\n";

// Puedes insertar en DB manualmente o con mysqli/pdo:
