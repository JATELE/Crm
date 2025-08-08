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
        $sql = "SELECT * FROM clientes2 WHERE dni_cliente = '$dni'";
        $resultado = $this->cn->getEjecutionQuery($sql);
        return $resultado->num_rows > 0;
    }


    public function existeTelefono($telefono)
    {
        $sql = "SELECT * FROM clientes2 WHERE telefono_cliente = '$telefono'";
        $resultado = $this->cn->getEjecutionQuery($sql);
        return $resultado->num_rows > 0;
    }


    public function existeCorreo($correo)
    {
        $sql = "SELECT * FROM clientes2 WHERE correo_cliente = '$correo'";
        $resultado = $this->cn->getEjecutionQuery($sql);
        return $resultado->num_rows > 0;
    }



    public function registrar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)
    {
        $cn = new conexion();
        $cn->conectar();
        $sql = "INSERT INTO clientes2 (
    dni_cliente,
    nombres_cliente,
    apellidos_cliente,
    correo_cliente,
    telefono_cliente,
    lugar_nacimiento,
    fecha_nacimiento,
    estado_civil,
    password_cliente,
    fecha_registro
) VALUES (
    '$dni',
    '$nombres',
    '$apellidos',
    '$correo',
    '$telefono',
    '$lugar_nacimiento',
    '$fecha_nacimiento',
    '$estado_civil',
    '$contraseña',
    NOW()
)";


        return $cn->getEjecutionQuery($sql);
    }



    public function obtenerTodosLosClientes()
    {
        $sql = "SELECT * FROM clientes2";
        $resultado = $this->cn->getEjecutionQuery($sql);
        $clientes = [];

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $clientes[] = $row;
            }
        }

        return $clientes;
    }
    public function consultar_dni_cliente($dni)
    {
        $cn = new conexion();
        $cn->conectar();
        $sql = "SELECT * FROM clientes2 WHERE dni_cliente = '$dni'";
        return $cn->setEjecutionQuery($sql);
    }

    public function editar_cliente($dni, $nombres, $apellidos, $correo, $telefono, $lugar_nacimiento, $fecha_nacimiento, $estado_civil, $contraseña)
    {
        $cn = new conexion();
        $cn->conectar();

        $sql = "UPDATE clientes2 SET 
                nombres_cliente = '$nombres',
                apellidos_cliente = '$apellidos',
                correo_cliente = '$correo',
                telefono_cliente = '$telefono',
                lugar_nacimiento = '$lugar_nacimiento',
                fecha_nacimiento = '$fecha_nacimiento',
                estado_civil = '$estado_civil',
                password_cliente = '$contraseña'
            WHERE dni_cliente = '$dni'";

        return $cn->setEjecutionQuery($sql);
    }


    public function reportes_clientes()
    {
        //Inicializamos la conexion.php
        $cn = new conexion();
        //Utilizamos la funcion o metodo conectar()
        $cn->conectar();
        //Comando para consultar la lista
        $sql = "SELECT * FROM clientes2";
        //Ejecutamos el comando
        return $cn->getEjecutionQuery($sql);
    }
    public function eliminar_cliente_por_dni($dni)
    {

        $cn = new conexion();

        $cn->conectar();

        $sql = "DELETE FROM clientes2 WHERE dni_cliente = '$dni' ";

        return $cn->setEjecutionQuery($sql);
    }
}
?>