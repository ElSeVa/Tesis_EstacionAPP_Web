<?php session_start();
include_once("config.php");

$email = Util::limpiar($_POST["email"]);
$contrasena = Util::limpiar($_POST["contrasena"]);

if($email && $contrasena){
    $conductor = Conductor::traerPorEmail($email);
}else{
    header("location:pageIndex?seccion=login&accion=completar");
}

if($conductor && $conductor->validoPassword($contrasena)){
    $isPropietario = $conductor->getPropietario();
    $_SESSION["IDC"] = $conductor->getId();
    header("location:mapa?seccion=mapa&accion=exitoso");
}else{
    //print_r($conductor->toArray());
    header("location:pageIndex?seccion=login&accion=errorLogin");
}

if($isPropietario){
    $_SESSION["IDC"] = $conductor->getId();
    $garage = Garage::traerPorIDC($conductor->getId());
    $_SESSION["IDP"] = $garage->getId();
    header("location:panel/panel?seccion=garage&accion=exitoso");
}

if (!empty($_POST["mantener_sesion_abierta"])) {
    setcookie("COOKIE_INDEFINED_SESSION", TRUE, time()+31622400);
    setcookie("COOKIE_DATA_INDEFINED_SESSION_EMAIL", $email, time()+31622400);
    setcookie("COOKIE_DATA_INDEFINED_SESSION_CONTRASENA", $contrasena, time()+31622400);
    echo "Sesión abierta indefinidamente.<br/>";
} else {
	setcookie("COOKIE_CLOSE_NAVEGADOR", TRUE, 0) . "<br/>";
	echo "Sesión abierta hasta que cierre el navegador.<br/>";
}

/*
$conductor = Conductor::traerPorEmail($email);
$isPropietario = $conductor->getPropietario();
if($conductor && $conductor->validoPassword($contrasena)){
    header("location:index.html?accion=correct");
}else{
    header("location:index.html?accion=incorrect");
}




/*

if($isPropietario){
    header("location:index.html?accion=soyPropietario");
}else{
    header("location:index.html?accion=noSoyPropietario");
}



if($isPropietario == "0"){
    $_SESSION["ID"] = $conductor->getID();
    header("location:mapa.php?accion=exitoso");
}

if($conductor && $conductor->validoPassword($contrasena)){

    $_SESSION["IDP"] = $conductor->getID();
    header("location:panel.php?accion=exitoso");
}else{
    header("location:index.html?accion=error");
}


*/

?>