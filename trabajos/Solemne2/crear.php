<?php 
if (isset($_POST['submit'])){
	$resultado =[
		'error' =>false,
		'mensaje'=>'El alumno '.$_POST['nombre'].' ha sido creado con éxito'
	];
	$config = include 'config.php';
	try {
		$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
		$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
		$estudiantes = [
			"nombre" => $_POST['nombre'],
			"rut" => $_POST['rut'],
			"edad" => $_POST['edad'],
			"direccion" => $_POST['direccion'],
			
		];
		$consultaSQL = "INSERT INTO estudiante (nombre,rut,edad,direccion)";
		$consultaSQL .= "values (:".implode(", :", array_keys($estudiantes)).")";
		$sentencia = $conexion->prepare($consultaSQL);
		$sentencia->execute($estudiantes);
	} catch(PDOException $error){
		$resultado['error']=true;
		$resultado['mensaje']=$error->getMessage();
	}
}
?>

<?php include "templates/header.php"; ?>
<?php  
if (isset($resultado)){
	?>
	<div class="container">
 	 <div class="row">
  	  <div class="col-md-12">
  	   <div class="alert alert-<?= $resultado['error'] ? ' danger' : 'success' ?> " role="alert">
  	   		<?= $resultado['mensaje'] ?>
  	   	</div>
  	   </div>
  	</div>
  </div>
  <?php
}
?>

<div class="container">
 <div class="row">
  <div class="col-md-12">
  	<h2 class="mt-4">Crear Estudiante</h2>
  	<hr>
  	<form method="post">
  	 <div class="form-group">
  	  <label for="nombre">Nombre</label>
  	  <input type="text" name="nombre" id="nombre" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <label for="rut">Rut</label>
  	  <input type="number" name="rut" id="rut" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <label for="edad">Edad</label>
  	  <input type="number" name="edad" id="edad" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <label for="direccion">Direccion</label>
  	  <input type="text" name="direccion" id="direccion" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
  	  <a class="btn btn-primary" href="index.php">Regresar al Inicio</a>
  	 </div>
  	</form>
  </div>
</div>
</div>
<?php include "templates/footer.php"; ?>