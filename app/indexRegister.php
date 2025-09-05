<?php
session_start();

// Capturar errores y datos si existen
$errores = $_SESSION['errores_registro'] ?? [];
$datos = $_SESSION['datos_registro'] ?? [];

// Limpiar después de usarlos
unset($_SESSION['errores_registro'], $_SESSION['datos_registro']);

// Incluir la vista de inicio (donde está el modal)
require_once '../web/InicioEncuestasInkarian.php';

// Si hubo errores, abrir el modal automáticamente
if (isset($_GET['showModal']) && $_GET['showModal'] == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('modalRegistro'));
            modal.show();
        });
    </script>";
}
?>
