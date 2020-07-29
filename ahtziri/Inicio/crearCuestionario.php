<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maxium-scale=1.0, minium-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
  </head>
  <body background="img/fondo 1.png">
    <div class="container">
      <form action="creacionDePreguntas.php" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1">Nombre de cuestionario</label>
          <input type="text" name ="nombreDeCuestionario"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese nombre de cuestionario">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Descripcion</label>
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Descripcion">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <footer>
  		<div class="container">
  			<center> <h5> Copyright &copy;</h5> </center>
  		</div>
  	</footer>
  </body>
</html>
