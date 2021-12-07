<?php session_start();
include_once("config.php");
$id = $_SESSION["IDC"];
$nombre = $_POST["garage"];
$direccion = $_POST["direccion"];
$disponibilidad = $_POST["disponibilidad"];
$telefono = $_POST["telefono"];
$lng = $_POST["lng"];
$lat = $_POST["lat"];

$garages = Garage::traerTodo();



if($nombre && $direccion && $disponibilidad){
    foreach($garages as $garage){
        if($garage->getDireccion() == $direccion){
            header("location: crearGarage.php?accion=errorDireccionOcupado");
            die;
        }
    }
    $id = Conductor::actualizarConductor(array("id" => $id, "Propietario" => 1));
    $array = Util::completarArrayGarage($nombre,$direccion,$disponibilidad,$telefono,$id);
    $garage = Garage::insertarGarage($array);
    $maps = Util::completarArrayMapa($lat,$lng,$garage);
    $maps = Mapa::agregarCoords($maps);
    $_SESSION["IDP"] = $garage;
    session_destroy();
    header("location: index.php?accion=GarageCompletoLogin");
}else{
    header("location: crearGarage.php?accion=errorCompletarGarage");
}
?>