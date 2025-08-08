<?php
require_once("conexion.php");

class Encuesta
{
    private $cn;

    public function __construct()
    {
        $this->cn = new Conexion();
        $this->cn->conectar();
    }

    public function registrar_encuesta($id_campana, $nombre, $descripcion, $fecha,$puntos)
    {
        $sql = "INSERT INTO encuestas2(id_campaña, nombre_encuesta, descripcion, fecha_creacion,puntos_encuesta)
                VALUES('$id_campana', '$nombre', '$descripcion', '$fecha', '$puntos')";
        return $this->cn->getEjecutionQuery($sql);
    }
    public function crear_encuesta($id_encuesta, $id_pregunta)
{
    $sql = "INSERT IGNORE INTO encuesta_pregunta2 (id_encuesta, id_pregunta)
        VALUES ('$id_encuesta', '$id_pregunta')";

    return $this->cn->getEjecutionQuery($sql);
}



    public function obtenerEncuestas()
    {
        $sql = "SELECT e.*, c.nombre_campaña 
                FROM encuestas2 e 
                JOIN campaña2 c ON e.id_campaña = c.id_campaña";
        $resultado = $this->cn->getEjecutionQuery($sql);

        $datos = [];
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;
    }

    public function eliminarEncuesta($id_encuesta)
    {
        $sql = "DELETE FROM encuestas2 WHERE id_encuesta = '$id_encuesta'";
        return $this->cn->setEjecutionQuery($sql);
    }
   public function obtenerEncuestasAgrupadas()
{
    $sql = "SELECT e.nombre_encuesta, 
                   GROUP_CONCAT(p.pregunta SEPARATOR '<br>- ') AS preguntas
            FROM encuesta_pregunta2 ep
            JOIN encuestas2 e ON e.id_encuesta = ep.id_encuesta
            JOIN preguntas2 p ON p.id_pregunta = ep.id_pregunta
            GROUP BY ep.id_encuesta
            ORDER BY e.nombre_encuesta ASC";

    $result = $this->cn->getEjecutionQuery($sql);
    $datos = [];

    while ($fila = $result->fetch_assoc()) {
        $datos[] = $fila;
    }

    return $datos;
}


}
?>
