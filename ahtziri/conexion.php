
<?php

	/* Conexion a Base de Datos para consultas*/
	/* Credenciales */
	$Server = "localhost";
	$User = "root";
	$Password = "3211";
	$Schema = "Cuestionarios";


	/*
		Conexion a partir del Objeto PDO de php
	*/

	try {
		$dsn = "mysql:host=$Server;dbname=$Schema";
		$conexion = new PDO($dsn, $User, $Password);
		$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	} catch (PDOException $e){
		//echo $e->getMessage();
		echo "<script>alert('No se Completo la solicitud por fallos en el servidor...'); </script>".
		"<img src=\"Imagenes/cargando.gif\" style=\"margin-left:35%; margin-top:10%;\"/>";
		//retornar al index
		header("Refresh: 2; url=index.php");
	}


?>
