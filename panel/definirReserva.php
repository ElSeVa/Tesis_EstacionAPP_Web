<?php
include_once("../config.php");

$idReserva = $_POST["idReserva"];
if(isset($_POST["confirmarForm"])){
    $id = Reservacion::actualizarReserva(array("ID" => $idReserva, "Estado" => "Aceptado"));
    header("location:panel.php?seccion=reservaciones&pagina=1&accion=confirmado");
}

if(isset($_POST["denegarForm"])){
    $id = Reservacion::actualizarReserva(array("ID" => $idReserva, "Estado" => "Cancelado"));
    header("location:panel.php?seccion=reservaciones&pagina=1&accion=denegado");
}


?>