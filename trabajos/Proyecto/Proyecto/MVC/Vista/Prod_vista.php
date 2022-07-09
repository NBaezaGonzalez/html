<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Page Title</title>
    
</head>
<body>

<!--a class="btn btn-primary" href="http://localhost/PHP/simple_login_source_code/login.php">Regresar Login</a--><br><br>
<!--a class="btn btn-primary" href="http://localhost/PHP/simple_login_source_code/login/index.php">Volver atras</a-->
<div class="container">
 <div class="row">
  <div class="col-md-12">
  	<a href="http://localhost/PHP/Proyecto/login.php" class="btn btn-primary mt-4">Regresar Login</a>
  	<a href="http://localhost/PHP/Proyecto/login/index.php" class="btn btn-primary mt-4">Volver Atras</a>
	<hr>
  </div>
</div>
</div>
<div class="container">
 <div class="row">
  <div class="col-md-12">
   <h2 class="mt-2">LISTA TOTAL</h2>
   <table class="table">
   	<thead>
   	 <tr>
   	 	<th>Nombre</th>
   	 	<th>Email</th>
   	 	<th>Edad</th>
   	 </tr>
   	</thead>
    <tbody>
   		<?php  
   		foreach($matrizProductos as $registro){
   		?>
   		 <tr>
            <td><?php echo ($registro["nombre"]); ?></td>
            <td><?php echo ($registro["email"]); ?></td>
            <td><?php echo ($registro["edad"]); ?></td>
   		 </tr>
   		 <?php 
   		}
   		?>
   	</tbody>
	</table>
	</div>
	</div>
</div>  
</body>
</html>