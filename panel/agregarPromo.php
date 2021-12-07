<?php include_once("../config.php");
$tipo_promos = $_POST["tipo_promo"];
$descripcion = $_POST["descripcion"];
$tipo_promos = Util::limpiar($tipo_promos);
$descripcion = Util::limpiar($descripcion);
$idGarage = $_POST["idGarage"];
$arrayPromos = new Promos($tipo_promos,$descripcion,$idGarage);
//$arrayEstadia = Util::completarArrayEstadia($precio,$horario,$vehiculoPermitido,$idGarage);
$promos = Promos::traerTodoId_Garage($idGarage);
if($tipo_promos && $descripcion){
    foreach($promos as $promo){
        if($promo->getTipo_Promo() == $tipo_promos){
            header("location:panel?seccion=promos&accion=ErrorTipoPromosRepetido");
            die;
        }
    }
    $id = Promos::insertarPromos($arrayPromos->toArray());
    header("location:panel?seccion=promos&accion=enviado");
}else{
    header("location:panel?seccion=promos&accion=completar");
}




?>