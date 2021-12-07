<?php

if(isset($_GET["accion"])){
    $tipoError = $_GET["accion"];
    $alerta = "danger";
    switch($tipoError){
        case "enviado":
            $alerta = "success";
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                La promo fue agregado con exitos.
            </div>
            <?php
            break;
        case "completar":
            $alerta = "warning";
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                La complete los campos necesario de la promo.
            </div>
            <?php
            break;
        case "editado":
            $alerta = "success";
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                La promo fue editado con exitos.
            </div>
            <?php
            break;
        case "1":
            $alerta = "info";
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                La promo ha sido eliminada.
            </div>
            <?php
            break;         
        case "ErrorTipoPromosRepetido":
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                El tipo de promo esta repetido.
            </div>
            <?php
            break;        
    }
}

?>