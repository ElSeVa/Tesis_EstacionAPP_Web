<?php include_once("../config.php");
$id = $_POST["id"];
$tipo_promos = Util::limpiar($_POST["tipo_promo"]);
$descripcion = Util::limpiar($_POST["descripcion"]);

$idGarage = $_POST["idGarage"];
$arrayPromos = new Promos($tipo_promos,$descripcion,$idGarage);
$arrayPromos->setId($id);

if($tipo_promos && $descripcion){
    $id = Promos::actualizarPromos($arrayPromos->toArray());
    header("location:panel?seccion=promos&accion=editado");
    die;
}else{
    header("location:panel?seccion=promos&accion=completar");
}
?>