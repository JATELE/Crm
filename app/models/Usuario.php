<?php
//Llamamos la conexion
require_once 'conexion.php';
//Instancio o creo una clase o objeto
class Usuario{
    private $cn;

    public function __construct()
    {
        $this->cn = new Conexion();
        $this->cn->conectar();
    }
    
    //Funcion para consultar a un usuario y logearse
    public function getLoginUsuario(){
        //Instanciamos el objeto
        // y almacenamos dentro de una variable
        $cn = new Conexion();
        $cn->conectar(); //utilizamos el metodo del objeto
        $sql = "SELECT * FROM tb_usuario"; //creamos el script del SQL
        return $cn->getEjecutionQuery($sql); //Obtenemos los datos de la ejecucion
    }
    public function registrar_usuario($nombre, $apellido, $usuario, $password, $telefono, $id_rol) {
        $sql = "INSERT INTO tb_usuario(nombre, apellido, usuario, password, telefono, id_rol)
                VALUES ('$nombre', '$apellido', '$usuario', '$password', '$telefono', '$id_rol')";
        return $this->cn->setEjecutionQuery($sql);
    }

    // ✅ Obtener todos los usuarios
    public function obtenerUsuarios() {
        $sql = "SELECT * FROM tb_usuario";
        $resultado = $this->cn->getEjecutionQuery($sql);
        $usuarios = [];

        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

    // ✅ Consultar usuario por ID
    public function consultar_usuario_por_id($id_usuario) {
        $sql = "SELECT * FROM tb_usuario WHERE id_usuario = '$id_usuario'";
        return $this->cn->getEjecutionQuery($sql);
    }

    // ✅ Editar usuario
    public function editar_usuario($id_usuario, $nombre, $apellido, $usuario, $telefono, $id_rol, $estado) {
        $sql = "UPDATE tb_usuario 
                SET nombre = '$nombre', apellido = '$apellido', usuario = '$usuario', 
                    telefono = '$telefono', id_rol = '$id_rol', estado = '$estado'
                WHERE id_usuario = '$id_usuario'";
        return $this->cn->setEjecutionQuery($sql);
    }

    // ✅ Eliminar usuario
    public function eliminarUsuario($id_usuario) {
    $stmt = $this->cn->getConexion()->prepare("DELETE FROM tb_usuario WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    return $stmt->execute();
}

    public function existe_usuario($usuario)
{
    $sql = "SELECT id_usuario FROM tb_usuario WHERE usuario = '$usuario'";
    $resultado = $this->cn->getEjecutionQuery($sql);
    return $resultado && $resultado->num_rows > 0;
}


}

