<?php 
// Verificar si hay un error recibido desde el controlador
if (isset($_GET['error'])) {
    $error = urldecode($_GET['error']);
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '$error'
            });
        });
    </script>";
}

// Incluir la vista de login
require_once 'views/Registrate.php'; 
?>
