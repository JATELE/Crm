<?php
include_once(__DIR__ . "/../../app/models/conexion.php");

$conexionObj = new Conexion();
$conexion = $conexionObj->conectar();

header('Content-Type: application/json');
session_start();

// Recibe mensaje
$input = json_decode(file_get_contents('php://input'), true);
$msg = strtolower(trim($input['message'] ?? ''));

// Normaliza texto (quita tildes y eñes)
$msg = str_replace(
    ['á', 'é', 'í', 'ó', 'ú', 'ñ'],
    ['a', 'e', 'i', 'o', 'u', 'n'],
    $msg
);

// Variables de sesión (contexto)
if (!isset($_SESSION['ultimo_gerente'])) $_SESSION['ultimo_gerente'] = 0;
if (!isset($_SESSION['ultimo_tema'])) $_SESSION['ultimo_tema'] = '';
if (!isset($_SESSION['paquete_mostrado'])) $_SESSION['paquete_mostrado'] = 0;

/* ------------------------------------------------------------
   🔧 Función: obtener contacto por rol
------------------------------------------------------------ */
function obtenerContacto($conexion, $rol, $titulo, $siguiente = false) {
    $query = "SELECT id_usuario, nombre, telefono FROM tb_usuario WHERE id_rol = $rol ORDER BY id_usuario ASC";
    $result = $conexion->query($query);

    if (!$result || $result->num_rows == 0) {
        return "No tengo registrado ningún número de $titulo 😔";
    }

    if ($siguiente && isset($_SESSION['ultimo_gerente'])) {
        $ultimo_id = $_SESSION['ultimo_gerente'];
    } else {
        $ultimo_id = 0;
    }

    while ($row = $result->fetch_assoc()) {
        if ($siguiente && $row['id_usuario'] > $ultimo_id) {
            $_SESSION['ultimo_gerente'] = $row['id_usuario'];
            return "Otro $titulo es {$row['nombre']} 📞 {$row['telefono']}";
        }

        if (!$siguiente) {
            $_SESSION['ultimo_gerente'] = $row['id_usuario'];
            return "El número del $titulo ({$row['nombre']}) es: 📞 {$row['telefono']}";
        }
    }

    $_SESSION['ultimo_gerente'] = 0;
    return "Ya te mostré a todos los $titulo que tengo registrados 😅";
}

/* ------------------------------------------------------------
   🌴 Paquetes turísticos simulados (supervisado)
------------------------------------------------------------ */
$paquetes = [
    [
        'nombre' => 'Laguna de Yarinacocha',
        'descripcion' => 'Paseo en bote, observación de delfines rosados y almuerzo típico 🐬🌿',
        'precio' => 'S/ 120 por persona',
        'duracion' => '1 día'
    ],
    [
        'nombre' => 'Cataratas de Velo de la Novia',
        'descripcion' => 'Excursión guiada por la selva, baño en la cascada y fotos panorámicas 📸🌳',
        'precio' => 'S/ 150 por persona',
        'duracion' => '1 día completo'
    ],
    [
        'nombre' => 'Tour Selva Amazónica',
        'descripcion' => 'Exploración con guía nativo, pesca artesanal y caminata nocturna 🐍🔥',
        'precio' => 'S/ 300 por persona',
        'duracion' => '2 días / 1 noche'
    ]
];

/* ------------------------------------------------------------
   🧠 Detección de intención principal
------------------------------------------------------------ */

// 🟦 Contacto de gerente o administrador
if (preg_match('/(numero|telefono|contactar|hablar|llamar|whatsapp).*?(gerente|administrador|encargado|jefe)/', $msg)) {
    if (strpos($msg, 'otro') !== false || strpos($msg, 'mas') !== false) {
        $_SESSION['ultimo_tema'] = 'contacto_gerente';
        echo json_encode(['respuesta' => obtenerContacto($conexion, 2, 'gerente', true)]);
        exit;
    }
    if (strpos($msg, 'jefe') !== false || strpos($msg, 'dueno') !== false) {
        echo json_encode(['respuesta' => "Lo siento 😔, no tengo permiso para compartir el número del jefe o dueño."]);
        exit;
    }

    $_SESSION['ultimo_tema'] = 'contacto_gerente';
    echo json_encode(['respuesta' => obtenerContacto($conexion, 2, 'gerente')]);
    exit;
}

