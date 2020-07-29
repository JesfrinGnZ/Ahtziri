<?php
	ob_start();
	include("conexion.php");
	session_start();
	$time_on=20;

	//recibiendo datos con get
	$codCuest = $_SESSION['codCuesJugado'];
	$nick = $_SESSION['nickname'];

	//recuperando cuestionario
	$cuest =  $conexion->prepare("SELECT * FROM CUESTIONARIO_REALIZADO WHERE CodigoGenerado = ? LIMIT 1");
	if (!$cuest->execute(array($codCuest))) {
		#error en la consulta anterior
		echo"Algo ha ido mal en la consulta a la base de datos";
	}

	$idCuest = 0;
	while ($fila = $cuest->fetch(PDO::FETCH_BOTH)) {
		$idCuest = $fila[Cuestionario_Id]; //guarda el id del cuestionario
	}

	$estado=0;
	$pregunta =  $conexion->prepare("SELECT P.idPregunta, P.Descripcion, P.Tiempo,P.Estado, C.idCuestionario
	FROM PREGUNTA P INNER JOIN CUESTIONARIO C ON P.Cuestionario_Id_Pregunta = C.idCuestionario WHERE C.idCuestionario = ? AND P.Estado=? LIMIT 1");

	//variables para la pregunta
	$idTemporalPreg = 0;
	$tiempoPreg = 0;
	$descripcionPreg = "";

	if (!$pregunta->execute(array($idCuest,$estado))) {
		#error en la consulta anterior
		echo"Algo ha ido mal en la consulta a la base de datos";
	}

	//validando que la consulta haya recuperado algo
	if ($pregunta->rowCount()>0) {
	  	while ($fila1 = $pregunta->fetch(PDO::FETCH_BOTH)) {
			$descripcionPreg = $fila1[Descripcion];
	    	$idTemporalPreg = $fila1[idPregunta]; //guarda el id de la pregunta a trabajar
	    	$tiempoPreg = $fila1[Tiempo]; //guarda el id de la pregunta a trabajar
		}


	} else {
	    //cuestionario finalizado porque ya no hay ninguna pregunta con estado no respondida
	    header("Location:Inicio/cuestionarioFinalizadoJugador.php?codCuest=$codCuest&nick=$nick");
	}

?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Lee</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<link rel="shortcut icon" type="image/x-icon" href="Imagenes/icon.png"/>
  	<link rel="stylesheet" href="Inicio/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="Inicio/assets/css/ready.css">
	<link rel="stylesheet" href="Inicio/assets/css/demo.css">
  	<script
  		src="https://code.jquery.com/jquery-3.4.1.js"
  		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  		crossorigin="anonymous">
	</script>
</head>
<body>
  	<div class="wrapper">
    	<div class="main-header">
			<div class="logo-header">
				<a  class="logo">
					Lee la pregunta
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
						<button class="btn btn-danger" data-toggle="modal" onclick="location.href='index.php'">
							<i class="la la-close"></i>
							<p>Salir</p>
						</button>
					</li>
    				<li class="nav-item update-pro">
						<button data-toggle="modal" data-target="#modalUpdate">
							<i class="la la-info-circle"></i>
							<p>¡Ayuda!</p>
						</button>
					</li>
				</ul>
			</div>
		</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
    	    			<div class="row">
    	      				<div class="col-md-3">
    	          				<img src="Imagenes/cargando3.gif" width="156" height="156" />
    	      				</div>
    	    			</div>
    	    			<div class="row">
  							<div class="col-md-6">
  								<div class="card">
  									<div align="center" class="card-header">
    	              					<img src="Imagenes/EsperaunMomento.png" style="width:100%; height:100%;">
  									</div>
  								</div>
  							</div>
  						</div>
    	    		<div class="row">
    	      			<div class="col-md-6">
  							<div class="card card-stats card-default">
  								<div class="card-body ">
  									<div class="row">
  										<div class="col-4">
  											<div class="icon-big text-center">
  												<i class="la la-book"></i>
  											</div>
  										</div>
  										<div class="col-7 d-flex align-items-center">
  											<div class="numbers">
  												<h4 class="card-title">Lee la pregunta en la pantalla del profesor</h4>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>
  						</div>
    	    		</div>
    	    		<div class="row text-center" >
						<div class="col-md-3">
							<div class="card card-stats card-warning">
								<div class="card-body ">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="la la-dashboard"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers" class="tex-center">
    	                  						<script type="text/javascript">
    	                  							(function () {
    	                  							    var timeLeft = <?php echo $time_on; ?>,
    	                  							    cinterval;
													
    	                  							    var timeDec = function (){
    	                  							        timeLeft--;
    	                  							        document.getElementById('countdown').innerHTML = timeLeft;
    	                  							        if(timeLeft === 0){
    	                  							            clearInterval(cinterval);
    	                  							        }
    	                  							    };
													  
    	                  							    cinterval = setInterval(timeDec, 1000);
    	                  							 })();
    	                						</script>
    	                						<div class="tex-center">
    	                  							<p class="card-category">
													  	<h1>
															<span id="countdown">
																<?php echo floor($time_on);
    	                    										//redirigirndo a una vista despues de el tiempo time_on
    	                    										header( "refresh:$time_on; url=Inicio/responderPregunta.php?idCuest=". base64_encode($idCuest) ."&codCuest=". base64_encode($codCuest) ."&nick=". base64_encode($nick) ."&idPreg=". base64_encode($idTemporalPreg) ."&tiempoPreg=". base64_encode($tiempoPreg) ."");
    	                    									?>
															</span>
														</h1>
														<h3>Segundos</h3>
													</p>
    	                						</div>
    	                						<h4 class="card-title">para continuar</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  	</div>
  	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-info-circle"></i> Ahtziri | Ayuda</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>En estos momentos debes leer la pregunta que está proyectando la ventana del administrador. ¡Prepárate porque luego debes responder la pregunta!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Gracias</button>
				</div>
			</div>
		</div>
	</div>


</body>
<script src="Inicio/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="Inicio/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="Inicio/assets/js/core/popper.min.js"></script>
<script src="Inicio/assets/js/core/bootstrap.min.js"></script>
<script src="Inicio/assets/js/plugin/chartist/chartist.min.js"></script>
<script src="Inicio/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="Inicio/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="Inicio/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="Inicio/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="Inicio/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="Inicio/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="Inicio/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="Inicio/assets/js/ready.min.js"></script>

</html>
<?php
ob_end_flush();
?>
