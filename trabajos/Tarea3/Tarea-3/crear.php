<?php 
if (isset($_POST['submit'])){
	$resultado =[
		'error' =>false,
		'mensaje'=>'El vendedor '.$_POST['nombre'].' ha sido creado con éxito'
	];
	$config = include 'config.php';
	try {
		$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
		$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
		$vendedors = [
			"nombre" => $_POST['nombre'],
			"cant_cod" => $_POST['cant_cod'],
			"cant_mine" => $_POST['cant_mine'],
			"cant_for" => $_POST['cant_for'],
		];
		$consultaSQL = "INSERT INTO vendedor (nombre,cant_cod,cant_mine,cant_for)";
		$consultaSQL .= "values (:".implode(", :", array_keys($vendedors)).")";
		
		$sentencia = $conexion->prepare($consultaSQL);
		$sentencia->execute($vendedors);

	} catch(PDOException $error){
		$resultado['error']=true;
		$resultado['mensaje']=$error->getMessage();
	}
}
?>
<?php include "header.php"; ?>
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
  	<h2 class="mt-4">Crear Vendedor</h2>
  	<hr>
  	<form method="post">
  	 <div class="form-group">
  	  <label for="nombre">Nombre Vendedor</label>
  	  <input type="text" name="nombre" id="nombre" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <label for="apellido">Cantidad ventas Call of Duty</label>
  	  <input type="number" name="cant_cod" id="cant_cod" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <label for="email">Cantidad ventas Minecraft</label>
  	  <input type="number" name="cant_mine" id="cant_mine" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <label for="edad">Cantidad ventas Fornite</label>
  	  <input type="number" name="cant_for" id="cant_for" class="form-control">
  	 </div>
  	 <div class="form-group">
  	  <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
  	  <a class="btn btn-primary" href="index.php">Regresar al Inicio</a>
  	 </div>
  	</form>
  </div>
</div>
</div>
<?php include "footer.php"; ?>