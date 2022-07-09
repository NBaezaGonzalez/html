<?php 
session_start();

	//include("connection.php");
	//include("functions.php");
	include ('connection.php');
	include ('functions.php');

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Proyecto</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
        <div class="container">
            <p class="logo">Bienvenido, <?php echo $user_data['user_name']; ?></p>
            <nav>
                <a href="http://localhost/PHP/Proyecto/MVC/index.php">MVC</a>
				&nbsp
                <a href="http://localhost/PHP/Proyecto/crud/index.php">CRUD</a>
				&nbsp
				<a href="http://localhost/PHP/Proyecto/login.php">Cerrar Sesión</a>
				<hr>
            </nav>
        </div>
    </header>
</body>
</html>