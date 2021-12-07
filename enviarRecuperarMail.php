<?php
$subject = "Recuperar contraseña";
$email = $_POST["email"];
$emailMd5 = md5($email);
$message = "Ingresa al link para crear una nueva contraseña\nhttp://localhost/tesis/pageIndex?seccion=recuperar&codigo=$emailMd5";

//$headers = "From: sugerencia.estacionapp@gmail.com";
 
mail($email, $subject, $message);
//header("location:pageIndex?seccion=home&email=enviado")

?>