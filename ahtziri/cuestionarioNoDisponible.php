<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Incativo</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<link rel="stylesheet" href="Inicio/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="Inicio/assets/css/ready.css">
	<link rel="stylesheet" href="Inicio/assets/css/demo.css">
  	<link rel="shortcut icon" type="image/x-icon" href="Imagenes/icon.png"/>
</head>
<body>
  	<div class="wrapper">
    	<div class="main-header">
			<div class="logo-header">
				<a  class="logo">
					Cuestionario Inactivo
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
  						<div class="col-md-5">
  							<div class="card">
  								<div align="center" class="card-header">
                      				<img src="Imagenes/warning.gif" style="width:60%; height:60%;">
  								</div>
  							</div>
  						</div>
  					</div>
            		<div class="row">
              			<div class="col-md-5">
  							<div class="card card-stats card-warning">
  								<div class="card-body ">
  									<div class="row">
  										<div class="col-4">
  											<div class="icon-big text-center">
  												<i class="la la-frown-o"></i>
  											</div>
  										</div>
  										<div class="col-7 d-flex align-items-center">
  											<div class="numbers">
  													<h4 class="card-title">Ups ¡Es posible que este cuestionario ya haya iniciado!</h4>
                            						<p class="card-category">O actualmente no se encuentra disponible</p>
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
					<p>Las posibles razones por las cuales veas este mensaje son que el administrador ya inició con el cuestionario o que el cuestionario ya no se encuentre activo.</p>
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
