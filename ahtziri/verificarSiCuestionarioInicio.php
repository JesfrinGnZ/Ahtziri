<?php
session_start();
include("conexion.php");
$codCuestionarioJugado=$_SESSION['codCuesJugado'];

$activo=0;
$resultadoQuery=$conexion->prepare("SELECT * FROM CUESTIONARIO INNER JOIN CUESTIONARIO_REALIZADO WHERE CUESTIONARIO.idCuestionario=CUESTIONARIO_REALIZADO.Cuestionario_Id
AND CUESTIONARIO.Activo=? AND CUESTIONARIO_REALIZADO.CodigoGenerado=?");
if (!$resultadoQuery->execute(array($activo,$codCuestionarioJugado))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
}
if($resultadoQuery->rowCount()>0){
   ?>
   <script>
   window.location.href = "vistaLeePregunta.php";
   </script>
   <?php
}

?>
