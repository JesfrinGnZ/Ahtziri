<?php

session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }
$NombreCuestionario = $_POST['nombreC'];
$DescripcionCuestionario = $_POST['descripcionC'];

if ($_SESSION['nombreDeCuestionario']==null and $_SESSION['descripcionCuestionario']==null) {
    //Se asignaran los valores y se creara el cuestionario
    $_SESSION['seCreoPregunta']=null;
    //echo "<a>SE CREO EL CUESTIONARIO</a><br>";
    include("../../conexion.php");
    $_SESSION['nombreDeCuestionario']=$NombreCuestionario;
    $_SESSION['descripcionCuestionario']=$DescripcionCuestionario;
    $User=$_SESSION['User'];
    
    $activo=0;
    $guardar = $conexion->prepare("INSERT INTO CUESTIONARIO(Nombre,Descripcion,Activo,Admin_User) VALUES (?,?,?,?)");
    if (!$guardar->execute(array($NombreCuestionario,$DescripcionCuestionario,$activo,$User))) {
      #error en la consulta anterior
      echo"Algo ha ido mal en la consulta a la base de datos";
    }

    $consultaUltimoCuestionario = mysqli_query($conexion,"SELECT * FROM CUESTIONARIO order by idCuestionario DESC LIMIT 1");

    $consultaUltimoCuestionario = $conexion->prepare("SELECT * FROM CUESTIONARIO order by idCuestionario DESC LIMIT 1");
    if (!$consultaUltimoCuestionario->execute(array())) {
      #error en la consulta anterior
      echo"Algo ha ido mal en la consulta a la base de datos";
    }
    while ($cuestionario = $consultaUltimoCuestionario->fetch(PDO::FETCH_BOTH)) {
      //echo $cuestionario['idCuestionario'];
      $_SESSION['idCuestionario']=$cuestionario[idCuestionario];
    }
}else{
  //echo "<a>Existio un error y el cuestionario no se pudo crear</a><br>";
}
?>
