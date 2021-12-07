<?php session_start();
$mapa = Mapa::traerPorIDGarage($idGarage);
$boolean = Mapa::eliminarMapa($mapa->getId());
$estadias = Estadia::traerTodoPorIdGarage($idGarage);
foreach($estadias as $estadia){
    $boolean = Estadia::eliminarEstadia($estadia->getId());
}
$valor = Garage::eliminarGarage($idGarage);
$id = Conductor::actualizarConductor(array("id" => $id, "Propietario" => 0));
session_destroy();
header("location:index?accion=exitosaEliminacion");
?>