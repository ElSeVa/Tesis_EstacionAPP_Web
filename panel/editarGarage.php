<?php
include_once("../config.php");
if(isset($_POST['submit'])){
    $nombre = $_POST["nombre"];
    $direccion = $_POST["inputDireccion"];
    $telefono = $_POST["telefono"];
    $idGarage = $_POST["idGarage"];
    $selector = $_POST["selector"];
    if($selector == "Principal"){
        if(isset($_FILES['imagen']['name'])){
            $tipoArchivo = $_FILES['imagen']['type'];
            $nombreArchivo = $_FILES['imagen']['name'];
            $tamañoArchivo = $_FILES['imagen']['size'];
            $image = $_FILES['imagen']['tmp_name'];
            if($image){
                $imagen = base64_encode(file_get_contents($image));
                $imagenes = Imagenes::traerTodo();
                foreach($imagenes as $img){
                    if($img->getTipo() == $selector && $img->getID_Garage() == $idGarage){
                        $idImagen = $img->getID();
                    }
                }
                if($idImagen){
                    $imagenes = new Imagenes($selector,$imagen,$idGarage);
                    $imagenes->setID($idImagen);
                    $img = Imagenes::actualizarImagen($imagenes->toArray());
                    unlink($_FILES['imagen']['name']);
                }else{
                    $imagenes = new Imagenes($selector,$imagen,$idGarage);
                    $img = Imagenes::insertarImagen($imagenes->toArray());
                    unlink($_FILES['imagen']['name']);
                }
            }    
        }
    }

    if($selector == "Secundario"){
        if(isset($_FILES['imagenes']['name'])){
            $tipoArchivo = $_FILES['imagenes']['type'];
            $nombreArchivo = $_FILES['imagenes']['name'];
            $tamañoArchivo = $_FILES['imagenes']['size'];
            $fileImagenes = $_FILES['imagenes']['tmp_name'];
            if($fileImagenes){
                $imagenes1 = Imagenes::traerTodo();
                foreach($imagenes1 as $img){
                    if($img->getTipo() == $selector && $img->getID_Garage() == $idGarage){
                        $idImagen[] = $img->getID();
                    }
                }
                
                for ($i=0; $i < count($fileImagenes); $i++) { 
                    $imagen = base64_encode(file_get_contents($fileImagenes[$i]));

                    if(isset($idImagen)){
                        $imagenes = new Imagenes($selector,$imagen,$idGarage);
                        $imagenes->setID($idImagen[$i]);
                        echo "si hay otra idImagen";
                        echo print_r($idImagen);
                        $img = Imagenes::actualizarImagen($imagenes->toArray());
                        unset($idImagen[$i]);
                        if(empty($idImagen)){
                            unset($idImagen);
                        }
                        unlink($fileImagenes[$i]);
                        //unlink($_FILES['imagenes']['name']);
                    }else{
                        echo print_r($idImagen[$i]);
                        //echo '<img class="img-fluid rounded-circle" src="data:image/jpeg;base64,'. $imagen . '" alt="">';
                        $imagenes = new Imagenes($selector,$imagen,$idGarage);
                        //echo print_r($imagenes->toArray());
                        $img = Imagenes::insertarImagen($imagenes->toArray());                
                        unlink($fileImagenes[$i]);                        
                    }

                }
            }
        }
    }



    $array = array("ID" => $idGarage, "Nombre" => $nombre, "Direccion" => $direccion, "Telefono" => $telefono);

    if($nombre && $direccion){
        $lng = $_POST["lng"];
        $lat = $_POST["lat"];
        $garage = Garage::actualizarGarage($array);
        $mapa = Mapa::traerPorIDGarage($idGarage);

        if(!$lat && !$lng){
            $lat = $mapa->getLatitud();
            $lng = $mapa->getLongitud();
        }

        $maps = array("ID" => $mapa->getID(), "latitud" => $lat, "longitud" => $lng);
        $maps = Mapa::actualizarCoords($maps);
        header("location: panel.php?seccion=garage&accion=exitoso");
    }else{
        header("location: panel.php?seccion=garage&accion=errorCompletarGarage");
    }    
}
?>