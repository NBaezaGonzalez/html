<?php
    class Productos_modelo {
        private $db;
        private $productos;
        public function __construct(){
            require_once("Modelo/Conectar.php");
            //require ('../MVC/Modelo/Conectar.php');
            $this->db=Conectar::conexion();
            $this->productos=array();
        }
        public function get_productos(){
            $consulta=$this->db->query("SELECT * FROM ALUMNOS");
            while ($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->productos[]=$filas;
            }
            return $this->productos;
        }

    }

?>