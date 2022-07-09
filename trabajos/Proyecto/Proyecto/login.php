<?php 

if(!isset($_SESSION)) { 
	session_start(); 
  } 

	//include("connection.php");
	//include("functions.php");
	include('login/connection.php');
	include('login/functions.php');


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						//require_once('../MVC/index.php');
						header('Location: ../Proyecto/login/index.php');
						die;
					}
				}
			}
			
			echo "¡Nombre de usuario o contraseña incorrectos!";
		}else
		{
			echo "¡Nombre de usuario o contraseña incorrectos!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name" placeholder="Nombre"><br><br>
			<input id="text" type="password" name="password" placeholder="Contraseña"><br><br>

			<input id="button" type="submit" value="Login"><br><br>
			<a href="http://localhost/PHP/Proyecto/login/signup.php">Registrarse</a><br><br>
		</form>
	</div>
</body>
</html>