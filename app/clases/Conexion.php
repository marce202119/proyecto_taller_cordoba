<?php
class Conexion
{
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $password;
    private $conexion;
    function __construct()
    {
        $this->host = "localhost";
        $this->port = "5432";
        $this->dbname = "tallerfull";
        $this->user = "postgres";
        $this->password = "123";
    }
    function getConexion(){
        $this->conexion = pg_connect("host=$this->host port=$this->port dbname=$this->dbname user=$this->user password=$this->password");
        return $this->conexion;
    }

    function cerrar(){
        pg_close($this->conexion);
    }
}
?>