<?php
class Conexion {
    // Atributos
    private $servidor;
    private $user;
    private $clave;
    private $database;
    private $conexion;

    // Constructor
    public function __construct() {
        $this->servidor = "localhost";
        $this->user = "root";
        $this->clave = "";
        $this->database = "crm2";
    }

    // Destructor
    public function __destruct() {
        if ($this->conexion) {
            $this->cerrarConexion();
        }
    }

    // Función para conectar con validación de errores
    public function conectar() {
        $this->conexion = new mysqli($this->servidor, $this->user, $this->clave, $this->database);

        // Validación de conexión
        if ($this->conexion->connect_error) {
            die("❌ Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // Función para cerrar la conexión
    public function cerrarConexion() {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }

    // Devuelve un resultado de consulta SELECT
    public function getEjecutionQuery($sql) {
        return $this->conexion->query($sql);
    }

    // Ejecuta una sentencia INSERT, UPDATE o DELETE
    public function setEjecutionQuery($sql) {
        return $this->conexion->query($sql);
    }

    // Getter para obtener la conexión
    public function getConexion() {
        return $this->conexion;
    }

    // Getters y Setters
    public function getServidor() {
        return $this->servidor;
    }

    public function getUser() {
        return $this->user;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function setServidor($servidor) {
        $this->servidor = $servidor;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }
}
