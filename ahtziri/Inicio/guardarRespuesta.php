<?php
//session_start();
include("../conexion.php");

//recuperadas de post
$resp = $_POST["respuesta"];
$nick = $_POST["nick"];//
$idPreg = $_POST["idPreg"];
$codCuest = $_POST["codCuest"];

//para hacer el insert
$correcta = 0;
$idJugador = 1; //recuperar con el nick
//el id de la pregunta

//recuperando $idJugador
$jugador =  $conexion->prepare("SELECT * FROM JUGADOR WHERE NIckName = ? AND CodigoCuestionario = ? LIMIT 1");
if (!$jugador->execute(array($nick,$codCuest))) {
  #error en la consulta anterior
  echo"Algo ha ido mal en la consulta a la base de datos";
}

while ($fila = $jugador->fetch(PDO::FETCH_BOTH)) {
  $idJugador = $fila[idJugador]; //guarda el id del jugador
}

//recuperacion de las respuestas de la pregunta

$respuestas =  $conexion->prepare("SELECT R.idRespuesta, R.Descripcion,R.No_Respuesta, R.Pregunta_Id,R.esCorrecta, P.idPregunta, P.Cuestionario_Id_Pregunta
    FROM RESPUESTA R INNER JOIN PREGUNTA P ON R.Pregunta_Id = P.idPregunta WHERE P.idPregunta = ?");

if (!$respuestas->execute(array($idPreg))) {
  #error en la consulta anterior
  echo"Algo ha ido mal en la consulta a la base de datos";
}
//temporales para almacenar respuestas recuperadas de preguntas si tiene si es porque no se le ha asignado nada
$r1 = "si";
$r2 = "si";
$r3 = "si";
$r4 = "si";

while ($fila2 = $respuestas->fetch(PDO::FETCH_BOTH)) {
  if ($r1 == "si") {
      $r1 = $fila2;
  } else if ($r2 == "si") {
      $r2 = $fila2;
  } else  if ($r3 === "si") {
      $r3 = $fila2;
  } else  if ($r4 == "si") {
      $r4 = $fila2;
  }
}

//verificando que respuesta eligio
if ($resp == 1) {
  // code...
  $correcta = $r1[esCorrecta];
} else if ($resp == 2) {
  // code...
  $correcta = $r2[esCorrecta];
} else if ($resp == 3) {
  // code...
  $correcta = $r3[esCorrecta];
} else {
  $correcta = $r4[esCorrecta];

}

//guardando respuesta jugador
$guardar = $conexion->prepare("INSERT INTO RESPUESTA_JUGADOR VALUES (null,?,?,?,?)");
if (!$guardar->execute(array($correcta,$idJugador,$idPreg,$codCuest))) {
  #error en la consulta anterior
  echo"Algo ha ido mal en la consulta a la base de datos";
}

?>
