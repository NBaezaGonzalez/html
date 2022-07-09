<?php  
include 'funciones.php';

$config = include 'config.php';
$resultado = [
	'error'=>false,
	'mensaje'=>''
];

if (!isset($_GET['id'])){
	$resultado['error'] =true;
	$resultado['mensaje'] ='El alumno no existe';
}

if (isset($_POST['submit'])){
	try {
		$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
		$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
		$estudiantes= [
			"id" => $_GET['id'],
			"nombre" => $_POST['nombre'],
			"rut" => $_POST['rut'],
			"edad" => $_POST['edad'],
			"direccion" => $_POST['direccion'],
			
		];
		$consultaSQL = "UPDATE estudiante SET 
			nombre = :nombre,
			rut = :rut,
			edad = :edad,
			direccion = :direccion,
			updated_at = NOW()
			WHERE id = :id";
		$sentencia = $conexion->prepare($consultaSQL);
		$sentencia->execute($estudiantes);
	} catch(PDOException $error){
		$resultado['error']=true;
		$resultado['mensaje']=$error->getMessage();
	}
}

try {
	$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
	$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
	$id = $_GET['id'];
	$consultaSQL = "SELECT * FROM estudiante WHERE id=".$id;
	$sentencia = $conexion->prepare($consultaSQL);
	$sentencia->execute();
	$estudiantes =$sentencia->fetch(PDO::FETCH_ASSOC);
	if(!$estudiantes){
		$resultado['error'] =true;
		$resultado['mensaje'] ='El alumno no se ha encontrado';
	}
}catch(PDOException $error){
		$resultado['error']=true;
		$resultado['mensaje']=$error->getMessage();
	}
?>

<?php require "templates/header.php"; ?>
<?php
if ($resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($estudiantes) && $estudiantes) {
  ?>
    <div class="container">
     <div class="row">
      <div class="col-md-12">
      	<h2 class="mt-4">Editando el alumno <?= escapar($estudiantes['nombre']) . ' ' . escapar($estudiantes['rut'])  ?></h2>
        <hr>
		<br>
        <form method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($estudiantes['nombre']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="rut">Rut</label>
            <input type="number" name="rut" id="rut" value="<?= escapar($estudiantes['rut']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" name="edad" id="edad" value="<?= escapar($estudiantes['edad']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" id="direccion" value="<?= escapar($estudiantes['direccion']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar" class="form-control" >
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
      </form>
  </div>
</div>
</div>
<?php
}
?>
<?php require "templates/footer.php"; ?>