<?php
require_once("conexion.php");

class Clientes
{
    private $cn;

    public function __construct()
    {
        $this->cn = new Conexion();
        $this->cn->conectar();
    }

    // Verifica si un DNI ya existe
    public function existeDNI($dni)
    {
        $sql = "SELECT * FROM clientes WHERE dni = '$dni'";
        $resultado = $this->cn->getEjecutionQuery($sql);
        return $resultado->num_rows > 0;
    }


    public function existeTelefono($telefono)
    {
        $sql = "SELECT * FROM clientes WHERE telefono = '$telefono'";
        $resultado = $this->cn->getEjecutionQuery($sql);
        return $resultado->num_rows > 0;
    }


    public function existeCorreo($correo)
    {
        $sql = "SELECT * FROM clientes WHERE correo = '$correo'";
        $resultado = $this->cn->getEjecutionQuery($sql);
        return $resultado->num_rows > 0;
    }

 
    public function registrar_cliente($dni, $nom, $tel, $dire, $correo)
    {
        $sql = "INSERT INTO clientes(dni, nombre, telefono, direccion, correo)
                VALUES('$dni', '$nom', '$tel', '$dire', '$correo')";
        return $this->cn->getEjecutionQuery($sql);
    }


    public function eliminarCliente($dni)
    {
        $sql = "DELETE FROM clientes WHERE dni = '$dni'";
        return $this->cn->setEjecutionQuery($sql);
    }


    public function obtenerClientePorDNI($dni)
    {
        $sql = "SELECT * FROM clientes WHERE dni = '$dni'";
        $resultado = $this->cn->getEjecutionQuery($sql);
        return $resultado->fetch_assoc();
    }


    public function actualizarCliente($dni_original, $dni, $nombre, $telefono, $direccion, $correo)
    {
        $sql = "UPDATE clientes SET dni=?, nombre=?, telefono=?, direccion=?, correo=? WHERE dni=?";
        $stmt = $this->cn->getConexion()->prepare($sql);  // Corregir aquí usando $this->cn
        $stmt->bind_param("ssssss", $dni, $nombre, $telefono, $direccion, $correo, $dni_original);

        return $stmt->execute();
    }





    public function obtenerTodosLosClientes()
    {
        $sql = "SELECT * FROM clientes";
        $resultado = $this->cn->getEjecutionQuery($sql);
        $clientes = [];

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $clientes[] = $row;
            }
        }

        return $clientes;
    }
}
?>