<?php
  ob_start();
  include("../conexion.php");
  //recibiendo datos con get
  $codCuest = $_GET['codCuest'];
  $nick = $_GET['nick'];

  ?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | ¡Terminaste!</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png"/>
  	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
  	<div class="wrapper">
    	<div class="main-header">
			<div class="logo-header">
				<a  class="logo">
					<?php echo $nick; ?>
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
						<button class="btn btn-success" data-toggle="modal" onclick="location.href='creacionDeCuestionarios/creacionDeCuestionario.php'">
							<i class="la la-hand-pointer-o"></i>
							<p>Crear Tu Cuestionaro</p>
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
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
    	        					<h2>¡Has terminado!</h2>
								</div>
							</div>
						</div>
					</div>
    	        	<?php

    	        		include("../conexion.php");
						$cor=1;
						$resultadoBuena = $conexion->prepare("SELECT COUNT(RESPUESTA_JUGADOR.Correcta) AS Buenas FROM RESPUESTA_JUGADOR
    	        			INNER JOIN JUGADOR ON RESPUESTA_JUGADOR.Jugador_Id = JUGADOR.idJugador
							WHERE RESPUESTA_JUGADOR.Correcta=? AND JUGADOR.NickName=? AND JUGADOR.CodigoCuestionario=?");
						if (!$resultadoBuena->execute(array($cor,$nick,$codCuest))) {
							#error en la consulta anterior
							echo"Algo ha ido mal en la consulta a la base de datos";
						}	
    	        		while ($columna = $resultadoBuena->fetch(PDO::FETCH_BOTH)) {
    	        			$buenas = $columna[0];
    	        		}
					
						$cor=0;
						$resultadoMala = $conexion->prepare("SELECT COUNT(RESPUESTA_JUGADOR.Correcta) AS Malas FROM RESPUESTA_JUGADOR
    	        			INNER JOIN JUGADOR ON RESPUESTA_JUGADOR.Jugador_Id = JUGADOR.idJugador
							WHERE RESPUESTA_JUGADOR.Correcta=? AND JUGADOR.NickName=? AND JUGADOR.CodigoCuestionario=?");
						if (!$resultadoMala->execute(array($cor,$nick,$codCuest))) {
							#error en la consulta anterior
							echo"Algo ha ido mal en la consulta a la base de datos";
						}	
    	        		while ($columna = $resultadoMala->fetch(PDO::FETCH_BOTH)) {
    	        			$malas = $columna[0];
    	        		}

    	        	?>

    	        	<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Estadisticas del usuario: <b><?php echo $nick; ?></b></h4>
								</div>
								<div class="card-body">
    	                			<script type="text/javascript">
    	              					var buena  = '<?php echo $buenas; ?>';
    	              					var mala  = '<?php echo $malas; ?>';
    	              					//document.write(buena);
    	              					window.onload = function () {
										
    	              					var chart = new CanvasJS.Chart("chartContainer", {
    	              						theme: "light2", // "light2", "dark1", "dark2"
    	              						animationEnabled: false, // change to true
    	              						//title:{
    	              							//text: "Tus resultados:"
    	              						//},
											
    	              						data: [
    	              						{
    	              							// Change type to "bar", "area", "spline", "pie",etc.
    	              							type: "pie",
    	              							dataPoints: [
    	              								{ label: "Correctas",  y: parseInt(buena,10) },
    	              								{ label: "Incorrectas", y: parseInt(mala,10)  },
												
    	              							]
    	              						}
    	              						]
    	              					});
    	              					chart.render();
									  
    	              					}
    	              				</script>

    	              				<div id="chartContainer" style="height: 370px; width: 100%;"></div>
    	              				<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>

    	              				<?php
										#obteniendo resultado de pregunta correcta
										$resultadoBuena = $conexion->prepare("SELECT count(idPregunta) as TotalPreguntas FROM CUESTIONARIO_REALIZADO E JOIN PREGUNTA D
											ON E.Cuestionario_Id = D.Cuestionario_Id_Pregunta WHERE CodigoGenerado=?");

										if (!$resultadoBuena->execute(array($codCuest))) {
											#error en la consulta anterior
											echo"Algo ha ido mal en la consulta a la base de datos";
										}
										while ($columnas = $resultadoBuena->fetch(PDO::FETCH_BOTH)) {
											$CountPreguntas = $columnas[0];
										}

										$correcta= 1;
										$result = $conexion->prepare("SELECT NIckName, count(NIckName) as RespuestasBuenas FROM JUGADOR E JOIN RESPUESTA_JUGADOR D
    	              						ON E.idJugador = D.Jugador_Id WHERE CodigoCuestRealizado=? and NIckName=? and Correcta=? group by NIckName order by count(NIckName) DESC");
										if (!$result->execute(array($codCuest,$nick,$correcta))) {
											#error en la consulta anterior
											echo"Algo ha ido mal en la consulta a la base de datos";
										} 
										while ($row = $result->fetch(PDO::FETCH_BOTH)) {
											$Porcentaje = round((($row[1])*100)/$CountPreguntas,2);
    	              					  	echo "
    	              					  	<div class=\"progress-card\">
    	              					  	  <div class=\"d-flex justify-content-between mb-1\">
    	              					  	    <span class=\"text-muted fw-bold\">$Porcentaje%</span>
    	              					  	  </div>
    	              					  	  <div class=\"progress mb-2\" style=\"height: 10px;\">
    	              					  	    <div class=\"progress-bar bg-";
    	              					  	    if ($Porcentaje > 0 and $Porcentaje <= 25) {
    	              					  	      echo "danger";
    	              					  	    } elseif ($Porcentaje > 25 and $Porcentaje <= 50) {
    	              					  	      echo "warning";
    	              					  	    } elseif ($Porcentaje > 50 and $Porcentaje <= 75) {
    	              					  	      echo "info";
    	              					  	    } elseif ($Porcentaje > 75 and $Porcentaje <= 100) {
    	              					  	      echo "success";
    	              					  	    }
    	              					  	    echo "\" role=\"progressbar\" style=\"width: $Porcentaje%\" aria-valuenow=\"$Porcentaje\" aria-valuemin=\"0\" aria-valuemax=\"100\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"$Porcentaje%\"></div>
    	              					  	  </div>
    	              					  	</div>
    	              					  	";
										}
    	              				?>

								</div>
    	            			<div class="card-footer">
    	              				<a href="../index.php">
    	                				<button type="submit" name="login" class="btn btn-default btn-lg">Finalizar</button>
    	              				</a>
    	              				<hr>
									<!-- Exportando resultados de partida -->
    	              				<form action="exportarCsvJugador.php" method="POST">
    	              				  <button  type="submit" name="login" class="btn btn-danger btn-lg">Descargar resultados</button>
    	              				</form>
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
					<p>El cuestionario ha terminado y únicamente podrás ver y/o descargar tus resultados. Si tienes algún incoveniente con tus respuestas puedes ponerte en contacto con el administrador que creo la sala.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Gracias</button>
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
