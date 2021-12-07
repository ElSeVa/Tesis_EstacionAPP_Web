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
                    if($img->getTipo() == $selector && $img->getId_Garage() == $idGarage){
                        $idImagen = $img->getId();
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

            if($fileImagenes && $tamañoArchivo < 100000){
                $imagenes1 = Imagenes::traerTodo();
                foreach($imagenes1 as $img){
                    if($img->getTipo() == $selector && $img->getId_Garage() == $idGarage){
                        $idImagen[] = $img->getId();
                    }
                }
                
                for ($i=0; $i < count($fileImagenes); $i++) { 
                    $imagen = base64_encode(file_get_contents($fileImagenes[$i]));

                    if(isset($idImagen)){
                        $imagenes = new Imagenes($selector,$imagen,$idGarage);
                        $imagenes->setId($idImagen[$i]);
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
            }else{
                $imagenes1 = Imagenes::traerTodo();
                foreach($imagenes1 as $img){
                    if($img->getTipo() == $selector && $img->getId_Garage() == $idGarage){
                        $idImagen[] = $img->getId();
                    }
                }
                
                for ($i=0; $i < count($fileImagenes); $i++) { 
                    $img = resize_image($fileImagenes[$i],320,240,$tipoArchivo[$i]);
                    imagejpeg($img, '../img/'.$nombreArchivo[$i]);
                    $imagen = base64_encode(file_get_contents('../img/'.$nombreArchivo[$i]));
                    unlink('../img/'.$nombreArchivo[$i]);
                    //$imagen = base64_encode(file_get_contents($fileImagenes[$i]));

                    if(isset($idImagen)){
                        $imagenes = new Imagenes($selector,$imagen,$idGarage);
                        $imagenes->setId($idImagen[$i]);
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
                //die;
            }
            //die;

        }
    }



    $array = array("id" => $idGarage, "nombre" => $nombre, "direccion" => $direccion, "telefono" => $telefono);

    if($nombre && $direccion){
        $lng = $_POST["lng"];
        $lat = $_POST["lat"];
        $garage = Garage::actualizarGarage($array);
        $mapa = Mapa::traerPorIDGarage($idGarage);

        if(!$lat && !$lng){
            $lat = $mapa->getLatitud();
            $lng = $mapa->getLongitud();
        }

        $maps = array("id" => $mapa->getId(), "latitud" => $lat, "longitud" => $lng);
        $maps = Mapa::actualizarCoords($maps);
        header("location: panel?seccion=garage&accion=exitoso");
    }else{
        header("location: panel?seccion=garage&accion=errorCompletarGarage");
    }    
}


function resize_image($file, $w, $h, $tipo, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    if($tipo == 'image/jpeg'){
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return $dst;
    }elseif($tipo == 'image/png'){
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return $dst;
    }
    
    return $dst;
}
?>