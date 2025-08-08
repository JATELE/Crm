<?php
session_start();
require_once "../models/conexion.php";

if (!isset($_SESSION["cliente_sesion"])) {
    header("Location: ../../public/index.php");
    exit;
}

$cliente_dni = $_SESSION["cliente_sesion"]["dni"];
$id_encuesta = $_POST['id_encuesta'];
$respuestas = $_POST['respuestas'];

$con = new Conexion();
$con->conectar();

foreach ($respuestas as $id_pregunta => $texto_respuesta) {
    $stmt = $con->getConexion()->prepare("INSERT INTO respuesta (id_encuesta, id_pregunta, dni_cliente, texto_respuesta) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $id_encuesta, $id_pregunta, $cliente_dni, $texto_respuesta);
    $stmt->execute();
}

$con->cerrarConexion();

header("Location: ../../public/iniciotienda2.php?encuesta=respondida");
exit;
