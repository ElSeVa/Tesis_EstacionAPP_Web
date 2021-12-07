<?php

if($_POST["sendForm"] == null){
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $lng = $_POST["lng"];
    $lat = $_POST["lat"];
    $array = array("id" => $idGarage, "Nombre" => $nombre, "Direccion" => $direccion, "Telefono" => $telefono);
    if($nombre && $direccion){
        $garage = Garage::actualizarGarage($array);
        $maps = Util::completarArrayMapa($lat,$lng,$garage);
        $maps = Mapa::actualizarCoords($maps);
        //header("location: index.html?accion=exitosoGarage");
    }else{
        //header("location: index.html?accion=errorCompletarGarage");
    }    
}

?>