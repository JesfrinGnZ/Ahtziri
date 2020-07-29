<?php
  //si no esta logueado mandarlo al index principal
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }

  include("../conexion.php");

  //recibiendo datos con get
  $nombreCuest=$_SESSION['nameCuest'];
  $numCuest = base64_decode($_GET['idCuest']);
  $clave = base64_decode($_GET['clave']);

  //desactivando custionario para todods los clientes que se unieron despues de tiempo
  //en este caso los clientes deben verificar si esta en 0 para empezar a correr tiempo

  $activo=0;
  $guardar = $conexion->prepare("UPDATE CUESTIONARIO SET Activo=? WHERE idCuestionario=?");
  if (!$guardar->execute(array($activo,$numCuest))) {
		#error en la consulta anterior
		echo"Algo ha ido mal en la consulta a la base de datos";
	}

  $estado=0;
  $resultado =  $conexion->prepare("SELECT P.idPregunta, P.Descripcion, P.Tiempo,P.Estado, C.idCuestionario
    FROM PREGUNTA P INNER JOIN CUESTIONARIO C ON P.Cuestionario_Id_Pregunta = C.idCuestionario WHERE C.idCuestionario =? AND P.Estado=? LIMIT 1");
  if (!$resultado->execute(array($numCuest,$estado))) {
		#error en la consulta anterior
		echo"Algo ha ido mal en la consulta a la base de datos";
	}
  $idTemporal = 0;
  $tiempoPreg = 0;
  $descripcionPreg = "";

  //validando que la consulta haya recuperado algo
  if ($resultado->rowCount()>0) {
    while ($fila = $resultado->fetch(PDO::FETCH_BOTH)) {
      $descripcionPreg = $fila[Descripcion];
      $idTemporal = $fila[idPregunta]; //guarda el id de la pregunta a trabajar
      $tiempoPreg = $fila[Tiempo]; //guarda el id de la pregunta a trabajar
    }
    $time_on = 20;
  } else {
      //redirigimos a la parte de terminar cuestionario
      //**pasar todas las preguntas a usadas depues de terminar el cuestionario para que el cliente atrasado no pueda ver
      $estado=1;
      $guardar = $conexion->prepare("UPDATE PREGUNTA SET Estado=? WHERE idCuestionario=?");
      if (!$guardar->execute(array($estado,$numCuest))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
      }
      header("Location:cuestionarioTerminado.php?idCuest=". base64_encode($numCuest) ."&clave=". base64_encode($clave) ."");
      //echo "<script>window.open('cuestionarioTerminado.php','_self')</script>";
  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Lee la Pregunta</title>
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
                    echo "<h4 class=\"card-title\">Cuestionario: $nombreCuest</h4>";
                  ?>
								</div>
                <?php
                  echo "<h2>$descripcionPreg</h2>";
                ?>
							</div>
						</div>
					</div>
          <div class="row text-center" >
						<div class="col-md-4">
							<div class="card card-stats card-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-2">
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
                                  document.getElementById('countdown').innerHTML = timeLeft;
                                  if(timeLeft === 0){
                                      clearInterval(cinterval);
                                  }
                              };
                              cinterval = setInterval(timeDec, 1000);
                           })();
                        </script>
                        <div class="tex-center">
                          <p class="card-category"><h1><span id="countdown"><?php echo floor($time_on);
                            //redirigirndo a una vista despues de el tiempo time_on
                            //$guardar = mysqli_query($conexion,"UPDATE PREGUNTA SET Estado='1' WHERE idPregunta='$idTemporal'");
                            header( "refresh:$time_on; url=leerRespuestas.php?idCuest=". base64_encode($numCuest) ."&nomCuest=". base64_encode($nombreCuest) ."&idPregunta=". base64_encode($idTemporal) ."&tiempoPreg=". base64_encode($tiempoPreg) ."&clave=". base64_encode($clave) ."");
                            //cambiandomestado de pregunta a usada que es 1
                            //$guardar = mysqli_query($conexion,"UPDATE PREGUNTA SET Estado='1' WHERE idPregunta='$idTemporal'");
                            ?></span></h1><h3>segundos</h3></p>
                        </div>
                          <h4 class="card-title">Para leer</h4>
											  </div>
										  </div>
									  </div>
								  </div>
							  </div>
						  </div>
					  </div>
            <div class="row">
              <div class="col-md-3">
                  <img src="../Imagenes/cargando.gif" width="156" height="156" />
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
