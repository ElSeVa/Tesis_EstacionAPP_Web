<?php include_once("../config.php");

$id = $_GET["id"];

$valor = Promos::eliminarPromos($id);

header("location:panel?seccion=promos&accion=$valor");

?>