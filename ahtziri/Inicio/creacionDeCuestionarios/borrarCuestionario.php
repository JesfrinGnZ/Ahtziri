<?php
  session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }
  //Las variables de cuestionario se hacen nula
  $_SESSION['nombreDeCuestionario']=null;
  $_SESSION['descripcionCuestionario']=null;
  include("../../conexion.php");
  //Buscando el ultimo cuestionario creado
  $idCuestionarioABorrar=$_SESSION['idCuestionario'];
  //Consultar pregunta por pregunta para eliminar sus respuestas
  echo "$idCuestionarioABorrar <br>";
  
  $consultaPreguntas=$conexion->prepare("SELECT idPregunta FROM PREGUNTA WHERE Cuestionario_Id_Pregunta=?");
  if (!$consultaPreguntas->execute(array($idCuestionarioABorrar))) {
    #error en la consulta anterior
    echo"Algo ha ido mal en la consulta a la base de datos";
  }
  
  while ($pregunta = $consultaPreguntas->fetch(PDO::FETCH_BOTH)) {
    echo $pregunta[idPregunta]."<br>";
    $idPreguntaABorrar=$pregunta[idPregunta];
  
    $consultaRespuestas=$conexion->prepare("SELECT idRespuesta FROM RESPUESTA WHERE Pregunta_Id=?");
    if (!$consultaRespuestas->execute(array($idPreguntaABorrar))) {
      #error en la consulta anterior
      echo"Algo ha ido mal en la consulta a la base de datos";
    }
    
    while ($respuesta = $consultaRespuestas->fetch(PDO::FETCH_BOTH)) {
      $respuestaABorrar=$respuesta[idRespuesta];
    
      $eliminacion1=$conexion->prepare("DELETE FROM RESPUESTA WHERE idRespuesta=?");
      if (!$eliminacion1->execute(array($respuestaABorrar))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
      }
    
      $eliminacion2=$conexion->prepare("DELETE FROM RESPUESTA WHERE idRespuesta=?");
      if (!$eliminacion2->execute(array($respuestaABorrar))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
      }
    }
    $eliminacion3=$conexion->prepare("DELETE FROM PREGUNTA WHERE idPregunta=?");
    if (!$eliminacion3->execute(array($idPreguntaABorrar))) {
      #error en la consulta anterior
      echo"Algo ha ido mal en la consulta a la base de datos";
    }
  }
  $eliminacion4=$conexion->prepare("DELETE FROM CUESTIONARIO WHERE idCuestionario=?");
    if (!$eliminacion4->execute(array($idCuestionarioABorrar))) {
      #error en la consulta anterior
      echo"Algo ha ido mal en la consulta a la base de datos";
    }
  header('Location:../index.php');
?>
