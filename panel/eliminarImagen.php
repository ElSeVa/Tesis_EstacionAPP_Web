<?php
include_once("../config.php");
if(isset($_POST["submitEliminar"])){
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $eliminadaImagen = Imagenes::eliminarImagen($id);
        if($eliminadaImagen){
            echo "verdadero <br>";
            header("Location:panel.php?seccion=garage&accion=editar&imagen=eliminada");
        }else{
            echo "falso <br>";
            header("Location:panel.php?seccion=garage&accion=editar&imagen=errorEliminar");
        }
        echo "paso de largo <br>";
    }else{    
        echo "nisiquiera hay id <br>";
        header("Location:panel.php?seccion=garage&accion=editar&imagen=noExisteID");
    }
    echo "paso de largo otravez <br>";
}else{
    echo "no funciona el submit <br>";
}



?>