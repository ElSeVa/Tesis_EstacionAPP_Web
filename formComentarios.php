<?php session_start();
require_once("config.php");
$idConductor = $_SESSION["IDC"];
$idGarage = $_POST["idGarage"];
$comentario = $_POST["comentario"];
$valoracion = $_POST["estrellas"];

$resena = new Resena($idConductor,$comentario,$valoracion,$idGarage);
$id = Resena::insertarResena($resena->toArray());
header("location:mapa.php?seccion=comentarios&id=$idGarage");

?>