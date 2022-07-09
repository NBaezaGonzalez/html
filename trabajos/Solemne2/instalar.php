<?php 
$config= include 'config.php';

try {
	$conexion = new PDO('mysql:host='.$config['db']['host'],$config['db']['user'],$config['db']['pass'],$config['db']['option']);
	$sql=file_get_contents('based.sql');
	$conexion->exec($sql);
	echo "La base de Datos Estudiante y la Tabla Alumnos se crearon con Éxito";
} catch(PDOException $error){
	echo $error->getMessage();
}
?>