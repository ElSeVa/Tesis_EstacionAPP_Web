<?php include_once("../config.php");

if(isset($_POST["darPromo"])){
    $idGarage = $_POST["idGarage"];
    $idConductor = $_POST["idConductor"];
    $idPromo = $_POST["idPromo"];
    
    $prom = Promociones::traerTodo();
    
    foreach($prom as $p){
        if($p->getId_Promo() == $idPromo){
            if($p->getId_Conductor() == $idConductor && $p->getId_Garage() == $idGarage){
                echo "Exite la promo";
                header("location:panel?seccion=promociones&accion=ErrorExistePromo");
                die;
            }
        }
    }
    
    if($idConductor && $idGarage && $idPromo){
        $promociones = new Promociones($idConductor,$idPromo,$idGarage);
        $id = Promociones::insertarPromociones($promociones->toArray());
        echo "id: " . $id;
        header("location:panel?seccion=promociones&accion=PromoExitoso");
        die;
    }
    
    echo " | idGarage: " . $_POST["idGarage"];
    echo " | idConductor: " . $_POST["idConductor"];
    echo " | idPromo: " . $_POST["idPromo"];
}

if(isset($_POST["quitarPromo"])){
    $idGarage = $_POST["idGarage"];
    $idConductor = $_POST["idConductor"];
    $idPromo = $_POST["idPromo"];

    $prom = Promociones::traerTodo();
    
    foreach($prom as $p){
        if($p->getId_Conductor() == $idConductor && $p->getId_Garage() == $idGarage && $p->getId_Promo() == $idPromo){
            $boolean = Promociones::eliminarPromociones($p->getId());
            if($boolean){
                header("location:panel?seccion=promociones&accion=EliminandoPromo");
                echo "Eliminado con exito   ";
                die;
            }            
        }
    }
}
header("location:panel?seccion=promociones&accion=ErrorEliminarPromo");
echo "Error en eliminar promo";




?>