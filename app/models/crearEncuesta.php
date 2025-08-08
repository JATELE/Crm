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

    public function registrar_encuesta($id_campana, $nombre, $descripcion, $fecha)
    {
        $sql = "INSERT INTO encuestas2(id_campaña, nombre_encuesta, descripcion, fecha_creacion)
                VALUES('$id_campana', '$nombre', '$descripcion', '$fecha')";
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
}
?>
