<?php

    session_start();
    include("conexion.php");
    $idCuest=base64_decode($_GET['idCuest']);
    $idPreg=base64_decode($_GET['idPreg']);
    $codCuest = $_SESSION['codCuesJugado'];
    $nick = $_SESSION['nickname'];

    $correcta = 0;
    $idJugador = 1;

    //recuperando $idJugador
	
	$jugador = $conexion->prepare("SELECT * FROM JUGADOR WHERE NIckName = ? AND CodigoCuestionario = ? LIMIT 1");
	if (!$jugador->execute(array($nick,$codCuest))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
    }
	while ($fila = $jugador->fetch(PDO::FETCH_BOTH)) {
        $idJugador = $fila[idJugador]; //guarda el id del jugador
    }

    //recuperando la respuesta del jugador inner join con jugador
	$respuestaCorrecta =  $conexion->prepare("SELECT R.idRespuestaJugador, R.Correcta, R.Jugador_Id,R.PREGUNTA_idPregunta,
	J.idJugador, J.NIckName, J.CodigoCuestionario
	FROM RESPUESTA_JUGADOR R INNER JOIN JUGADOR J ON R.Jugador_Id = J.idJugador
	WHERE J.CodigoCuestionario = ? AND J.idJugador=? AND R.PREGUNTA_idPregunta = ? LIMIT 1");
	
	if (!$respuestaCorrecta->execute(array($codCuest,$idJugador,$idPreg))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
    }
	while ($fila2 = $respuestaCorrecta->fetch(PDO::FETCH_BOTH)) {
        $correcta = $fila2[Correcta]; //guarda su respuesta
    }

    //ahora recuperamos la respuesta que era la correcta segun el id de la pregunta
    //recuperacion de las respuestas de la pregunta
    $mostrarResp = "";
	$escorrecta=1;
	$respuestasCorrectas =  $conexion->prepare("SELECT R.idRespuesta, R.Descripcion,R.No_Respuesta, R.Pregunta_Id,R.esCorrecta, P.idPregunta, P.Cuestionario_Id_Pregunta
	FROM RESPUESTA R INNER JOIN PREGUNTA P ON R.Pregunta_Id = P.idPregunta WHERE P.idPregunta =? AND esCorrecta= ?");
	

	if (!$respuestasCorrectas->execute(array($idPreg,$escorrecta))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
    }
	while ($cor = $respuestasCorrectas->fetch(PDO::FETCH_BOTH)) {
        $mostrarResp = $cor[Descripcion]; //guarda el id del jugador
    }

?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Resultado</title>
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
					Resultado
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
            		<?php
            			if ($correcta == 0) {
              				//echo "fallo";
              				echo "<div class=\"row\">
  									<div class=\"col-md-6\">
  										<div class=\"card\">
  											<div align=\"center\" class=\"card-header\">
                      							<img src=\"Imagenes/respuestaIncorrecta.png\" style=\"width:100%; height:100%;\">
  											</div>
  										</div>
  									</div>
  								</div>
            					<div class=\"row\">
              						<div class=\"col-md-6\">
  										<div class=\"card card-stats card-danger\">
  											<div class=\"card-body \">
  												<div class=\"row\">
  													<div class=\"col-4\">
  														<div class=\"icon-big text-center\">
  															<i class=\"la la-frown-o\"></i>
  														</div>
  													</div>
  													<div class=\"col-7 d-flex align-items-center\">
  														<div class=\"numbers\">
  															<h4 class=\"card-title\">La respuesta correcta es: $mostrarResp</h4>
                            								<p class=\"card-category\">¿Listo para continuar? Espera un momento</p>
  														</div>
  													</div>
  												</div>
  											</div>
  										</div>
  									</div>
            					</div>";
           				} else {
              				//echo "acerto";
              				echo "<div class=\"row\">
  									<div class=\"col-md-6\">
  										<div class=\"card\">
  											<div align=\"center\" class=\"card-header\">
                      							<img src=\"Imagenes/respuestaCorrecta.png\" style=\"width:100%; height:100%;\">
  											</div>
  										</div>
  									</div>
  								</div>
            					<div class=\"row\">
              						<div class=\"col-md-6\">
  										<div class=\"card card-stats card-success\">
  											<div class=\"card-body \">
  												<div class=\"row\">
  													<div class=\"col-4\">
  														<div class=\"icon-big text-center\">
  															<i class=\"la la-smile-o\"></i>
  														</div>
  													</div>
  													<div class=\"col-7 d-flex align-items-center\">
  														<div class=\"numbers\">
  															<h4 class=\"card-title\">¿Listo para continuar?</h4>
                            								<p class=\"card-category\">Espera un momento</p>
  														</div>
  													</div>
  												</div>
  											</div>
  										</div>
  									</div>
            					</div>";
            			}
             		?>
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
					<p><?php
          				if ($correcta == 0) {
          				  // code...
          				  //echo "fallo";
          				  echo "¡Tu puedes! sigue intentándolo";
						
          				} else {
          				  //echo "acerto";
          				  echo "¡Bien hecho! Has respondido correctamente";
						
          				}
          				 ?>, ahora solo te queda esperar a que el administrador continue para que puedas ver la siguiente pregunta.
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Gracias</button>
				</div>
			</div>
		</div>
	</div>

  <div  class="content">
  </div>
  <div id="seccionRecargar">
  </div>
  <script type="text/javascript">

      $(document).ready(function(){
        setInterval(
          function(){
            $('#seccionRecargar').load('verificarSiCuestionarioActivo.php');
          },500
        );
      });
  </script>

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
