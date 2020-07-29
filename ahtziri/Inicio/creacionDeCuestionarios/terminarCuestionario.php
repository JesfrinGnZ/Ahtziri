<?php

session_start();  if (!isset($_SESSION["logueado"])){ header("Location:../index.php"); exit(); }
//Las variables de cuestionario se hacen nula
$_SESSION['nombreDeCuestionario']=null;
$_SESSION['descripcionCuestionario']=null;
$_SESSION['idCuestionario']=null;

header('Location:../index.php');
 ?>
