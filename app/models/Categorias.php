<?php
require_once("conexion.php");

class categorias
{
    private $cn;

    public function __construct()
    {
        $this->cn = new Conexion();
        $this->cn->conectar();
    }

  
 
 
    public function registrar_categoria($nom)
    {
        $sql = "INSERT INTO categorias(nombre)
                VALUES('$nom')";
        return $this->cn->getEjecutionQuery($sql);
    }

// Listar todas las categorías
public function obtenerCategorias()
{
    $sql = "SELECT * FROM categorias";
    $resultado = $this->cn->getEjecutionQuery($sql);
    $categorias = [];

    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $categorias[] = $row;
        }
    }

    return $categorias;
}

// Consultar una categoría por ID
public function consultar_categoria_por_id($id_categoria)
{
    $sql = "SELECT * FROM categorias WHERE id_categoria = '$id_categoria'";
    return $this->cn->getEjecutionQuery($sql);
}

// Editar categoría
public function editar_categoria($id_categoria, $nombre)
{
    $sql = "UPDATE categorias SET nombre = '$nombre' WHERE id_categoria = '$id_categoria'";
    return $this->cn->setEjecutionQuery($sql);
}

// Eliminar categoría
public function eliminarCategoria($id_categoria) {
    $sql = "DELETE FROM categorias WHERE id_categoria = '$id_categoria'";
    return $this->cn->setEjecutionQuery($sql);
}



}
?>