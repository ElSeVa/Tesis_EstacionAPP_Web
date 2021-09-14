<?php include_once("config.php");
$nombre = $_POST["nombre"];
$contrasena = $_POST["contrasena"];
$email = $_POST["email"];
$tipoVehiculo = $_POST["tipoVehiculo"];
$propietario = $_POST["propietario"];
$nombreGarage = $_POST["nombreGarage"];
$direccion = $_POST["direccion"];
$disponibilidad = $_POST["disponibilidad"];
$telefono = $_POST["telefono"];
$lng = $_POST["lng"];
$lat = $_POST["lat"];
$garages = Garage::traerTodo();

if($_POST["sendForm"] == null ){
    header("location:index.php?accion=error0");
}

if($nombre && $contrasena && $email && $tipoVehiculo){
    //$contrasena = Util::Hash($contrasena);
    $arrayConductor = new Conductor($nombre,$contrasena,$email,$tipoVehiculo,$propietario);
    //$array = Util::completarArrayConductor($nombre,$contrasena,$email,$tipoVehiculo,$propietario);
    if(!isset($_POST["propietario"]) && $_POST["propietario"] == ""){
        $conductor = Conductor::insertarConductor($arrayConductor->toArray());
        header("location: index.php?seccion=home&accion=exitosoConductor");
    }
}else{
    header("location: index.php?seccion=register&accion=errorCompletar");
}


if(isset($_POST["propietario"]) && $_POST["propietario"] == "1"){
    if($nombreGarage && $direccion && $disponibilidad){
        foreach($garages as $garage){
            if($garage->getDireccion() == $direccion){
                header("location: index.php?seccion=register&accion=errorDireccionOcupado");
                die;
            }
        }
        $conductor = Conductor::insertarConductor($arrayConductor->toArray());
        $arrayGarage = new Garage($nombreGarage,$direccion,$disponibilidad,$telefono,$conductor);
        //$array = Util::completarArrayGarage($garage,$direccion,$disponibilidad,$telefono,$conductor);
        $garage = Garage::insertarGarage($arrayGarage->toArray());
        $maps = new Mapa($lat,$lng,$garage);
        //$maps = Util::completarArrayMapa($lat,$lng,$garage);
        $maps = Mapa::agregarCoords($maps->toArray());
        header("location: index.php?seccion=home&accion=exitosoGarage");
    }else{
        header("location: index.php?seccion=register&accion=errorCompletarGarage");
    }
}





/*

if($_POST["sendForm"] != null){

    if($nombre && $contrasena && $email && $tipoVehiculo){
        $contrasena = Util::Hash($contrasena);
        $array = Util::completarArrayConductor($nombre,$contrasena,$email,$tipoVehiculo,$propietario);

        if(isset($_POST["propietario"]) && $_POST["propietario"] == "1"){
            $garage = $_POST["garage"];
            $direccion = $_POST["direccion"];
            $disponibilidad = $_POST["disponibilidad"];
            $telefono = $_POST["telefono"];

            if($garage && $direccion && $disponibilidad && $telefono){
                $conductor = Conductor::insertarConductor($array);
                $array = Util::completarArrayGarage($garage,$direccion,$disponibilidad,$telefono,$conductor);
                $garage = Garage::insertarGarage($array);
                header("location: index.html?accion=exitosoGarage");
            }else{
                header("location: index.html?accion=errorGarage");
            }

        }else{
            header("location: index.html?accion=errorCompletarGarage");
        }

        //$conductor = Conductor::insertarConductor($array);
        header("location: index.html?accion=exitosoConductor");

    }else{
        header("location: index.html?accion=errorCompletar");
    }

}






/*

if( $_POST["sendForm"] != null ){
    if($nombre){
        $contrasena = Util::Hash($contrasena);
        $array = Util::completarArray($nombre,$contrasena,$email,$tipoVehiculo,$propietario);
        if(isset($propietario)){
            header("location:index.html?accion=1");
        }else{
            header("location:index.html?accion=error1");
        }
        //$conductor = Conductor::insertarConductor($array);
        header("location:index.html?accion=0");
    }else{
        header("location:index.html?accion=error0");
    }
}else{
    header("location:index.html?accion=error");
}

*/




?>