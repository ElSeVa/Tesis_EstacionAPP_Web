<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $garage = Garage::traerPorId($id);
    if($garage){
        $idGarage = $garage->getID();
        $nombre = $garage->getNombre();
        $direccion = $garage->getDireccion();
        $disponibilidad = $garage->getDisponibilidad();
        $telefono = $garage->getTelefono();
        $imagenes = Imagenes::traerTodoID_Garage($idGarage);

        $resenas = Resena::traerTodoOrderBYID($idGarage,'ID_Garage', 'DESC');
    }else{
        header("location:mapa.php?seccion=mapa&accion=noExiste");
    }
}else{
    header("location:mapa.php?seccion=mapa&accion=errorID");
}
?>

<div class="d-block">
    <?php
    if($imagenes){
    ?>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php
        foreach($imagenes as $imagen){           
            if($imagen->getTipo() == "Principal"){
        ?>
            <div class="carousel-item active">
                <img class="w-25 p-3 img-fluid rounded-circle" src="data:image/jpeg;base64,<?= $imagen->getImagen() ?>" alt="">
            </div>
        <?php                    
            }
            if($imagen->getTipo() == "Secundario"){
        ?>
            <div class="carousel-item">
                <img src="data:image/jpeg;base64,<?= $imagen->getImagen() ?>" class="w-25 p-3 img-fluid rounded-circle" alt="...">
            </div>
        <?php
            }
        }
        ?>
        </div>
    </div>
    <?php
    }
    ?>
</div>
<div class="text-center">
    <h4><?=$nombre?></h4>
    <div class="d-flex flex-column">
        <span class="lead"><?=$direccion?></span>
        <span><?=$telefono?></span>
        <span>Estado: <strong><?=$disponibilidad?></strong></span>
    </div>

    <p class="text-end user-select-none h1 comentario">
    <?php
        $puntos = Resena::calcularValoracion($idGarage);
        $c = 6;
        for ($i=0; $i < 5; $i++) { 
            $c--;
    ?>
        <input id="puntos<?= $i ?>" type="radio" value="<?= $c ?>" disabled <?=$check = ($puntos == $c) ? "checked" : ""?>>
        <label for="puntos<?= $i ?>">★</label>
    <?php
        }
    ?>    
    </p> 
</div>

<div class="text-center m-2">
    <form class="mb-5 p-4 border" action="formComentarios.php" method="post">
        <textarea class="mx-auto w-50 form-control" name="comentario" id="" rows="3"></textarea>
        <p class="text-end user-select-none h2 clasificacion">
            <input id="calificacion1" type="radio" name="estrellas" value="5" required>
            <label for="calificacion1">★</label>

            <input id="calificacion2" type="radio" name="estrellas" value="4" required>
            <label for="calificacion2">★</label>

            <input id="calificacion3" type="radio" name="estrellas" value="3" required>
            <label for="calificacion3">★</label>

            <input id="calificacion4" type="radio" name="estrellas" value="2" required>
            <label for="calificacion4">★</label>

            <input id="calificacion5" type="radio" name="estrellas" value="1" required>
            <label for="calificacion5">★</label>

        </p>
        <input type="hidden" name="idGarage" value="<?=$_GET["id"]?>">
        <button class="form-control w-50 mx-auto" type="submit">Enviar</button>
    </form>
</div>
<div class="text-start"> 
    <h3 class="text-center mb-3">Comentarios</h3>
    <div class="border border-3 shadow-sm">
    <?php
    foreach($resenas as $resena){
            $hash = md5($resena->getTexto());
            $usuario = Conductor::traerPorId($resena->getUsuario());
            $valoracion = $resena->getValoracion();

    ?>
    <div class="border shadow rounded-3 m-3 p-2">
        <h5><?= $usuario->getNombre() ?></h5>
        <p><?= $resena->getTexto() ?></p>
        <p class="text-end user-select-none h4 comentario">    
    <?php
                $c = 6;
                for ($i=0; $i < 5; $i++) {
                    $c--;
    ?>
                <input id="<?= $hash.$i ?>" type="radio" value="<?= $c ?>" disabled <?=$check = ($valoracion == $c) ? "checked" : ""?>>
                <label for="<?= $hash.$i ?>">★</label>
    <?php
                }
    ?>
        </p>
    </div>
    <?php

        }
    ?>
    </div>
</div>