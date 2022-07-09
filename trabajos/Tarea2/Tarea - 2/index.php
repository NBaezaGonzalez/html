<html>
  <head>
  	<meta charset="utf-8">
    <title>Formulario</title>
    <link rel="stylesheet" href="estilos.css">
  </head>
<body>
		<header>
        <div class="container">
            <p class="logo">Planeta Gamer</p>
            <nav>
                <a href="#catalogo">Catalogo</a>
                <a href="#RUT">Vendedores</a>
            </nav>
        </div>
    </header>
    <section id="catalogo">
        <div class="container">
            <h2>Catalogo De Juegos</h2>
            <div class="juegos">
                <div class="carta">
                    <h3>Call&nbsp;Of&nbsp;Duty</h3>
                    <p>Precio: $34500</p>
                </div>
                <div class="carta">
                    <h3>Minecraft</h3>
                    <p>Precio: $8800</p>
                </div>
                <div class="carta">
                    <h3>&nbsp;Fornite&nbsp;</h3>
                    <p>Precio: $58200</p>
                </div>
            </div>        
        </div>
    </section>
  	<?php 
		session_start();
		if (!isset($_SESSION['persona'])){
			$_SESSION['persona']= array();
		}
		if (isset($_POST['insertar'])){
			//Datos Personales
			$rut = $_POST['RUT'];
			$nom = $_POST['NOM'];
			//Ventas
			//$ape = $_POST['APE'];
			$venta_cod = $_POST['V_COD'];//Call of duty
			$venta_mc = $_POST['V_MC'];//Minecraft
			$venta_for = $_POST['V_FOR'];//Fornite



			//validacion en caso de que no se ingrese ningun dato
			if (empty($rut)||empty($nom)){
				echo "Rellena todos los valores";
			//validacion en caso que el usuario ingresara letras no se podra registrar
			}else if (preg_match("/[a-z]/",$rut)){
				echo "No se acepta LETRAS en el Rut(si es -k colocar 1)";
			//validacion en caso que el usuario ingresara numeros no se podra registrar
			} else if (preg_match("/[0-9]/",$nom)){
				echo "Solo se aceptan LETRAS en el NOMBRE";
			//validacion para que el usuario ingrese numeros enteros.
			}else if (!ctype_digit($venta_cod) || !ctype_digit($venta_mc) || !ctype_digit($venta_for)){
				echo "Solo numeros enteros";
			
			}else {
				//Se hace una conversion
				$v_total = $venta_cod+$venta_mc+$venta_for;
				//Calculos
				$c_cod = 0.06;
				$c_mc = 0.04;
				$c_for = 0.09;
				$c_total = (34500*$c_cod)*$venta_mc+(8800*$c_mc)*$venta_cod+(58200*$c_for)*$venta_for;

				//Se agregan el vendedor.
				$persona = array(
					"rut" => $rut,
					"Nombre" => $nom,
					//"Apellido" => $ape,
					"Venta_cod" => $venta_cod,
					"Venta_mc" => $venta_mc,
					"Venta_for" => $venta_for,
					"Venta_total" => $v_total,
					"C_cod" => $c_cod,
					"C_mc" => $c_mc,
					"C_for" => $c_for,
					"C_total" => $c_total,
				);
				//se modifica los datos atraves del rut
				if (isset($_SESSION['persona'][$rut])){
					echo "Se ha modificado la Persona con el RUT: ".$rut;
				}else{//se registra en caso del que rut sea diferente
					echo "Se ha registrado la persona";
				}
				$_SESSION['persona'][$rut]=$persona;
				print_r($_SESSION['persona']);	
			}
		//funcion para vaciar la tabla
		}else if (isset($_POST['vaciar'])){
			if (!isset($_POST['ruts'])){
				echo "No hay Personas seleccionadas";

			}else{	
				$ruts=$_POST['ruts'];
				print_r($ruts);

				foreach ($_SESSION['persona'] as $key =>$value){
					if (in_array($key,$ruts)){
						unset($_SESSION['persona'][$key]);
					}
				}
			echo "Persona(s) Borradas";
			}
		}

	?>
	<!--Formulario para el registro de vendedores-->
	<form method="post" align="Center">
		<label for="RUT">RUT :</label><br>
		<input type="number" id="RUT" name="RUT" />
		<br>
		<label for="NOM">NOMBRE :</label><br>
		<input type="text" id="NOM" name="NOM" />
		<br>
		<label for="V_COD">VENTAS COD : </label><br>
		<input type="number" id="V_COD" name="V_COD" />
		<br>
		<label for="V_MC">VENTAS MINECRAFT : </label><br>
		<input type="number" id="V_MC" name="V_MC" />
		<br>
		<label for="V_FOR">VENTAS FORNITE : </label><br>
		<input type="number" id="V_FOR" name="V_FOR" /><br>
		<br>
		<button type="submit" name="insertar">Insertar</button>
		<button type="submit" name="mostrar">Mostrar</button>
		<button type="submit" name="vaciar">Vaciar</button>
		<button type="submit" name="vendedores">Vendedores</button>
		<br>


	<?php
		//Mostrar los vendedores
		if (isset($_POST['mostrar'])){
			//foreach ($personas as $key => $row) {
    		//$aux[$key] = $row['Venta_total'];
			//intento de ordenar las ventas totales
			if (count($_SESSION['persona'])===0){
				echo "<p> No hay Personas registradas </p>";
			}else {
				echo "<table border=2 >";
				echo "<tr>";
				echo "<th></th>";
				echo "<th>Rut</th>";
				echo "<th>Nombre<br>Vendedor</th>";//Nombre de las columnas(tablas)
				echo "<th>Cantidad<br>Ventas COD</th>";
				echo "<th>Cantidad<br>Ventas MC</th>";
				echo "<th>Cantidad<br>Ventas FOR</th>";
				echo "<th>Total<br>Ventas</th>";
				echo "<th>Comision<br>Call Of Duty</th>";
				echo "<th>Comision<br>Minecraft</th>";
				echo "<th>Comision<br>Fornite</th>";
				echo "<th>Comision<br>Total</th>";
				echo "<tr>";

				foreach ($_SESSION['persona'] as $key => $value){
					
					?>
					<tr>
						<td><input type="checkbox" name="ruts[]" value="<?php echo $key; ?>"> </td>
						<td><?php echo $value['rut']; ?></td>
						<td><?php echo $value['Nombre']; ?></td>
						<td><?php echo $value['Venta_cod']; ?></td>
						<td><?php echo $value['Venta_mc']; ?></td>
						<td><?php echo $value['Venta_for']; ?></td>
						<td><?php echo $value['Venta_total']; ?></td>
						<td><?php echo $value['C_cod']; ?></td>
						<td><?php echo $value['C_mc']; ?></td>
						<td><?php echo $value['C_for']; ?></td>
						<td><?php echo $value['C_total']; ?></td>
					</tr>
					<?php 
				}
				echo "</table>";
			} 
		}

	?>
	</form>
</body>
</html>