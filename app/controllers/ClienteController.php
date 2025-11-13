<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../models/Clientes.php");
require_once("../models/conexion.php");

$objeto = new Clientes();
$accion = $_GET['accion'] ?? ($_POST['accion'] ?? '');


if ($accion === 'eliminar' && isset($_GET['dni'])) {
    $dni = $_GET['dni'];
    try {
        $objeto->eliminar_cliente_por_dni($dni);
        echo "ok";
    } catch (mysqli_sql_exception $e) {
        if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
            echo "relacion";
        } else {
            echo "Error al eliminar: " . $e->getMessage();
        }
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dni = $_POST['dni_c'] ?? null;
    $nombres = $_POST['nombre_c'] ?? '';
    $apellidos = $_POST['apellidos_c'] ?? '';
    $correo = $_POST['correo_c'] ?? '';
    $telefono = $_POST['telefono_c'] ?? '';
    $lugar_nacimiento = $_POST['lugar_c'] ?? '';
    $fecha_nacimiento = $_POST['fecha_c'] ?? '';
    $estado_civil = $_POST['estado_c'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    $errores = [];
    $_SESSION['datos_registro'] = $_POST;

    if ($accion === 'registrar' || $accion === 'registrarte') {
        if ($objeto->existeDNI($dni))
            $errores['dni_c'] = "El DNI ya está registrado.";
        if ($objeto->existeTelefono($telefono))
            $errores['telefono_c'] = "El teléfono ya está registrado.";
        if ($objeto->existeCorreo($correo))
            $errores['correo_c'] = "El correo ya está registrado.";
    }

    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;
        if ($accion === 'actualizar') {
            header("Location: ../views/editar_clientes.php?dni=" . urlencode($_POST['dni_original']));
        } elseif ($accion === 'registrarte') {
            header("Location: ../../web/InicioEncuestasInkarian.php?showModal=1");
        } else {
            header("Location: ../views/panel_clientes.php");
        }
        exit;
    }

    $cn = new Conexion();
    $cn->conectar();
    $conn = $cn->getConexion();

    $totalClientes = 0;
    $res = $conn->query("SELECT COUNT(*) AS total FROM clientes2");
    if ($res && $row = $res->fetch_assoc())
        $totalClientes = (int) $row['total'];

    $cfgRes = $conn->query("SELECT version_pro FROM configuracion WHERE id = 1");
    $versionPro = 'N';
    if ($cfgRes && $cfgRow = $cfgRes->fetch_assoc())
        $versionPro = $cfgRow['version_pro'];

    if ($totalClientes >= 100 && $versionPro !== 'S') {
        $_SESSION['errores_registro']['limite'] = '⚠️ Límite de 10 clientes alcanzado. Activa la licencia PRO para continuar.';
        header("Location: ../views/panel_clientes.php");
        exit;
    }
    if ($accion === 'actualizar') {
        $dni_original = $_POST['dni_original'];
        if ($objeto->editar_cliente($dni_original, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)) {
            unset($_SESSION['datos_registro']);
        }
        header("Location: ../views/listar_clientes.php");
        exit;
    }
    if ($accion === 'registrar') {
        if ($objeto->registrar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)) {
            unset($_SESSION['datos_registro']);
        }
        header("Location: ../views/panel_clientes.php");
        exit;
    }

    if ($accion === 'registrarte') {
        if ($objeto->registrar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)) {
            unset($_SESSION['datos_registro']);
            $_SESSION['success_registro'] = "¡Te registraste con éxito!";
        }
        header("Location: ../../web/InicioEncuestasInkarian.php");
        exit;
    }
    // --- Actualización en línea desde la tabla (sin modal) ---

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['campo'], $_POST['valor'], $_POST['dni'])) {

            $campo = $_POST['campo'];
            $valor = $_POST['valor'];
            $dni = $_POST['dni'];

            // Campos permitidos agrupados por tabla
            $permitidos = [
                // 🧍 clientes2
                'nombres_cliente',
                'apellidos_cliente',
                'correo_cliente',
                'telefono_cliente',
                'lugar_nacimiento',
                'fecha_nacimiento',
                'estado_civil',
                'password_cliente',
                'puntos',

                // 🎯 deseo2
                'destino',
                'presupuesto_estimado',
                'tiempo_estimado',

                // 🌄 experiencia2
                'bien_adquirido',
                'calificacion',
                'lugar_experiencia',
                'tipo_de_viaje',
                'fecha_visita',

                // 💬 interacciones2
                'fecha_interaccion',
                'canal_interaccion',
                'descripcion_interaccion'
            ];

            if (!in_array($campo, $permitidos)) {
                echo "campo_no_permitido";
                exit;
            }

            // Determinar la tabla y campo real
            if (
                in_array($campo, [
                    'nombres_cliente',
                    'apellidos_cliente',
                    'correo_cliente',
                    'telefono_cliente',
                    'lugar_nacimiento',
                    'fecha_nacimiento',
                    'estado_civil',
                    'password_cliente',
                    'puntos'
                ])
            ) {
                $tabla = "clientes2";
                $campo_real = $campo;
            } elseif (in_array($campo, ['destino', 'presupuesto_estimado', 'tiempo_estimado'])) {
                $tabla = "deseo2";
                $campo_real = $campo;
            } elseif (in_array($campo, ['bien_adquirido', 'calificacion', 'lugar_experiencia', 'tipo_de_viaje', 'fecha_visita'])) {
                $tabla = "experiencia2";
                $campo_real = ($campo === 'lugar_experiencia') ? 'lugar' : $campo;
            } elseif (in_array($campo, ['fecha_interaccion', 'canal_interaccion', 'descripcion_interaccion'])) {
                $tabla = "interacciones2";
                // Mapeo de nombres en la tabla real
                $map = [
                    'fecha_interaccion' => 'fecha',
                    'canal_interaccion' => 'canal',
                    'descripcion_interaccion' => 'descripcion'
                ];
                $campo_real = $map[$campo];
            } else {
                echo "tabla_no_definida";
                exit;
            }

            // 🟡 Verificar existencia de registro secundario y crear si no existe
            if ($tabla !== "clientes2") {
                $check = $conn->prepare("SELECT 1 FROM $tabla WHERE dni_cliente = ?");
                $check->bind_param("s", $dni);
                $check->execute();
                $res = $check->get_result();

                if ($res->num_rows === 0) {
                    $insert = $conn->prepare("INSERT INTO $tabla (dni_cliente) VALUES (?)");
                    $insert->bind_param("s", $dni);
                    $insert->execute();
                    $insert->close();
                }
                $check->close();
            }

            // 🟢 Actualizar el campo
            $sql = "UPDATE $tabla SET $campo_real = ? WHERE dni_cliente = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $valor, $dni);

            if ($stmt->execute()) {
                echo "ok";
            } else {
                echo "error";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "faltan_datos";
        }
    }


}
?>