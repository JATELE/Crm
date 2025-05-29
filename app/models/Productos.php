<?php
require_once("conexion.php");

class Productos {
    public function registrar_producto($id, $nombre, $descripcion, $precio, $stock, $id_categoria) {
        $cn = new conexion();
        $cn->conectar();
        $sql = "INSERT INTO productos(id_producto, nombre, descripcion, precio, stock, id_categoria)
                VALUES ('$id', '$nombre', '$descripcion', '$precio', '$stock', '$id_categoria')";
        return $cn->setEjecutionQuery($sql);
    }

    public function listar_productos() {
        $cn = new conexion();
        $cn->conectar();
        $sql = "SELECT p.*, c.nombre AS categoria
                FROM productos p
                LEFT JOIN categorias c ON p.id_categoria = c.id_categoria";
        return $cn->getEjecutionQuery($sql);
    }

    public function eliminar_producto($id_producto) {
        $cn = new conexion();
        $cn->conectar();
        $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
        return $cn->setEjecutionQuery($sql);
    }

    public function editar_producto($id_producto, $nombre, $descripcion, $precio, $stock, $id_categoria) {
        $cn = new conexion();
        $cn->conectar();
        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio',
                stock='$stock', id_categoria='$id_categoria' WHERE id_producto=$id_producto";
        return $cn->setEjecutionQuery($sql);
    }

    public function consultar_producto($id_producto) {
        $cn = new conexion();
        $cn->conectar();
        $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
        return $cn->getEjecutionQuery($sql);
    }
}
?>
