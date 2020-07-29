<?php
// Datos de la base de datos
session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }

include("../conexion.php");

//consulta para ver el nickname de los jugadores sin traslapar otros examenes;
$codigo=$_SESSION['esperandoConexion'];
$idCue=$_SESSION['idCuest1'];
$nombreCuest=$_SESSION['nameCuest'];

$resultadoNick = $conexion->prepare("SELECT JUGADOR.NickName FROM JUGADOR INNER JOIN CUESTIONARIO_REALIZADO WHERE
  JUGADOR.CodigoCuestionario=CUESTIONARIO_REALIZADO.CodigoGenerado AND JUGADOR.CodigoCuestionario = ? ORDER BY JUGADOR.NickName;");

if (!$resultadoNick->execute(array($codigo))) {
  #error en la consulta anterior
  echo"Algo ha ido mal en la consulta a la base de datos";
}
//consulta para el conteo de cuantos jugadores hay
$resultadoNJugadores = $conexion->prepare("SELECT COUNT(CodigoCuestionario) AS Numero_Jugadores FROM JUGADOR WHERE CodigoCuestionario =?");
if (!$resultadoNJugadores->execute(array($codigo))) {
  #error en la consulta anterior
  echo"Algo ha ido mal en la consulta a la base de datos";
}
//resultado de cuantos jugadores hay conectados
echo "
<div class=\"row row-card-no-pd\">
  <div class=\"col-md-6\">
    <div class=\"card\">
      <div class=\"card-body\">
        <p class=\"fw-bold mt-1\"><i class=\"la la-users\"></i> Personas Ingresadas:</p>
        <h3><b>";
        while ($extraido = $resultadoNJugadores->fetch(PDO::FETCH_BOTH)) {
          echo  $extraido[Numero_Jugadores];
        }
         echo "</b></h3>
      </div>
    </div>
    <hr>
    <div class=\"card\">
      <div class=\"card-body\">
        <h4><b>¿Ya están todos?</b></h4>
        <a href=\"verPreguntas.php?idCuest=". base64_encode($idCue) ."&clave=". base64_encode($codigo) ."\" class=\"btn btn-primary btn-round btn-lg\"><i class=\"la la-thumbs-o-up\"></i> ¡Iniciar!</a>
      </div>
    </div>
  </div>
  <div class=\"col-md-6\">
    <div class=\"card\">
      <div class=\"card-header \">
        <h4 class=\"card-title\">Usuarios registrados:</h4>
      </div>
      <div class=\"card-body\">
        <table class=\"table table-striped table-striped-bg-danger mt-4\">
          <thead>
            <tr>
              <th scope=\"col\">Nickname</th>
            </tr>
          </thead>
          <tbody>";
          while ($columna = $resultadoNick->fetch(PDO::FETCH_BOTH)) {
            echo "<tr>";
            echo "<td>" . $columna['NickName']  . "</td>";
            echo "</tr>";
          }
          echo "</tbody>
        </table>
      </div>
    </div>
  </div>
</div>";
 // Fin de la tabla

?>
