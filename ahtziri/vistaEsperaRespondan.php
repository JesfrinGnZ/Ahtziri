<?php

$tiempoTermin = $_GET['tiempoTermin'];
$numPreg = $_GET['numPreg'];
$resp = $_GET['resp'];

echo "Termino en: $tiempoTermin";
echo "Num Preg: $numPreg";
echo "respuesta:".$resp["Descripcion"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styleInicio.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"/>
	<title>Ahtziri | Responde</title>
</head>
<body>
	<div class="container">
    	<h2>ESPERA...</h2>
	</div>
	
	<script src="js/jquery.js"> </script>
	<script src="js/bootstrap.min.js"> </script>

</body>
</html>
