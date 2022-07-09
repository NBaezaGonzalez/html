<?php  
include 'funciones.php';

$config = include 'config.php';
$resultado = [
	'error'=>false,
	'mensaje'=>''
];

if (!isset($_GET['id'])){
	$resultado['error'] =true;
	$resultado['mensaje'] ='El vendedor no existe';
}

if (isset($_POST['submit'])){
	try {
		$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
		$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
		$vendedors = [
			"id" => $_GET['id'],
			"nombre" => $_POST['nombre'],
			"cant_cod" => $_POST['cant_cod'],
			"cant_mine" => $_POST['cant_mine'],
			"cant_for" => $_POST['cant_for'],
		];
		$consultaSQL = "UPDATE vendedor SET 
			nombre = :nombre,
			cant_cod = :cant_cod,
			cant_mine = :cant_mine,
			cant_for = :cant_for,
			updated_at = NOW()
			WHERE id = :id";
		$sentencia = $conexion->prepare($consultaSQL);
		$sentencia->execute($vendedors);
	} catch(PDOException $error){
		$resultado['error']=true;
		$resultado['mensaje']=$error->getMessage();
	}
}

try {
	$dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
	$conexion = new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
	$id = $_GET['id'];
	$consultaSQL = "SELECT * FROM vendedor WHERE id=".$id;
	$sentencia = $conexion->prepare($consultaSQL);
	$sentencia->execute();
	$vendedors =$sentencia->fetch(PDO::FETCH_ASSOC);
	if(!$vendedors){
		$resultado['error'] =true;
		$resultado['mensaje'] ='El vendedor no se ha encontrado';
	}
}catch(PDOException $error){
		$resultado['error']=true;
		$resultado['mensaje']=$error->getMessage();
	}
?>

<?php require "header.php"; ?>
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
if (isset($vendedors) && $vendedors) {
  ?>
    <div class="container">
     <div class="row">
      <div class="col-md-12">
	  <h2 class="mt-4">Editando el vendedor <?= escapar($vendedors['nombre'])  ?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($vendedors['nombre']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="apellido">Cantidad ventas Call of Duty</label>
            <input type="text" name="cant_cod" id="cant_cod" value="<?= escapar($vendedors['cant_cod']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Cantidad ventas Minecraft</label>
            <input type="text" name="cant_mine" id="cant_mine" value="<?= escapar($vendedors['cant_mine']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="edad">Cantidad ventas Fornite</label>
            <input type="text" name="cant_for" id="cant_for" value="<?= escapar($vendedors['cant_for']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar" class="form-control">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
      </form>
  </div>
</div>
</div>
<?php
}
?>
<?php require "footer.php"; ?>