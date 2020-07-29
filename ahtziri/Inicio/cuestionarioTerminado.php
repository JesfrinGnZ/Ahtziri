<?php
	session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }

	include("../conexion.php");
	//recibiendo datos con get
	$nombreCuest=$_SESSION['nameCuest'];
	$numCuest = base64_decode($_GET['idCuest']);
	$clave = base64_decode($_GET['clave']);

	$resultadoBuena = $conexion->prepare("SELECT count(idPregunta) as TotalPreguntas FROM CUESTIONARIO E JOIN PREGUNTA D
	ON E.idCuestionario = D.Cuestionario_Id_Pregunta WHERE idCuestionario=?");
	if (!$resultadoBuena->execute(array($numCuest))) {
		#error en la consulta anterior
		echo"Algo ha ido mal en la consulta a la base de datos";
	}
	while ($columnas = $resultadoBuena->fetch(PDO::FETCH_BOTH)) {
		$CountPreguntas = $columnas[0];
	}


 ?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Fin</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png"/>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
						<button data-toggle="modal" onclick="location.href='index.php'" class="btn btn-success">
							<i class="la la-hand-pointer-o"></i>
							<p>Panel de Control</p>
						</button>
					</li>
					<li class="nav-item update-pro">
						<button data-toggle="modal" onclick="location.href='creacionDeCuestionarios/creacionDeCuestionario.php'" class="btn btn-info">
							<i class="la la-hand-pointer-o"></i>
							<p>Crear Cuestionaro</p>
						</button>
					</li>
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
                					<h2>¡Hemos terminado!</h2>
                					<?php
                  						echo "<h4 class=\"card-title\">El cuestionario: <b>$nombreCuest</b>  ha finalizado.</h4>";
                					?>
								</div>
							</div>
						</div>
					</div>
            		<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Estadisticas de los usuarios:</h4>
								</div>
								<div class="card-body">
                    				<?php

										$correcta=1;
										$result = $conexion->prepare("SELECT NIckName, count(NIckName) as RespuestasBuenas FROM JUGADOR E JOIN RESPUESTA_JUGADOR D
                    					ON E.idJugador = D.Jugador_Id WHERE CodigoCuestRealizado=? and Correcta=? group by NIckName order by count(NIckName) DESC");
										if (!$result->execute(array($clave,$correcta))) {
											#error en la consulta anterior
											echo"Algo ha ido mal en la consulta a la base de datos";
										}

                    					while ($row = $result->fetch(PDO::FETCH_BOTH)){
                    					  	$Porcentaje = round((($row[1])*100)/$CountPreguntas,2);
                    					  	echo "
                    					  	<div class=\"progress-card\">
  												<div class=\"d-flex justify-content-between mb-1\">
  													<span class=\"text-muted\">$row[0]</span>
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
                  					<a href="index.php">
                          				<button type="submit" name="login" class="btn btn-default btn-lg">Finalizar</button>
                        			</a>
                        			<?php
                        			  echo "<a href=\"exportarCsv.php?clave=". base64_encode($clave) ."\">
                        			          <button type=\"submit\" class=\"btn btn-danger btn-lg\">Descargar Resultados</button>
                        			        </a>";
                        			?>
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
					<h6 class="modal-title"><i class="la la-frown-o"></i> Ahtziri | Software Libre</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
						<b>Recuerda que ¡La educación debe ser para todos!</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
