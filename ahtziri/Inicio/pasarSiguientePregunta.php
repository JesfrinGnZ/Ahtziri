<?php
session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }

include("../conexion.php");
//recibiendo datos con get
$nombreCuest=$_SESSION['nameCuest'];
$numCuest = base64_decode($_GET['idCuest']);
$clave = base64_decode($_GET['clave']);
$numPreg = base64_decode($_GET['numPreg']);

//en este caso los clientes deben verificar si esta en 0 para empezar a correr tiempo

$activo=1;
$guardar = $conexion->prepare("UPDATE CUESTIONARIO SET Activo=? WHERE idCuestionario=?");
if (!$guardar->execute(array($activo,$numCuest))) {
	#error en la consulta anterior
	echo"Algo ha ido mal en la consulta a la base de datos";
}

$correcta=1;
$resultadoBuena = $conexion->prepare("SELECT COUNT(RESPUESTA_JUGADOR.Correcta) AS Buenas FROM RESPUESTA_JUGADOR
WHERE RESPUESTA_JUGADOR.PREGUNTA_idPregunta=? AND RESPUESTA_JUGADOR.CodigoCuestRealizado=?
AND RESPUESTA_JUGADOR.Correcta=?");
if (!$resultadoBuena->execute(array($numPreg,$clave,$correcta))) {
	#error en la consulta anterior
	echo"Algo ha ido mal en la consulta a la base de datos";
}

while ($columnas = $resultadoBuena->fetch(PDO::FETCH_BOTH)) {
	$buenas = $columnas[Buenas];
	
	$correcta=0;
	$resultadoMala = $conexion->prepare("SELECT COUNT(RESPUESTA_JUGADOR.Correcta) AS Malas FROM RESPUESTA_JUGADOR
		WHERE RESPUESTA_JUGADOR.PREGUNTA_idPregunta=? AND RESPUESTA_JUGADOR.CodigoCuestRealizado=?
		AND RESPUESTA_JUGADOR.Correcta=?");
	if (!$resultadoMala->execute(array($numPreg,$clave,$correcta))) {
		#error en la consulta anterior
		echo"Algo ha ido mal en la consulta a la base de datos";
	}
    while ($columna = $resultadoMala->fetch(PDO::FETCH_BOTH)) {
    	$malas = $columna[Malas];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Resultados</title>
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
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Estadisticas de los resultados:</h4>
								</div>
								<div class="card-body">
                    				<script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    				<script>
                    					var buena  = '<?php echo $buenas; ?>';
                    					var mala  = '<?php echo $malas; ?>';
                    					google.load("visualization", "1", {packages:["corechart"]});
                    					google.setOnLoadCallback(drawChart1);
                    					function drawChart1() {
                    					  var data = google.visualization.arrayToDataTable([
                    					    ['Respuestas', 'Correctas', '', 'Incorrectas'],
                    					    ['Respuestas',  parseInt(buena), 0, parseInt(mala)],
										
                    					  ]);
                    					  var options = {
                    					    title: 'Gráfica de resultados',
                    					  };
									  
                    					  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
                    					  chart.draw(data, options);
                    					}
									
                    					$(window).resize(function(){
                    					  drawChart1();
                    					});
                    					// Reminder: you need to put https://www.google.com/jsapi in the head of your document or as an external resource on codepen //
                    				</script>

                  					<div id="chart_div1" style="height: 500px"></div>
								</div>
                				<div class="card-footer">
                				  <?php
                				      	echo "<a href=\"verPreguntas.php?idCuest=". base64_encode($numCuest) ."&clave=". base64_encode($clave) ."\">
                				              <button type=\"submit\" name=\"login\" class=\"btn btn-default btn-lg\"> Siguiente Pregunta </button>
                				            </a>";
										$estado=1;
									  	$guardar1 = $conexion->prepare("UPDATE PREGUNTA SET Estado=? WHERE idPregunta=?");
									  	if (!$guardar1->execute(array($estado,$numPreg))) {
											#error en la consulta anterior
											echo"Algo ha ido mal en la consulta a la base de datos";
										}
                				   ?>
                				</div>
							</div>
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
