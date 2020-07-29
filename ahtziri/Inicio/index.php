<?php
  //si no esta logueado mandarlo al index principal
  session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Admin</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
  <link rel="shortcut icon" type="image/x-icon" href="img/icon.png"/>
</head>
<body>
	<?php
		include("../conexion.php");
		$id = 1;
		$usuarioLog = $_SESSION['User'];
		$emailLog = $_SESSION['Email'];
	?>

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
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span >  <?php echo $usuarioLog; ?></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
										<div class="u-text">
											<h4>  <?php echo $usuarioLog; ?></h4>
											<p class="text-muted"><?php  echo $emailLog; ?></p><a href="salir.php" class="btn btn-rounded btn-danger btn-sm">Cerrar Sesión</a></div>
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
							<img src="assets/img/profile.jpg">
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
						<li class="nav-item active">
							<a href="index.php">
								<i class="la la-dashboard"></i>
								<p>Panel de Control</p>
							</a>
						</li>
						<li class="nav-item update-pro">
							<button data-toggle="modal" onclick="location.href='creacionDeCuestionarios/creacionDeCuestionario.php'">
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
						<h4 class="page-title">Panel de Control</h4>
						<div class="row">
							<div class="col-md-4">
								<div class="card card-stats card-warning">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-users"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Encuestados</p>
                          							<?php
														$resultadoTotalEncuestados = $conexion->prepare("SELECT count(Nickname) AS TotalEncuestados FROM JUGADOR E JOIN CUESTIONARIO_REALIZADO D
															ON E.CodigoCuestionario = D.CodigoGenerado
														  	JOIN CUESTIONARIO A ON D.Cuestionario_Id = A.idCuestionario WHERE Admin_User=?");
														if (!$resultadoTotalEncuestados->execute(array($usuarioLog))) {
															#error en la consulta anterior
															echo"Algo ha ido mal en la consulta a la base de datos";
														}
														while ($columnas = $resultadoTotalEncuestados->fetch(PDO::FETCH_BOTH)) {
															$countEncuestados = $columnas[0];
														}
                          							 ?>
													<h4 class="card-title"><?php echo $countEncuestados; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card card-stats card-success">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-newspaper-o"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Cuestionarios</p>
                          							<?php
														$resultadoTotalCuestionarios = $conexion->prepare("SELECT count(idCuestionario) as TotalCuestionarios FROM ADMINISTRADOR E JOIN CUESTIONARIO D
															ON E.User = D.Admin_User WHERE User=?");
														if (!$resultadoTotalCuestionarios->execute(array($usuarioLog))) {
															#error en la consulta anterior
															echo"Algo ha ido mal en la consulta a la base de datos";
														}
														while ($columnas = $resultadoTotalCuestionarios->fetch(PDO::FETCH_BOTH)) {
															$countCuestionariosCreados = $columnas[0];
														}

                          							?>
													<h4 class="card-title"><?php echo $countCuestionariosCreados; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card card-stats card-primary">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-check-circle"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Realizados</p>
													<?php
															$resultadoTotalCuestionariosRealizados = $conexion->prepare("SELECT count(CodigoGenerado) as TotalRealizados FROM CUESTIONARIO_REALIZADO E JOIN CUESTIONARIO D
																ON E.Cuestionario_Id = D.idCuestionario
																JOIN ADMINISTRADOR A on D.Admin_User = A.User where User=?");
															if (!$resultadoTotalCuestionariosRealizados->execute(array($usuarioLog))) {
																#error en la consulta anterior
																echo"Algo ha ido mal en la consulta a la base de datos";
															}
															while ($columnas = $resultadoTotalCuestionariosRealizados->fetch(PDO::FETCH_BOTH)) {
																$countCuestionariosRealizados = $columnas[0];
															}
                          							 ?>
													<h4 class="card-title"><?php echo $countCuestionariosRealizados; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-10">
								<div class="card">
									<div class="card-header ">
										<h4 class="card-title">Tus cuestionarios creados</h4>
									</div>
									<div class="card-body">
										<table class="table table-head-bg-success table-striped table-hover">
											<thead>
												<tr>
													<th scope="col">Acciones</th>
													<th scope="col">Título del cuestionario</th>
												</tr>
											</thead>
											<tbody>
											<?php
												$result = $conexion->prepare("SELECT * FROM CUESTIONARIO WHERE Admin_User=?");
												if (!$result->execute(array($usuarioLog))) {
													#error en la consulta anterior
													echo"Algo ha ido mal en la consulta a la base de datos";
												}
												while ($row = $result->fetch(PDO::FETCH_BOTH)) {
													echo "
														<tr>
															<td><a href=\"esperandoConexion.php?idCuest=". base64_encode($row[0]) ."&nombreCuest=". base64_encode($row[1]) ."\"><button type=\"submit\" class=\"btn btn-primary\">Activar</button></a>
															<a href=\"esperandoConexion.php?idCuest=". base64_encode($row[0]) ."&nombreCuest=". base64_encode($row[1]) ."\"><button type=\"submit\" class=\"btn btn-danger\">Eliminar</button></a>
															<td>".$row[1]."</td>
														</tr>";
												}
											?>
										 </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-10">
								<div class="card card-tasks">
									<div class="card-header ">
										<h4 class="card-title">Cuestionarios Realizados</h4>
										<p class="card-category">Puedes guiarte según el código de la sala del cuestionario realizado.</p>
									</div>
									<div class="card-body ">
										<div class="table-full-width">
                    						<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th>Código</th>
															<th>Título del cuestionario</th>
															<th>Descargar</th>
														</tr>
													</thead>
                       								<?php
														$result2 = $conexion->prepare("SELECT CUESTIONARIO_REALIZADO.CodigoGenerado, CUESTIONARIO.Nombre FROM CUESTIONARIO
                       								 		INNER JOIN ADMINISTRADOR ON CUESTIONARIO.Admin_User = ADMINISTRADOR.User
                       								 		INNER JOIN CUESTIONARIO_REALIZADO ON CUESTIONARIO_REALIZADO.Cuestionario_Id = CUESTIONARIO.idCuestionario
																WHERE ADMINISTRADOR.User=?");
														if (!$result2->execute(array($usuarioLog))) {
															#error en la consulta anterior
															echo"Algo ha ido mal en la consulta a la base de datos";
														}
                       								?>
													<tbody>
                       								<?php
                       									while ($row2 = $result2->fetch(PDO::FETCH_BOTH)) {
                       								  	echo "
                       								    	<tr>
                       								    	  <td>".$row2[0]."</td>
                       								    	  <td>".$row2[1]."</td>
                       								    	  <td><a href=\"exportarCsv.php?clave=". base64_encode($row2[0]) ."\"><button type=\"submit\" class=\"btn btn-primary btn-round\">Resultados <i class=\"la la-download\"></i></button></a>
                       								    	</tr>";
                       									}
                       								?>
                       								</tbody>
												</table>
                     						</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="footer">
					<div class="container-fluid">
						<nav class="pull-left">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link">
										Jony
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link">
										Jesfrin
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link">
										Bryan
									</a>
								</li>
                				<li class="nav-item">
									<a class="nav-link">
										Ricardo
									</a>
								</li>
							</ul>
						</nav>
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
					<h6 class="modal-title"><i class="la la-frown-o"></i> Ahtziri | Software Libre</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>Este nunca será un proyecto terminado, si gustas puedes ser parte y seguir construyendo este gran proyecto para que creemos una gran plataforma de acceso libre.</p>
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
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/demo.js"></script>
</html>
