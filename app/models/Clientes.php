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
    public function consultar_dni_cliente($dni){
        //Inicializamos la conexion.php
        $cn = new conexion();
        //Utilizamos la funcion o metodo conectar()
        $cn->conectar();
        //Comando para consultar la lista
        $sql = "SELECT * FROM clientes WHERE dni = '$dni' ";
        //Ejecutamos el comando
         return $cn->setEjecutionQuery($sql);
    }
    public function editar_cliente($dni,$nombre,$telefono,$direccion,$correo){
        //Inicializamos la conexion.php
        $cn = new conexion();
        //Utilizamos la funcion o metodo conectar()
        $cn->conectar();
        //Comando para consultar la lista
        $sql = "UPDATE clientes 
                SET nombre ='$nombre', telefono='$telefono', direccion='$direccion' , correo='$correo' 
                WHERE dni = '$dni' ";
        //Ejecutamos el comando
         return $cn->setEjecutionQuery($sql);
    }
    public function reportes_clientes(){
        //Inicializamos la conexion.php
        $cn = new conexion();
        //Utilizamos la funcion o metodo conectar()
        $cn->conectar();
        //Comando para consultar la lista
        $sql = "SELECT * FROM clientes";
        //Ejecutamos el comando
         return $cn->getEjecutionQuery($sql);
    }
    public function eliminar_cliente_por_dni($dni){
        
        $cn = new conexion();
       
        $cn->conectar();
       
        $sql = "DELETE FROM clientes WHERE dni = '$dni' ";
       
         return $cn->setEjecutionQuery($sql);
    }
}
?>