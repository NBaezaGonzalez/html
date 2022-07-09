<?php  
include 'funciones.php';

$error=false;
$config = include 'config.php';
try {
	$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
	$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
	$consultaSQL = "SELECT * FROM estudiante";

	$sentencia = $conexion->prepare($consultaSQL);
	$sentencia->execute();
	$estudiantes = $sentencia->fetchAll();
} catch(PDOException $error){
	$error =$error->getMessage();
}
?>

<?php include 'templates/header.php'; ?>
<div class="container">
 <div class="row">
  <div class="col-md-12">
  	<a href="crear.php" class="ingresar">Ingresar</a>
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
   	 	<th>#</th>
   	 	<th>Nombre</th>
   	 	<th>Rut</th>
		<th>Edad</th>
   	 	<th>Direccion</th>
   	 	<th>Acciones</th>
   	</thead>
   	<tbody>
   		<?php  
   		if ($estudiantes && $sentencia->rowCount()>0){
   			foreach($estudiantes as $fila){
   			?>
   		 <tr>
   		 	<td><?php echo escapar($fila["id"]); ?></td>
   		 	<td><?php echo escapar($fila["nombre"]); ?></td>
   		 	<td><?php echo escapar($fila["rut"]); ?></td>
   		 	<td><?php echo escapar($fila["edad"]); ?></td>
   		 	<td><?php echo escapar($fila["direccion"]); ?></td>
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

<?php include 'templates/footer.php'; ?>