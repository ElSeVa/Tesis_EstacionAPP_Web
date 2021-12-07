<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Host de conexión SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'sugerencia.estacionapp@gmail.com';                 // Usuario SMTP
    $mail->Password = 'le0nard01996';                           // Password SMTP
    $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
    $mail->Port = 587;                                    // Puerto SMTP

    $email = Util::limpiar($_POST["email"]);
    //$emailEncriptado = password_hash($email, PASSWORD_DEFAULT);
    $emailMd5 = md5($email);
    $title = "Recuperar contraseña";
    $body = "Ingresa al link para crear una nueva contraseña\nhttp://localhost/tesis/pageIndex?seccion=recuperar&codigo=$emailMd5";
    

    #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
    #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
    #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
 
    $mail->setFrom('sugerencia.estacionapp@gmail.com');		// Mail del remitente
    $mail->addAddress($email);     // Mail del destinatario
 
    $mail->isHTML(true);
    $mail->Subject = $title;  // Asunto del mensaje
    $mail->Body    = $body;    // Contenido del mensaje (acepta HTML)
    $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
 
    $mail->send();
    //echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}



?>