<?php
  	ob_start();
  	//si no esta logueado mandarlo al index principal
  	session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }
	include("../conexion.php");
	//recibiendo datos con get

  	$nombreCuest=$_SESSION['nameCuest'];

	$numCuest = base64_decode($_GET['idCuest']);
	$numPreg = base64_decode($_GET['idPregunta']);
	$clave = base64_decode($_GET['clave']);
	
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
  	//asignando tiempo de vista de la pregunta
	$time_on = base64_decode($_GET['tiempoPreg']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Respuestas</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png"/>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
	<div class="wrapper">
    	<div class="main-header">
			<div class="logo-header">
				<a  class="logo">
					Administrator
				</a>
        		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</div>
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">
				<ul class="nav">
					 <li class="nav-item update-pro">
						<button data-toggle="modal" data-target="#modalUpdate">
							<i class="la la-info-circle"></i>
							<p>Más información</p>
						</button>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
                					<?php
                					  echo "<h4 class=\"card-title\">Cuestionario: $nombreCuest </h4>";
                					?>
								</div>
							</div>
						</div>
					</div>
            		<div class="row">
						<div class="col-md-12">
                  			<div class="col-md-6">
    							<div class="card">
    								<div class="card-header">
    									<div class="card-title"><h4><b><?php echo "".$r1["Descripcion"]; ?></b></h4></div>
    								</div>
    								<div class="card-body">
    									<img src="img/Cuadrado.jpg"><FONT FACE="impact" SIZE=6 COLOR="black">
    								</div>
    							</div>
                    			<div class="card">
    								<div class="card-header">
    									<div class="card-title"><h4><b><?php echo "".$r3["Descripcion"]; ?></b></h4></div>
    								</div>
    								<div class="card-body">
    									<img src="img/Triangulo.jpg"><FONT FACE="impact" SIZE=6 COLOR="black">
    								</div>
    							</div>
    						</div>
                  			<div class="col-md-6">
    							<div class="card">
    								<div class="card-header">
    									<div class="card-title"><h4><b><?php echo "".$r2["Descripcion"]; ?></b></h4></div>
    								</div>
    								<div class="card-body">
    									<img src="img/Circulo.jpg"><FONT FACE="impact" SIZE=6 COLOR="black">
    								</div>
    							</div>
                    			<div class="card">
    								<div class="card-header">
    									<div class="card-title"><h4><b><?php echo "".$r4["Descripcion"]; ?></b></h4></div>
    								</div>
    								<div class="card-body">
    									<img src="img/Rombo.jpg"><FONT FACE="impact" SIZE=6 COLOR="black">
    								</div>
    							</div>
    						</div>
						</div>
					</div>
           			<div class="row text-center" >
						<div class="col-md-4">
							<div class="card card-stats card-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="la la-dashboard"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
                	          					<script type="text/javascript">
                	          						(function () {
                	          						    var timeLeft = <?php echo $time_on; ?>,
                	          						    cinterval;
													
                	          						    var timeDec = function (){
                	          						        timeLeft--;
                	          						        document.getElementById('countdown1').innerHTML = timeLeft;
                	          						        if(timeLeft === 0){
                	          						            clearInterval(cinterval);
                	          						        }
                	          						    };
													  
                	          						    cinterval = setInterval(timeDec, 1000);
                	          						 })();
												   
                	        					</script>
                	        					<div class="text-center">
                	        					  <h3>
                	        					    <span id="countdown1"><?php echo floor($time_on);
                	        					    //redirigirndo a una vista despues de el tiempo time_on
                	        					    header( "refresh:$time_on; url=pasarSiguientePregunta.php?idCuest=". base64_encode($numCuest) ."&clave=". base64_encode($clave) ."&numPreg=". base64_encode($numPreg) ."");
                	        					    ?>
                	        					  </span> Segundos para responder
                	        					  </h3>
                	        					</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
              			<div class="col-md-3">
              			    <img src="../Imagenes/cargando2.gif" width="156" height="156" />
              			</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>

</html>
<?php
ob_end_flush();
?>