// 🟦 Pedir paquetes turísticos o viajes
if (preg_match('/(paquete|viaje|tour|excursion|turistico)/', $msg)) {
    $_SESSION['ultimo_tema'] = 'paquetes';
    $_SESSION['paquete_mostrado'] = 0;

    $p = $paquetes[0];
    echo json_encode([
        'respuesta' => "🌴 Tenemos varios paquetes turísticos en Pucallpa.\n\n👉 *{$p['nombre']}*\n{$p['descripcion']}\n💰 {$p['precio']}\n🕒 Duración: {$p['duracion']}\n\n¿Deseas ver otro paquete?"
    ]);
    exit;
}

// 🟦 Continuar viendo paquetes
if ($_SESSION['ultimo_tema'] === 'paquetes' && preg_match('/(si|otro|mas|claro|porfavor)/', $msg)) {
    $_SESSION['paquete_mostrado']++;
    $i = $_SESSION['paquete_mostrado'];

    if ($i < count($paquetes)) {
        $p = $paquetes[$i];
        echo json_encode([
            'respuesta' => "👉 *{$p['nombre']}*\n{$p['descripcion']}\n💰 {$p['precio']}\n🕒 Duración: {$p['duracion']}\n\n¿Deseas ver otro paquete o hacer una reserva?"
        ]);
        exit;
    } else {
        echo json_encode([
            'respuesta' => "Ya te mostré todos los paquetes disponibles 😅. ¿Quieres que te ayude a hacer una *reserva*?"
        ]);
        exit;
    }
}

// 🟦 Solicitud de reserva
if (preg_match('/(reserva|reservar|agendar|quiero ir|quiero reservar)/', $msg)) {
    $_SESSION['ultimo_tema'] = 'reserva';
    echo json_encode([
        'respuesta' => "Perfecto 😄 Para hacer una reserva, por favor indícame:\n\n1️⃣ El nombre del paquete que deseas\n2️⃣ La cantidad de personas\n3️⃣ La fecha del viaje\n\nY te ayudaré a gestionarlo."
    ]);
    exit;
}

// 🟩 Si sigue el flujo de reserva
if ($_SESSION['ultimo_tema'] === 'reserva' && strlen($msg) > 5) {
    echo json_encode([
        'respuesta' => "¡Excelente! 🙌 Ya tengo tus datos. Un asesor se pondrá en contacto contigo pronto para confirmar la reserva. ¿Deseas ver más destinos mientras tanto?"
    ]);
    $_SESSION['ultimo_tema'] = '';
    exit;
}

/* ------------------------------------------------------------
   💬 Respuestas básicas supervisadas
------------------------------------------------------------ */
$respuestas = [
    'hola' => [
        '¡Hola! 😊 ¿Buscas información sobre viajes, reservas o contactos?',
        '¡Hey! 👋 Qué gusto verte por aquí. ¿Quieres ayuda con algo específico?'
    ],
    'buenas' => [
        '¡Buenas! 😄 ¿Deseas información sobre viajes o prefieres hablar con un asesor?'
    ],
    'gracias' => [
        '¡De nada! 😄 Siempre es un placer ayudarte.'
    ],
    'ayuda' => [
        'Claro 👍, dime con qué tema necesitas ayuda: viajes, reservas o contactos.'
    ],
    'adios' => [
        '¡Hasta pronto! 👋 Que tengas un excelente día.'
    ],
    'bye' => [
        '👋 ¡Nos vemos pronto!'
    ]
];

foreach ($respuestas as $clave => $variantes) {
    if (strpos($msg, $clave) !== false) {
        $_SESSION['ultimo_tema'] = $clave;
        echo json_encode(['respuesta' => $variantes[array_rand($variantes)]]);
        exit;
    }
}

/* ------------------------------------------------------------
   🔸 Respuesta por defecto
------------------------------------------------------------ */
$default_respuestas = [
    "Mmm... no entendí bien 🤔, ¿podrías decirlo de otra forma?",
    "No estoy seguro de entenderte 😅, pero puedo ayudarte con destinos, reservas o contactos.",
    "Disculpa 😅, aún no tengo información sobre eso, pero puedo guiarte con nuestros servicios turísticos."
];

echo json_encode(['respuesta' => $default_respuestas[array_rand($default_respuestas)]]);
?>
