<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Ahtziri | Registro</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<!--Funcionamiento de toastr -->
		<script>window.jQuery || document.write('<script src="assetsLogin/js/jquery-1.11.2.min.js"><\/script>')</script>
	        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" >
	        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
		</script>
	</head>
	<body>
	</body>
</html>
<?php

	include("conexion.php");

	$User = $_POST['U'];
	$Nombre = $_POST['N'];
	$Pass = $_POST['P'];
	$Email = $_POST['E'];

	/*encriptando password */
    $pass_encript = password_hash($Pass,PASSWORD_DEFAULT);
    
    $result = $conexion->prepare("INSERT INTO ADMINISTRADOR(User,Nombre,Pass,Email) VALUES(?,?,?,?)");

    /*manejo de error de registro*/
    if(!$result->execute(array($User,$Nombre,$pass_encript,$Email))){
        /*error */ 
		echo "<script>toastr.warning('Es posible que el usuario que intentas registrar ya este registrado', 'Advertencia!') </script>";
		echo "<img src=\"Imagenes/cargando.gif\" style=\"margin-left:35%; margin-top:10%;\"/>";
		header("Refresh: 4; url=Registro.php");

    } else {
		echo "<script>toastr.info('Registro Completado!', 'Exito!') </script>";
		echo "<img src=\"Imagenes/cargando.gif\" style=\"margin-left:35%; margin-top:10%;\"/>";
		//retornar al index despues del registro exitoso
		header("Refresh: 3; url=index.php");

	}

?>

