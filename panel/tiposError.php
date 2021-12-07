<?php

if(isset($_GET["accion"])){
    $tipoError = $_GET["accion"];
    $alerta = "danger";
    switch($tipoError){
        case "PromoExitoso":
            $alerta = "success";
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                La promocion ha sido enviada.
            </div>
            <?php
            break;
        case "EliminandoPromo":
            $alerta = "info";
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                La promocion ha sido eliminada.
            </div>
            <?php
            break;
        case "ErrorEliminarPromo":
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                El conductor no tiene esta promocion.
            </div>
            <?php
            break;        
        case "ErrorExistePromo":
            $alerta = "warning";
            ?>
            <div class="mt-2 alert alert-<?= $alerta ?>" role="alert">
                El conductor ya tiene esta promocion.
            </div>
            <?php
            break;

    }
}

?>



