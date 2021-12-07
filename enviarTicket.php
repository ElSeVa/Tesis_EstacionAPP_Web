<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
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

    $email = "potoxsdes@gmail.com"; //$conductor->getEmail()
    //$emailMd5 = md5($email);
    $title = "Envio de ticket";
    $body = "<html lang='en'>
    <head>
        <title>Document</title>
        <style>
            .box {
                width:300px;
                height:300px;
                position:fixed;
                margin-left:-150px; /* half of width */
                margin-top:-150px;  /* half of height */
                top:50%;
                left:50%;
            }
            table, th, td {
                border: 1px solid black;
            }
                
            th, td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <table class='box'>
            <th>
                <h3>". $garage->getNombre() ."</h3>
                <p>Fecha de reserva: <label for=''>". $reservacion->getFecha_inicio() ."</label></p>
                <p>Fecha de retiro: <label for=''>". $reservacion->getFecha_final() ."</label></p>
                <p>Tipo de vehiculo: <label for=''>". $conductor->getTipo_Vehiculo() ."</label></p>
                <p>Precio a pagar: $<label for=''>". $reservacion->getPrecio() ."</label></p>
                <p>Estado: <label for=''>". $reservacion->getEstado() ."</label></p>
            </th>
        </table>
    </body>
    </html>";
    

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
    
    //header("location:panel.php?seccion=reservaciones&pagina=1&accion=confirmado");
    //echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
?>