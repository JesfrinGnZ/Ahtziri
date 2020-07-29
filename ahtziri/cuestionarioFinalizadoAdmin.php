<!DOCTYPE html>
<html lang="es" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Ahtziri | Fin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="Imagenes/icon.png"/>

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/supersized.css">
        <link rel="stylesheet" href="assets/css/style.css">

    </head>
    <body>
        <div class="page-container">
		        <img class="logo" src="Imagenes/Logo.png" style="width:30%; height:30%;">
            <h1>¡Se ha finalizado el cuestionario!</h1>
            <br>

            <form action="validacionEntradas.php" method="POST">
                <button  type="submit" name="login"> Descargar resultados </button>
            </form>
            <a href="index.php" style="color:#FFFFFF;">
       			 <button type="submit">Finalizar</button>
       		 </a>
           <br>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/js/supersized.3.2.7.min.js"></script>
        <script src="assets/js/supersized-init1.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
