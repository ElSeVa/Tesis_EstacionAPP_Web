<?php include_once("../config.php");
$id = $_POST["id"];
$precio = $_POST["precio"];
$horario = $_POST["horario"];
$vehiculoPermitido = $_POST["vehiculoPermitido"];
$idGarage = $_POST["idGarage"];
$arrayEstadia = new Estadia($precio,$horario,$vehiculoPermitido,$idGarage);
$arrayEstadia->setID($id);

$estadias = Estadia::traerTodoPorIdGarage($idGarage);
//$array = array("ID"=>"$id","Precio"=>"$precio","Horario"=>"$horario","VehiculoPermitido"=>"$vehiculoPermitido","ID_Garage"=>"$idGarage");

if($precio && $horario && $vehiculoPermitido){
    foreach($estadias as $estadia){
        if($estadia->getVehiculoPermitido() == $vehiculoPermitido){
            if($estadia->getHorario() == $horario){
                if($estadia->getPrecio() != $precio){
                    $id = Estadia::editarEstadia($arrayEstadia->toArray());
                    header("location:panel.php?seccion=modificar&accion=editado");
                    die;                    
                }else{
                    header("location:panel.php?seccion=modificar&accion=ErrorNingunaModificacion");
                    die;
                }
            }else{
                header("location:panel.php?seccion=modificar&accion=ErrorHorarioRepetido");
                die;
            }
        }
    }
}else{
    header("location:panel.php?seccion=modificar&accion=completar");
}
?>