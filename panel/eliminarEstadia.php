<?php include_once("../config.php");

$id = $_GET["id"];

$valor = Estadia::eliminarEstadia($id);

header("location:panel.php?seccion=modificar&accion=$valor");

?>