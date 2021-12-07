<?php
include_once("../config.php");
$idReserva = $_POST["idReserva"];
date_default_timezone_set('America/Argentina/Buenos_Aires');

if(isset($_POST["denegarForm"])){
    $id = Reservacion::actualizarReserva(array("id" => $idReserva, "Estado" => "Cancelado"));
    header("location:panel?seccion=reservaciones&pagina=1&accion=denegado");
}

if(isset($_POST["confirmarForm"])){
    $hoy = date("Y/m/d H:i:s");
    $id = Reservacion::actualizarReserva(array("id" => $idReserva,"fecha_inicio" => $hoy, "Estado" => "Aceptado"));
    $reservacion = Reservacion::traerPorId($idReserva);
    $conductor = Conductor::traerPorId($reservacion->getId_Conductor());
    $garage = Garage::traerPorId($reservacion->getId_Garage());
    include_once("../enviarTicket.php");
    header("location:panel.php?seccion=reservaciones&pagina=1&accion=confirmado");
}


?>
