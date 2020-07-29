<?php
  error_reporting(E_ALL ^ E_NOTICE);
  $codCuestionarioJugado=$_POST['codigoCuestionario'];
  $nickname=$_POST['nickname'];

  echo "$codCuestionarioJugado <br>";
  echo "$nickname<br>";

 ?>
<!--Vista de espera de jugadores -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ingreso de Jugadores</title>
    <style type="text/css">

      .content {
      	width:600px;
      	height:400px;
      	margin:0px auto;
      	text-align:center;
      	background-color:#ffffff;
      }

      .content img {
      	vertical-align:middle;
        horizontal-align:middle;
      }

    </style>
  </head>
  <body>

    <div class="content">
      <img src="Imagenes/cargando3.gif" width="200" height="200" />
      <img src="Imagenes/EsperaunMomento.png" width="580" height="150" />
      <h2>Mientras todos ingrean al cuestionario.</h2>
    </div>

  </body>
</html>
