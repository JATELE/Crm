<?php
require_once("conexion.php");

class Campaña
{
    // Registrar una nueva campaña
    public function registrar_campaña($nombre, $descripcion, $fecha_inicio, $fecha_fin)
    {
        $cn = new conexion();
        $cn->conectar();
        $sql = "INSERT INTO campaña2(nombre_campaña, descripcion, fecha_inicio, fecha_fin)
            VALUES ('$nombre', '$descripcion', '$fecha_inicio', '$fecha_fin')";
        return $cn->setEjecutionQuery($sql);
    }
    // Listar todas las campañas
    public function listar_campaña()
    {
        $cn = new conexion();
        $cn->conectar();
        $sql = "SELECT * FROM campaña2";
        return $cn->getEjecutionQuery($sql);
    }

    // Eliminar una campaña por ID
    public function eliminar_campaña($id_campaña)
    {
        $cn = new conexion();
        $cn->conectar();
        $sql = "DELETE FROM campaña2 WHERE id_campaña = $id_campaña";
        return $cn->setEjecutionQuery($sql);
    }

    // Editar una campaña por ID
    public function editar_campaña($id_campaña, $nombre, $descripcion, $fecha_inicio, $fecha_fin)
    {
        $cn = new conexion();
        $cn->conectar();
        $sql = "UPDATE campaña2 
                SET nombre_campaña='$nombre', 
                    descripcion='$descripcion', 
                    fecha_inicio='$fecha_inicio', 
                    fecha_fin='$fecha_fin' 
                WHERE id_campaña=$id_campaña";
        return $cn->setEjecutionQuery($sql);
    }

    // Consultar campaña por ID
    public function consultar_campaña($id_campaña)
    {
        $cn = new conexion();
        $cn->conectar();
        $sql = "SELECT * FROM campaña2 WHERE id_campaña = $id_campaña";
        return $cn->getEjecutionQuery($sql);
    }
}
?>