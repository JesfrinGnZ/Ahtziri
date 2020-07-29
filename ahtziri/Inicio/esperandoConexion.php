<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Esperando Conexión</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png"/>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
</head>
<body>
  <div class="wrapper">
    <div class="main-header">
      <div class="logo-header">
        <a href="index.php" class="logo">
          Administrator
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
      </div>
    </div>
    <div class="sidebar">
      <div class="scrollbar-inner sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item update-pro">
            <button data-toggle="modal" data-target="#modalUpdate">
              <i class="la la-info-circle"></i>
              <p>Ayuda</p>
            </button>
          </li>
           <li class="nav-item update-pro">
            <button class="btn btn-danger" data-toggle="modal" onclick="location.href='index.php'">
              <i class="la la-close"></i>
              <p>Cancelar</p>
            </button>
          </li>
        </ul>
      </div>
    </div>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<h2 class="page-title">Espera un momento</h2>
          <?php
            session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }
            include("../conexion.php");
            $nombreCuest = base64_decode($_GET['nombreCuest']);
            $numCuest = base64_decode($_GET['idCuest']);
            //antes de iniciar setear preguntas a 0
            $estado=0;
            $guardar = $conexion->prepare("UPDATE PREGUNTA SET Estado=? WHERE Cuestionario_Id_Pregunta=?");
            if (!$guardar->execute(array($estado,$numCuest))) {
              #error en la consulta anterior
              echo"Algo ha ido mal en la consulta a la base de datos";
            }

            $activo=1;
            $guardar2 = $conexion->prepare("UPDATE CUESTIONARIO SET Activo=? WHERE idCuestionario=?");
            if (!$guardar2->execute(array($activo,$numCuest))) {
              #error en la consulta anterior
              echo"Algo ha ido mal en la consulta a la base de datos";
            }

            echo "<h4 class=\"page-title\">Mientras todos se conectan al cuestionario: $nombreCuest</h4>";
          ?>
          <!--<h4 class="page-title">Mientras todos entran al cuestionario: </h4> -->
          <div class="row">
						<div class="col-md-5">
							<div class="card card-stats card-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-2">
											<div class="icon-big text-center">
												<i class="la la-check-circle"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
												<p class="card-category">Código de Sala</p>
                        <?php
                          $clave="";
                          $max_chars = round(rand(8,8));  // tendrá entre 7 y 10 caracteres
                          $chars = array();
                          for ($i="A"; $i<"Z"; $i++) $chars[] = $i;
                          $chars[] = "Z";
                          for ($i=0; $i<$max_chars; $i++) {
                            $letra = round(rand(0, 1));
                            if ($letra) // es letra
                              $clave .= $chars[round(rand(0, count($chars)-1))];
                            else // es numero
                              $clave .= round(rand(0, 9));
                          }
                          $_SESSION['esperandoConexion']=$clave;
                          $_SESSION['idCuest1']=$numCuest;
                          $_SESSION['nameCuest']=$nombreCuest;
                          $cl=$_SESSION['esperandoConexion'];
                          echo "<h2> $cl </h2>";
                          //insertando cuestionario realizado
                          $guardar3 = $conexion->prepare("INSERT INTO CUESTIONARIO_REALIZADO (CodigoGenerado,Cuestionario_Id) VALUES (?,?)");
                          if (!$guardar3->execute(array($clave,$numCuest))) {
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
            <div class="col-md-3">
								<img src="../Imagenes/cargando2.gif" width="156" height="156" />
						</div>
					</div>
          <div id="seccionRecargar" class="container"></div>
            <div class="container">
              <script type="text/javascript">
                  $(document).ready(function(){
                    setInterval(
                      function(){
                        $('#seccionRecargar').load('jugadores.php');
                      },500
                    );
                  });
              </script>
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
 					<h6 class="modal-title"><i class="la la-check-circle-o"></i> Ahtziri | Ayuda</h6>
 					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 						<span aria-hidden="true">&times;</span>
 					</button>
 				</div>
 				<div class="modal-body text-center">
 					<p>Para que las personas puedan responder tu cuestionario, debes brindarles el <b>Código de Cuestionario</b>
             el cual aparece en pantalla, de este modo ellos podrán ingresar a la sala.</p>
 					<p>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">¡Gracias!</button>
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
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/demo.js"></script>
</html>
