<?php
  	//si no esta logueado mandarlo al index principal
  	session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }
	include("../conexion.php");
	//recibiendo datos con get

	$numCuest = $_GET['idCuest'];
	$numPreg = $_GET['idPregunta'];
	
	$resultado =  $conexion->prepare("SELECT R.idRespuesta, R.Descripcion,R.No_Respuesta, R.Pregunta_Id,R.esCorrecta, P.idPregunta, P.Cuestionario_Id_Pregunta
			FROM RESPUESTA R INNER JOIN PREGUNTA P ON R.Pregunta_Id = P.idPregunta WHERE P.idPregunta = ?");
	if (!$resultado->execute(array($numPreg))) {
		#error en la consulta anterior
		echo"Algo ha ido mal en la consulta a la base de datos";
	}

	$r1 = "si";
	$r2 = "si";
	$r3 = "si";
	$r4 = "si";

	while ($fila = $resultado->fetch(PDO::FETCH_BOTH)) {
		if ($r1 == "si") {
					$r1 = $fila;
		} else if ($r2 == "si") {
					$r2 = $fila;
		} else  if ($r3 === "si") {
					$r3 = $fila;
		} else  if ($r4 == "si") {
					$r4 = $fila;
		}

	}

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
	<title> Ahtziri | Inicio </title>
</head>
<body background="img/fondo 1.png">
	<!--Menu de navegacion navbar---->
	<div class="">
		<header>
			<nav class="navbar navbar-default navbar-static-top navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
							<span class="sr-only"> Menu </span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="index.php" class="navbar-brand"> <h4>Inicio | Athziri</h4> </a>
					</div>
					<div class="collapse navbar-collapse" id="navbar-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="salir.php"><h5>Cerrar Sesion</h5></a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
	</div>
	<!--Botones para las maras-->
	<div class="container">
		<div class="camaras">
			<div class="row">
				<div class="camara" >
					<div class="col-xs-12 col-sm-6 col-lg-6" >
						<a href="../esperandoRespuestas.php" class="btn btn-lg btn-block btn-primary"> <span class="glyphicon glyphicon-camera" ></span> &nbsp; &nbsp; <?php echo "".$r1["Descripcion"];  ?></a> <br>
					</div>
				</div>
				<div class="camara">
					<div class="col-xs-12 col-sm-6 col-lg-6">
						<a href="../esperandoRespuestas.php" class="btn btn-lg btn-block btn-success"> <span class="glyphicon glyphicon-camera" ></span> &nbsp; &nbsp; <?php echo "".$r2["Descripcion"]; ?></a> <br>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="camara">
					<div class="col-xs-12 col-sm-6 col-lg-6">
						<a href="../esperandoRespuestas.php" class="btn btn-lg btn-block btn-danger"> <span class="glyphicon glyphicon-camera" ></span> &nbsp; &nbsp;  <?php echo "".$r3["Descripcion"]; ?></a> <br>
					</div>
				</div>
				<div class="camara">
					<div class="col-xs-12 col-sm-6 col-lg-6">
						<a href="../esperandoRespuestas.php" class="btn btn-lg btn-block btn-default"> <span class="glyphicon glyphicon-camera"></span> &nbsp; &nbsp; <?php echo "".$r4["Descripcion"]; ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
			<center> <h5> Copyright &copy;</h5> </center>
		</div>
	</footer>
	<script src="js/jquery.js"> </script>
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>
