<?php  
include ('funciones.php');
$alumnos ="";
$error=false;
$config = include ('config.php');
try {
	$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
	$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
	$consultaSQL = "SELECT * FROM alumnos";

	$sentencia = $conexion->prepare($consultaSQL);
	$sentencia->execute();
	$alumnos = $sentencia->fetchAll();
} catch(PDOException $error){
	$error =$error->getMessage();
}
?>

<?php include('header.php'); ?>
<div class="container">
 <div class="row">
  <div class="col-md-12">
  	<a href="http://localhost/PHP/Proyecto/crud/crear.php" class="btn btn-primary mt-4">Crear Alumno</a>
  	<a href="http://localhost/PHP/Proyecto/login/index.php" class="btn btn-primary mt-4">Volver Atras</a>
	<hr>
  </div>
</div>
</div>

<div class="container">
 <div class="row">
  <div class="col-md-12">
   <h2 class="mt-3">Lista de Alumnos</h2>
   <table class="table">
   	<thead>
   	 <tr>
   	 	<th>#</th>
   	 	<th>Nombre</th>
   	 	<th>Apellido</th>
   	 	<th>Email</th>
   	 	<th>Edad</th>
   	 	<th>Acciones</th>
   	 </tr>
   	</thead>
   	<tbody>
   		<?php  
   		if ($alumnos && $sentencia->rowCount()>0){
   			foreach($alumnos as $fila){
   			?>
   		 <tr>
   		 	<td><?php echo escapar($fila["id"]); ?></td>
   		 	<td><?php echo escapar($fila["nombre"]); ?></td>
   		 	<td><?php echo escapar($fila["apellido"]); ?></td>
   		 	<td><?php echo escapar($fila["email"]); ?></td>
   		 	<td><?php echo escapar($fila["edad"]); ?></td>
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

<?php include ('footer.php'); ?>