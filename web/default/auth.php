<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logueado = isset($_SESSION["cliente_sesion"]);
$nombre = $logueado ? $_SESSION["cliente_sesion"]["nombre"] : "";
$apellido = $logueado ? $_SESSION["cliente_sesion"]["apellido"] : "";
$dni_cliente = $logueado ? $_SESSION["cliente_sesion"]["dni"] : "";

// Si el usuario está logueado, también traemos sus puntos
$puntos_cliente = 0;
if ($logueado) {
    require_once "../app/models/conexion.php";
    $con = new Conexion();
    $con->conectar();
    $conn = $con->getConexion();

    $stmt = $conn->prepare("SELECT puntos FROM clientes2 WHERE dni_cliente = ?");
    $stmt->bind_param("s", $dni_cliente);
    $stmt->execute();
    $stmt->bind_result($puntos_cliente);
    $stmt->fetch();
    $stmt->close();
}

// Recuperar errores y datos guardados en sesión (para login/registro)
$errores = $_SESSION['errores_registro'] ?? [];
$datos = $_SESSION['datos_registro'] ?? [];
$success = $_SESSION['success_registro'] ?? "";

if (!empty($errores) || !empty($success)) {
    unset($_SESSION['errores_registro'], $_SESSION['datos_registro'], $_SESSION['success_registro']);
}

// Función auxiliar para inputs de formularios
function inputField($type, $name, $label, $errores, $datos)
{
    $value = htmlspecialchars($datos[$name] ?? '');
    $isInvalid = isset($errores[$name]) ? 'is-invalid' : '';
    $errorMsg = $errores[$name] ?? '';

    echo "<div class='mb-3'>";
    echo "<label for='$name' class='form-label'>$label</label>";
    echo "<input type='$type' class='form-control $isInvalid' id='$name' name='$name' value='$value'>";
    if ($errorMsg) {
        echo "<div class='text-danger'>$errorMsg</div>";
    }
    echo "</div>";
}
?>
