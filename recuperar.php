<?php require_once("config.php");
if(isset($_POST["enviarCorreo"])){
    include_once('enviarEmail.php');
    setcookie("recuperarEmail",$email,time()+200);
    header("location:pageIndex?seccion=recuperar&accion=emailEnviado");
}
if(isset($_POST["cambiarContrasena"])){
    if($_COOKIE["recuperarEmail"]){
        $email = utf8_decode(urldecode($_COOKIE["recuperarEmail"]));
        $codigo = $_POST["codigo"];
        if(md5($email) === $codigo){
            $conductor = Conductor::traerPorEmail($email);
            $contrasena = Util::limpiar($_POST["contrasena"]);
            $confirmarContrasena = Util::limpiar($_POST["confirmarContrasena"]);
            if(!password_verify($contrasena, $conductor->getPassword())){
                setcookie("recuperarEmail",'',time()-200);
                if($contrasena === $confirmarContrasena){            
                    $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
                    $conductor->setPassword($contrasena);
                    $id = Conductor::actualizarConductor($conductor->toArray());
                    header("location:pageIndex?seccion=home&accion=contrasenaActualizada");
                }
            }else{
                header("location:pageIndex?seccion=recuperar&codigo=$codigo&accion=mismaContrasena");
            }        
        }
    }else{
        header("location:pageIndex?seccion=recuperar&accion=noHacking");
    }
}
?>

