

<?php  
include 'funciones.php';

$error=false;
$config = include 'config.php';
try {
	$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
	$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
	$consultaSQL = "SELECT * FROM vendedor";

	$sentencia = $conexion->prepare($consultaSQL);
	$sentencia->execute();
	$vendedor = $sentencia->fetchAll();
} catch(PDOException $error){
	$error =$error->getMessage();
}
?>

<?php include 'header.php'; ?>
<div class="container">
 <div class="row">
  <div class="col-md-12">
  	<a href="crear.php" class="btn btn-primary mt-4">Crear Vendedor</a>
  	<hr>
  </div>
</div>
</div>

<div class="container">
 <div class="row">
  <div class="col-md-12">
   <h2 class="mt-3">Lista de Vendedor</h2>
   <table class="table">
   	<thead>
   	 <tr>
   	 	<th>#</th>
   	 	<th>Nombre</th>
   	 	<th>Cant.<br>COD</th>
   	 	<th>Cant.<br>Minecraft</th>
   	 	<th>Cant.<br>Fornite</th>
		<th>Total</th>
		<th>Comision<br>COD</th>
		<th>Comision<br>Minecraft</th>
		<th>Comision<br>Fornite</th>
		<th>Comision<br>Total</th>
		<th>Editar</th>
   	 </tr>
   	</thead>
   	<tbody>
   	<?php  
   	if($vendedor && $sentencia->rowCount()>0){
   		foreach($vendedor as $fila){
   	?>
   	<tr>
   		<td><?php echo escapar($fila["id"]); ?></td>
   		<td><?php echo escapar($fila["nombre"]); ?></td>
   		<td><?php echo escapar($fila["cant_cod"]); ?></td>
   		<td><?php echo escapar($fila["cant_mine"]); ?></td>
   		<td><?php echo escapar($fila["cant_for"]); ?></td>
		<td><?php echo($fila["cant_cod"]+$fila["cant_mine"]+$fila["cant_for"]); ?></td>
		<td><?php echo("6%"); ?></td>
		<td><?php echo("4%"); ?></td>
		<td><?php echo("9%"); ?></td>
		<td><?php echo($fila["cant_cod"]*(34500*0.06)+$fila["cant_mine"]*(8800*0.04)+$fila["cant_for"]*(58200*0.09)); ?></td>
   		<td><a href="<?= 'borrar.php?id='.escapar($fila["id"]) ?>">🗑️Borrar</a>
   		<a href="<?= 'editar.php?id='.escapar($fila["id"]) ?>">✏️Editar</a></td>
   	</tr>
   	<?php 
   		}
   	}
   	?>
   	</tbody>
	</table>
	</div>
	</div>
</div>

<?php include 'footer.php'; ?>