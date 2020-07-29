<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ahtziri | Registro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="shortcut icon" type="image/x-icon" href="Imagenes/icon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsLogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsLogin/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsLogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsLogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsLogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="assetsLogin/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assetsLogin/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="datos.php" method="post">
					<span class="login100-form-title">
						¿Nuevo por aquí?
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Ingresa tu nombre completo">
						<input class="input100" type="text" name="N" placeholder="Tu nombre completo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-check-circle" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingresa un nombre de Usuario">
						<input class="input100" type="text" name="U" placeholder="Nuevo nombre de Usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingresa un email: ejemplo@correo.com">
						<input class="input100" type="text" name="E" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingresa una Contraseña">
						<input class="input100" type="password" name="P" placeholder="Nueva Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							¡Registrarme!
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="admins.php">
							¿Ya tienes una cuenta?
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
					<div class="text-center">
						<a class="txt2" href="index.php">
							Regresar al Inicio
							<i class="fa fa-reply m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="assetsLogin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assetsLogin/vendor/bootstrap/js/popper.js"></script>
	<script src="assetsLogin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assetsLogin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assetsLogin/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assetsLogin/js/main.js"></script>

</body>
</html>
