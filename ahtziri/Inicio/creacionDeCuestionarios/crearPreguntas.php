<?php
error_reporting(E_ALL ^ E_NOTICE);
include("inicioCreacionDePreguntas.php");
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 	<title>Ahtziri | Preguntas</title>
 	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<link rel="shortcut icon" type="image/x-icon" href="../img/icon.png"/>
 	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
 	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
 	<link rel="stylesheet" href="../assets/css/ready.css">
 	<link rel="stylesheet" href="../assets/css/demo.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" >
  	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  	<script>
  		function noatras(){
			window.location.hash="no-back-button";
			window.location.hash="Again-No-back-button"
			window.onhashchange=function(){
    	        window.location.hash="no-back-button";
    	    }
		}

		function validaCampos(){
		
		var pregunta = $("#pregunta").val();
		var r1 = $("#r1").val();
		var r2 = $("#r2").val();
		var r2 = $("#r3").val();
		var r2 = $("#r4").val();
		
		//
		var c1 = document.getElementById('rc1').checked;
		var c2 = document.getElementById('rc2').checked;
		var c3 = document.getElementById('rc3').checked;
		var c4 = document.getElementById('rc4').checked;
		
		
		//validamos campos
		if(!c1 && !c2 && !c3 && !c4){
		  toastr.error("Debes seleccionar al menos una respuesta correcta.","¡Aviso!");
		  return false;
		}

		if($.trim(pregunta) == "" || $.trim(r1)=="" || $.trim(r2)=="" || $.trim(r3)=="" || $.trim(r4)==""){
		toastr.error("No has ingresado algunos datos que son obligatorios.","¡Aviso!");
		  return false;
		}

		}

		function mostrarMensajeDeTerminado(){
		  alert("Cuestionario Guardado");
		  return true;
		}

		function mostrarMensajeDeBorrado(){
		  alert("Cuestionario Borrado");
		  return true;
		}

	</script>
 </head>
 <body onload="noatras();">
 	<?php
 		include("../../conexion.php");
 		$id = 1;
 		$usuarioLog = $_SESSION['User'];
 	?>

 	<div class="wrapper">
 		<div class="main-header">
 			<div class="logo-header">
 				<a class="logo">
 					Administrator
 				</a>
         		<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
 					<span class="navbar-toggler-icon"></span>
 				</button>
 				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
 			</div>
 			<nav class="navbar navbar-header navbar-expand-lg">
 				<div class="container-fluid">
 					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
 						<li class="nav-item dropdown">
 							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="../assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span >  <?php echo $usuarioLog; ?></span></span> </a>
 							<ul class="dropdown-menu dropdown-user">
 								<li>
 									<div class="user-box">
 										<div class="u-img"><img src="../assets/img/profile.jpg" alt="user"></div>
 										<div class="u-text">
 											<h4>  <?php echo $usuarioLog; ?></h4>
 											<p class="text-muted">jonychiroyrivera@correo.com</p><a href="../salir.php" class="btn btn-rounded btn-danger btn-sm">Cerrar Sesión</a></div>
 										</div>
 									</li>
 									<div class="dropdown-divider"></div>
 								</ul>
 								<!-- /.dropdown-user -->
 							</li>
 						</ul>
 					</div>
 				</nav>
 			</div>
 			<div class="sidebar">
 				<div class="scrollbar-inner sidebar-wrapper">
 					<div class="user">
 						<div class="photo">
 							<img src="../assets/img/profile.jpg">
 						</div>
 						<div class="info">
 							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
 								<span>
 									<?php echo $usuarioLog ?>
 									<span class="user-level">Administrator</span>
 								</span>
 							</a>
 							<div class="clearfix"></div>
 						</div>
 					</div>
 					<ul class="nav">
            			<li class="nav-item">
							<a onclick="mostrarMensajeDeTerminado();" href="terminarCuestionario.php">
								<i class="la la-save"></i>
								<p>Guardar Cuestionario</p>
							</a>
						</li>
            			<li class="nav-item">
							<a onclick="mostrarMensajeDeBorrado();" href="borrarCuestionario.php">
								<i class="la la-trash"></i>
								<p>Descartar Cuestionario</p>
							</a>
						</li>
            			<li class="nav-item update-pro">
 							<button data-toggle="modal" data-target="#modalUpdate">
 								<i class="la la-info-circle"></i>
 								<p>Ayuda</p>
 							</button>
 						</li>
 					</ul>
 				</div>
 			</div>
      		<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Agrega preguntas al cuestionario: <?php echo $_SESSION['nombreDeCuestionario']; ?></h4>
            			<div class="row">
							<div class="col-md-10">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Ingresa una pregunta y 4 posibles respuestas.</div>
									</div>
                 					<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  onsubmit="return validaCampos();">
													<div class="card-body">
                    					<div class="form-group">
                    					  	<span class="badge badge-primary">Pregunta</span>
												<input type="text" name="pregunta" class="form-control" id="pregunta" placeholder="Ingresa una nueva pregunta" autocomplete="off" required>
										</div>
                    					<div class="form-group">
                    						<span class="badge badge-success">Respuesta 1</span>
												<input type="text" name="r1" class="form-control" id="r1" placeholder="Ingresa una nueva respuesta" autocomplete="off" required>
										</div>
                    					<div class="form-group">
                    					  	<span class="badge badge-warning">Respuesta 2</span>
											<input type="text" name="r2" class="form-control" id="r2" placeholder="Ingresa una nueva respuesta" autocomplete="off" required>
										</div>
                    					<div class="form-group">
                    					  	<span class="badge badge-danger">Respuesta 3</span>
											<input type="text" name="r3" class="form-control" id="r3" placeholder="Ingresa una nueva respuesta" autocomplete="off" required>
										</div>
                    					<div class="form-group">
                    					  	<span class="badge badge-info">Respuesta 4</span>
											<input type="text" name="r4" class="form-control" id="r4" placeholder="Ingresa una nueva respuesta" autocomplete="off" required>
										</div>
                    					<div class="card-header">
  											<div class="card-title">Marca las respuestas correctas.</div>
  										</div>
                    					<div class="form-check">
                    					  <label class="form-check-label">
                    					    <input class="form-check-input" type="checkbox" name="rc1" id="rc1">
                    					    <span class="form-check-sign">Respuesta 1</span>
                    					  </label><br>
                    					  <label class="form-check-label">
                    					    <input class="form-check-input" type="checkbox" name="rc2" id="rc2">
                    					    <span class="form-check-sign">Respuesta 2</span>
                    					  </label><br>
                    					  <label class="form-check-label">
                    					    <input class="form-check-input" type="checkbox" name="rc3" id="rc3">
                    					    <span class="form-check-sign">Respuesta 3</span>
                    					  </label><br>
                    					  <label class="form-check-label">
                    					    <input class="form-check-input" type="checkbox" name="rc4" id="rc4">
                    					    <span class="form-check-sign">Respuesta 4</span>
                    					  </label><br>
                    					</div>
                    					<div class="form-group">
                    					  <label for="pillSelect">Tiempo para responder:</label>
                    					  <select name="tiempo" id="tiempo" class="form-control input-pill" id="pillSelect">
                    					    <option value="20">20 segundos</option>
                    					    <option value="30">30 segundos</option>
                    					    <option value="40">40 segundos</option>
                    					    <option value="50">50 segundos</option>
                    					    <option value="60">60 segundos</option>
                    					  </select>
                    					</div>
										</div>
										<div class="card-action">
											<button class="btn btn-success">Agregar pregunta</button>
                    					  <small class="form-text text-muted">Al terminar de agregar tus preguntas, ve al menú para guardar el cuestionario.</small>
										</div>
                  					</form>
								</div>
							</div>
						</div>
              			<div class="row">
  							<div class="col-md-10">
  								<div class="card">
  									<div class="card-header ">
  										<h4 class="card-title">Preguntas y respuestas agregadas</h4>
  									</div>
                    				<div class="card-body">
                    					<?php
                    					//echo "EMPEZANDO A REALIZAR ACCIONES ";
                    					if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    					    // Usamos la Variable Super Global $_REQUEST
                    					    $nombreDePregunta = htmlspecialchars($_REQUEST['pregunta']);
                    					    if (!empty($nombreDePregunta)){//Aca se trabajara con las preguntas
                    					        //Valores
                    					        $descripcion=$_POST['pregunta'];
                    					        $tiempo=$_POST['tiempo'];
												$idCuestionario=$_SESSION['idCuestionario'];
												
                    					        include("../../conexion.php");
                    					        //Guardar la pregunta
												$estado=0;
												$guardar2=$conexion->prepare("INSERT INTO PREGUNTA(Descripcion,Tiempo,Cuestionario_Id_Pregunta,Estado) VALUES (?,?,?,?)");   
												if (!$guardar2->execute(array($descripcion,$tiempo,$idCuestionario,$estado))) {
													#error en la consulta anterior
													echo"Algo ha ido mal en la consulta a la base de datos";
												}
												//Obtener el id de la pregunta
									
												$preguntaCreada = $conexion->prepare("SELECT * FROM PREGUNTA order by idPregunta DESC LIMIT 1");
												if (!$preguntaCreada->execute(array())) {
													#error en la consulta anterior
													echo"Algo ha ido mal en la consulta a la base de datos";
												}
												while ($pregunta = $preguntaCreada->fetch(PDO::FETCH_BOTH)) {
                    					       		//  echo "Id de pregunta guardada:".$pregunta['idPregunta'];
                    					         	$idDePreguntaCreada=$pregunta[idPregunta];
												}
												   
                    					      	//Se crean las respuestas
                    					       	if (isset($_POST["rc1"])) {
                    					         	$respuestaEsCorrecta="1";
                    					       	} else {
                    					        		$respuestaEsCorrecta="0";
                    					       	}
                    					       	$descripcion=$_POST['r1'];
												$nrespuesta=1;
												$simbolo="cuadrado";
												$color="verde";
												$guardar3=$conexion->prepare("INSERT INTO RESPUESTA(Descripcion,No_Respuesta,Simbolo,Color,Pregunta_Id,esCorrecta) VALUES (?,?,?,?,?,?)");
												if (!$guardar3->execute(array($descripcion,$nrespuesta,$simbolo,$color,$idDePreguntaCreada,$respuestaEsCorrecta))) {
													#error en la consulta anterior
													echo"Algo ha ido mal en la consulta a la base de datos";
												}
												
												if (isset($_POST["rc2"])) {
                    					         	$respuestaEsCorrecta="1";
                    					       	} else {
                    					         	$respuestaEsCorrecta="0";
                    					       	}
                    					       	$descripcion=$_POST['r2'];
												$nrespuesta=2;
												$simbolo="triangulo";
												$color="amarillo";
												$guardar3=$conexion->prepare("INSERT INTO RESPUESTA(Descripcion,No_Respuesta,Simbolo,Color,Pregunta_Id,esCorrecta) VALUES (?,?,?,?,?,?)");
												if (!$guardar3->execute(array($descripcion,$nrespuesta,$simbolo,$color,$idDePreguntaCreada,$respuestaEsCorrecta))) {
												   #error en la consulta anterior
												   echo"Algo ha ido mal en la consulta a la base de datos";
												}

                    					       	if (isset($_POST["rc3"])) {
                    					         	$respuestaEsCorrecta="1";
                    					       	} else {
                    					         	$respuestaEsCorrecta="0";
                    					       	}
                    					       	$descripcion=$_POST['r3'];
												$nrespuesta=3;
												$simbolo="circulo";
												$color="rojo";
												$guardar3=$conexion->prepare("INSERT INTO RESPUESTA(Descripcion,No_Respuesta,Simbolo,Color,Pregunta_Id,esCorrecta) VALUES (?,?,?,?,?,?)");
												if (!$guardar3->execute(array($descripcion,$nrespuesta,$simbolo,$color,$idDePreguntaCreada,$respuestaEsCorrecta))) {
												   #error en la consulta anterior
												   echo"Algo ha ido mal en la consulta a la base de datos";
												}

                    					       	if (isset($_POST["rc4"])) {
                    					         	$respuestaEsCorrecta="1";
                    					       	} else {
                    					         	$respuestaEsCorrecta="0";
                    					       	}
                    					       	$descripcion=$_POST['r4'];
												$nrespuesta=4;
												$simbolo="rombo";
												$color="celeste";
												$guardar3=$conexion->prepare("INSERT INTO RESPUESTA(Descripcion,No_Respuesta,Simbolo,Color,Pregunta_Id,esCorrecta) VALUES (?,?,?,?,?,?)");
												if (!$guardar3->execute(array($descripcion,$nrespuesta,$simbolo,$color,$idDePreguntaCreada,$respuestaEsCorrecta))) {
												   #error en la consulta anterior
												   echo"Algo ha ido mal en la consulta a la base de datos";
												}
												   
												//Se cargan las preguntas y respuestas creados de la pregunta para colocarlos eb una mysql_tabla
												$preguntasCreadas = $conexion->prepare("SELECT idPregunta,Descripcion,Tiempo FROM PREGUNTA WHERE Cuestionario_Id_Pregunta=?");
												if (!$preguntasCreadas->execute(array($idCuestionario))) {
													#error en la consulta anterior
													echo"Algo ha ido mal en la consulta a la base de datos";
												}

                   								echo "<table class=\"table table-head-bg-success table-striped table-hover\">
                   								<thead class=\"thead-light\">
                    							 <tr>
                    							   <th scope=\"col\">Pregunta</th>
                    							   <th scope=\"col\">Respuesta1</th>
                    							   <th scope=\"col\">Respueta2</th>
                    							   <th scope=\"col\">Respuesta3</th>
                    							   <th scope=\"col\">Respuesta4</th>
                    							 </tr>
                   								</thead>
                   								<tbody>";
                   								while ($pregunta = $preguntasCreadas->fetch(PDO::FETCH_BOTH)) {
                    							 	//echo "Id de pregunta creada:".$pregunta['idPregunta'];
                    							 	echo " <tr>";
                    							 	$idDepreguntaActual=$pregunta[idPregunta];
													$respuestasDePregunta =$conexion->prepare("SELECT * FROM RESPUESTA WHERE Pregunta_Id=?");
													if (!$respuestasDePregunta->execute(array($idDepreguntaActual))) {
														#error en la consulta anterior
														echo"Algo ha ido mal en la consulta a la base de datos";
													}
                    							 	echo "<td>".$pregunta[Descripcion]."</td> ";
                    							 	while ($respuestaDePregunta = $respuestasDePregunta->fetch(PDO::FETCH_BOTH)) {
                    							 	  	echo "<td>".$respuestaDePregunta[Descripcion]."</td> ";
                    							 	}
                    							 	echo " </tr>";
                   								}
											   
                   								echo "</tbody>
                    							     </table>";
											   
                    					    }else{
                    					      echo "<h4>Aún no existen preguntas</h4>";
                    					    }
										
                    					}
									
                   						?>
                    				</div>
  								</div>
  							</div>
  						</div>
					</div>
				</div>
          		<footer class="footer">
  					<div class="container-fluid">
  						<div class="copyright ml-auto">
  							Proyecto iniciado en 2019, en Centro Universitario de Occidente
  						</div>
  					</div>
  				</footer>
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
 					<p>Para <b>agregar preguntas</b> a tu cuestionario únicamente debes llenar los campos con la información que se
            			te solicita en el panel principal. Recuerda que debes marcar <b>al menos una</b> respuesta como correcta.</p>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Gracias</button>
 				</div>
 			</div>
 		</div>
 	</div>
 </body>
 <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
 <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
 <script src="../assets/js/core/popper.min.js"></script>
 <script src="../assets/js/core/bootstrap.min.js"></script>
 <script src="../assets/js/plugin/chartist/chartist.min.js"></script>
 <script src="../assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
 <script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
 <script src="../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
 <script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
 <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
 <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
 <script src="../assets/js/ready.min.js"></script>
 <script src="../assets/js/demo.js"></script>
 </html>
