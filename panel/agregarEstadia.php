<?php include_once("../config.php");
$precio = $_POST["precio"];
$horario = $_POST["horario"];
$vehiculoPermitido = $_POST["vehiculoPermitido"];
$idGarage = $_POST["idGarage"];
$arrayEstadia = new Estadia($precio,$horario,$vehiculoPermitido,$idGarage);
//$arrayEstadia = Util::completarArrayEstadia($precio,$horario,$vehiculoPermitido,$idGarage);

$estadias = Estadia::traerTodoPorIdGarage($idGarage);

if($precio && $horario && $vehiculoPermitido){
    foreach($estadias as $estadia){
        if($estadia->getVehiculoPermitido() == $vehiculoPermitido && $estadia->getHorario() == $horario){
           header("location:panel.php?seccion=modificar&accion=ErrorVehiculoRepetido");
           die;
        }
    }
    $id = Estadia::insertarEstadia($arrayEstadia->toArray());
    header("location:panel.php?seccion=modificar&accion=enviado");
}else{
    header("location:panel.php?seccion=modificar&accion=completar");
}




?>