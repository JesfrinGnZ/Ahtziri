<?php
  ob_start();
  //si no esta logueado mandarlo al index principal
  //recibiendo datos con get
  $idCuest = base64_decode($_GET['idCuest']);
  $codCuest = base64_decode($_GET['codCuest']);
  $nick = base64_decode($_GET['nick']);
  $idPreg = base64_decode($_GET['idPreg']);
  $time_on = base64_decode($_GET['tiempoPreg']) + 1; //mas uno por atraso del admin
  //recuperando respuestas para enviar
  ?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ahtziri | Responde</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png"/>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" >
  	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
	<div class="wrapper">
    	<div class="main-header">
			<div class="logo-header">
				<a  class="logo">
					Jugador
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
							<p>Ayuda</p>
						</button>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
        			<div class="row text-center" >
						<div class="col-md-4">
							<div class="card card-stats card-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-3">
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
                    							<div class="text-center">
                    							  <h4 class="card-title">
                    							    <span id="countdown"><?php echo floor($time_on);
                    							    //redirigirndo a una vista despues de el tiempo time_on
                    							    header("refresh:$time_on; url=../vistaEsperaPregunta.php?idCuest=". base64_encode($idCuest) ."&idPreg=". base64_encode($idPreg) ."");                            ?>
                    							  </span> Segundos para responder</h4>
                    							</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
       			 	<div class="row">
						<div class="col-md-12">
                  			<div class="col-md-6">
    							<div class="card">
    								<div class="card-header">
    									<div class="card-title">
                          					<label class="form-radio-label">
												<input class="form-radio-input" id="cbox1" type="radio" name="respuesta" value="1">
                           						<span class="form-radio-sign"><b>Respuesta 1</b></span>
											</label>
                        				</div>
    								</div>
    								<div class="card-body">
    									<img src="img/Cuadrado.jpg">
    								</div>
    							</div>
                    			<div class="card">
    								<div class="card-header">
                        				<div class="card-title">
                          					<label class="form-radio-label">
											   <input class="form-radio-input" id="cbox3" type="radio" name="respuesta" value="3">
											   <span class="form-radio-sign">Respuesta 3</span>
											</label>
                       				 	</div>
    								</div>
    								<div class="card-body">
    									<img src="img/Triangulo.jpg">
    								</div>
    							</div>
    						</div>
                   			<div class="col-md-6">
    							<div class="card">
    								<div class="card-header">
                    		    		<div class="card-title">
                    		      			<label class="form-radio-label">
											   <input class="form-radio-input" id="cbox2" type="radio" name="respuesta" value="2">
											   <span class="form-radio-sign"><b>Respuesta 2</b></span>
											</label>
                    		    		</div>
    								</div>
    								<div class="card-body">
    									<img src="img/Circulo.jpg">
    								</div>
    							</div>
                    			<div class="card">
    								<div class="card-header">
                    		    		<div class="card-title">
                    		      			<label class="form-radio-label">
											   <input class="form-radio-input" id="cbox4" type="radio" name="respuesta" value="4">
											   <span class="form-radio-sign"><b>Respuesta 4</b></span>
											</label>
                    		    		</div>
    								</div>
    								<div class="card-body">
    									<img src="img/Rombo.jpg">
    								</div>
    							</div>
    						</div>
						</div>
					</div>

            		<script>
            		    $(document).ready(function() {
            		        $('input[type="radio"]').click(function() {
            		            var respuesta = $(this).val();
            		            var nick = '<?php echo $nick; ?>' //por ser string
            		            var idPreg = '<?php echo $idPreg; ?>'
            		            var codCuest = '<?php echo $codCuest; ?>'
            		            $.ajax({
            		                url: "guardarRespuesta.php",
            		                method: "POST",
            		                data: {
            		                    respuesta: respuesta, nick: nick, idPreg: idPreg, codCuest: codCuest
            		                }

            		            });

            		            //desactivando los demas radios despues de la primera respuesta
            		            toastr.success("¡Respuesta Registrada! Ahora espera a que todos respondan","Aviso!");
            		            $('#cbox1').attr("disabled", true);
            		            $('#cbox2').attr("disabled", true);
            		            $('#cbox3').attr("disabled", true);
            		            $('#cbox4').attr("disabled", true);
            		        });
            		    });
            		</script>
				</div>
			</div>
		</div>
	</div>
  	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-info-circle"></i>Ahtziri | Ayuda</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>Para responder únicamente selecciona el radio button de la opción que corresponda a la que tu consideres la respuesta correcta.</p>
					<p>
					<b>¡Rápido, se acaba el tiempo!</b></p>
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
<?php
ob_end_flush();
?>
