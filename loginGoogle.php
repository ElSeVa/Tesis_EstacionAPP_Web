<?php session_start();
include_once("config.php");

$email = Util::limpiar($_POST["email"]);
$accessToken = $_POST["accessToken"];

if($email && $accessToken){
    $conductor = Conductor::traerPorEmail($email);
}else{    
    echo 301;
    //header("location:pageIndex?seccion=login&accion=completar");
}

if($conductor){
    $isPropietario = $conductor->getPropietario();
    $_SESSION["IDC"] = $conductor->getId();
    //$array = array("success"=>"201");
    echo 201;
    //header("location:mapa?seccion=mapa&accion=exitoso");
}else{
    echo 302;
    exit;
    //header("location:pageIndex?seccion=login&accion=errorLogin");
}

if($isPropietario){
    $_SESSION["IDC"] = $conductor->getId();
    $garage = Garage::traerPorIDC($conductor->getId());
    $_SESSION["IDP"] = $garage->getId();
    echo 202;
    //header("location:panel/panel?seccion=garage&accion=exitoso");
}


?>