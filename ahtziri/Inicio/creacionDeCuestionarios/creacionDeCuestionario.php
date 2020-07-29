<?php
session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 	<title>Ahtziri | Admin</title>
 	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
 	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
 	<link rel="stylesheet" href="../assets/css/ready.css">
 	<link rel="stylesheet" href="../assets/css/demo.css">
  <link rel="shortcut icon" type="image/x-icon" href="../img/icon.png"/>
 </head>
 <body>
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
            			<li class="nav-item update-pro">
 							<button data-toggle="modal" data-target="#modalUpdate">
 								<i class="la la-info-circle"></i>
 								<p>Ayuda</p>
 							</button>
 						</li>
            			<li class="nav-item update-pro">
 							<button class="btn btn-danger" data-toggle="modal" onclick="location.href='../index.php'">
 								<i class="la la-hand-pointer-o"></i>
 								<p>Cancelar</p>
 							</button>
 						</li>
 					</ul>
 				</div>
 			</div>
      		<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">¡Crea tu cuestionario!</h4>
						<div class="row">
							<div class="col-md-10">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Iniciemos con...</div>
									</div>
                  					<form action="crearPreguntas.php" method="post">
										<div class="card-body">
											<div class="form-group">
												<label for="titulo">Título</label>
												<input type="text" name="nombreC" class="form-control" id="titulo" placeholder="Título de tu cuestionario" autocomplete="off" required>
											</div>
											<div class="form-group">
												<label for="comment">Descripción</label>
												<textarea class="form-control" name="descripcionC" id="descripcion" rows="3">
												</textarea>
                        					<small id="emailHelp" class="form-text text-muted">Ingresa una breve descripción para que todos sepan de que trata tu cuestionario.</small>
											</div>
										</div>
										<div class="card-action">
											<button class="btn btn-success">Crear</button>
										</div>
                  					</form>
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
 					<p>Para crear tu cuestionario primero debes ingresar el Título y una Descripción. Luego únicamente
              			deberas hacer click en <b>Crear</b> y avanzaras a la pantalla para ingresar tus preguntas y respuestas.</p>
 					<p>
 						<b>En cada paso tendrás la opcion Ayuda para saber como crear tu cuestionario.</b>
					</p>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
