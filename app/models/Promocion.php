<?php
require_once "Conexion.php";

class Promocion extends Conexion {

    public function listar() {
        $sql = "SELECT * FROM promociones2 ORDER BY created_at DESC";
        return $this->conectar()->query($sql);
    }

    public function guardar($descripcion) {
        $sql = "INSERT INTO promociones2 (descripcion) VALUES (?)";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bind_param("s", $descripcion);
        return $stmt->execute();
    }

    public function obtener($id) {
        $sql = "SELECT * FROM promociones2 WHERE id_promocion=?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function editar($id, $descripcion) {
        $sql = "UPDATE promociones2 SET descripcion=? WHERE id_promocion=?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bind_param("si", $descripcion, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM promociones2 WHERE id_promocion=?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
