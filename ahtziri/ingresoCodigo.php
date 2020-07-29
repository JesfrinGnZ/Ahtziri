<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ahtziri | Administradores</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="shortcut icon" type="image/x-icon" href="Imagenes/icon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsRegister/css/util.css">
	<link rel="stylesheet" type="text/css" href="assetsRegister/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('assetsRegister/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="vistaEsperaJugador.php" method="POST">
					<span class="login100-form-logo">
						<img class="logo" src="./Imagenes/Logo.png"/ style="width:100%; height:55%;">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						¿Listo para responder?
					</span>

					<div class="wrap-input100 validate-input" data-validate="Ingresa el código de Cuestionario">
						<input class="input100" autocomplete="off" type="text" name="codigoCuestionario" placeholder="Código de Cuestionario">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingresa un nombre de Usuario">
						<input class="input100" autocomplete="off" type="text" name="nickname" placeholder="Nickname">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							¡Vamos!
						</button>
					</div>
					<div class="text-center p-t-90">
						<a class="txt1" href="index.php">
							<b>Regresar al Inicio</b>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="assetsRegister/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assetsRegister/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assetsRegister/vendor/bootstrap/js/popper.js"></script>
	<script src="assetsRegister/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assetsRegister/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assetsRegister/vendor/daterangepicker/moment.min.js"></script>
	<script src="assetsRegister/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assetsRegister/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assetsRegister/js/main.js"></script>

</body>
</html>
