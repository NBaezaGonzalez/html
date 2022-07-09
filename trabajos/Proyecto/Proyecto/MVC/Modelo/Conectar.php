<?php 
class Conectar {

    public static function conexion(){
        try {
            $dsn = 'mysql:host=localhost;dbname=estudiante';
            $conexion= new PDO($dsn,'root','');
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
        } catch(Exception $error){
            die("Error ".$error->getMessage());
            echo "Linea de Error ".$error->getLine();
        }
        return $conexion;
    }

}

?>