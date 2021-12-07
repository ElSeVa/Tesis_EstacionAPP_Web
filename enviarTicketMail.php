<?php
$to = "potoxsdes@gmail.com";
$subject = "Envio de ticket";
$message = "<html lang='en'>
    <head>
        <title>Document</title>
        <style>
            .box {
                width:300px;
                height:300px;
                position:fixed;
                margin-left:-150px;
                margin-top:-150px;
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
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: sugerencia.estacionapp@gmail.com";
 
mail($to, $subject, $message, $headers);
header("location:panel?seccion=reservaciones&pagina=1&accion=confirmado");
?>