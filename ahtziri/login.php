<?php
  /*inicio de sesion*/
	session_start();
	include("conexion.php");

  /* Recibiendo user y pass  */
	$user = $_POST['user'];
  $pass = $_POST['pass'];

  /*Ejecucion de query */
  $resultado = $conexion->prepare("SELECT * FROM ADMINISTRADOR WHERE User =?");
  
  if ($resultado->execute(array($user)) && $resultado->rowCount()) {
    /*obteniendo datos de consulta */
    $fila = $resultado->fetch(PDO::FETCH_BOTH);

    /*desencriptando pass */
    $pass_verif = password_verify($pass,$fila[Pass]);
    if ($pass_verif) {
      $_SESSION['logueado']="si";
      $_SESSION['User'] = $fila[User];
      $_SESSION['Nombre'] = $fila[Nombre];
      $_SESSION['Email'] = $fila[Email];
      $_SESSION['nombreDeCuestionario'] = null;
      $_SESSION['descripcionCuestionario'] = null;
      $_SESSION['idCuestionario']=null;

      /*Si los datos recibidos son correctos se redirecciona al inicio del administrador */
      header('Location:Inicio/index.php');

    }
   

  }

?>

 <!DOCTYPE html>
 <html lang="es" class="no-js">
     <head>
         <meta charset="utf-8">
         <title>Ahtziri | Error</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta name="description" content="">
         <meta name="author" content="">

         <!-- CSS -->
         <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
         <link rel="stylesheet" href="assets/css/reset.css">
         <link rel="stylesheet" href="assets/css/supersized.css">
         <link rel="stylesheet" href="assets/css/style.css">

         <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
         <!--[if lt IE 9]>
             <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
         <![endif]-->

     </head>
     <body>
         <div class="page-container">
 		      <img class="logo" src="Imagenes/Error.png" style="width:25%; height:25%;">
             <h1>Error de Credenciales</h1>
						 <div class="panel panel-default">
               ¡La información ingresada no es correcta! Por favor verifica tus datos, es posible
               que tengas activada la tecla de Mayúsculas o bien que haya ingresado datos erroneos.
             </div>
             <a href="admins.php" style="color:#FFFFFF;">
        			 <button type="submit">Regresar</button>
        		 </a>
         </div>

         <!-- Javascript -->
         <script src="assets/js/jquery-1.8.2.min.js"></script>
         <script src="assets/js/supersized.3.2.7.min.js"></script>
         <script src="assets/js/supersized-init0.js"></script>
         <script src="assets/js/scripts.js"></script>

     </body>

 </html>
