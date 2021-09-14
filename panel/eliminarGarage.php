<?php session_start();
$mapa = Mapa::traerPorIDGarage($idGarage);
$boolean = Mapa::eliminarMapa($mapa->getID());
$estadias = Estadia::traerTodoPorIdGarage($idGarage);
foreach($estadias as $estadia){
    $boolean = Estadia::eliminarEstadia($estadia->getID());
}
$valor = Garage::eliminarGarage($idGarage);
$id = Conductor::actualizarConductor(array("ID" => $id, "Propietario" => 0));
session_destroy();
header("location:index.php?accion=exitosaEliminacion");
?>