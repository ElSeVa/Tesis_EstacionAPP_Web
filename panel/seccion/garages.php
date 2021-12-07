<?php

$nombre = $garage->getNombre();
$direccion = $garage->getDireccion();
$disponibilidad = $garage->getDisponibilidad();
$telefono = $garage->getTelefono();
$imagenes = Imagenes::traerTodo();

if(isset($_GET["accion"])){
    $accion = $_GET["accion"];
    if($accion == "editar"){
        require_once("pageEditar.php");
    }else if($accion == "eliminar"){
        include_once("eliminarGarage.php");
    }
}
?>
<div class="p-5">
    <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
    <?php
    foreach($imagenes as $img){
        if($img->getTipo() == "Principal" && $img->getId_Garage() == $idGarage){
            ?>
        <div class="carousel-item active">
            <img class="img-fluid rounded-circle" src="data:image/jpeg;base64,<?= $img->getImagen() ?>" alt="">
        </div>
        <?php
        }
        if($img->getTipo() == "Secundario" && $img->getId_Garage() == $idGarage){
            ?>
        <div class="carousel-item">
            <img class="img-fluid rounded-circle" src="data:image/jpeg;base64,<?= $img->getImagen() ?>" alt="">
        </div>
        <?php

        }
    }
    ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

    <h2><?= $nombre ?></h2>
    <h4><?= $direccion ?></h4>
    <p><?= $disponibilidad ?></p>
    <p><?= $telefono ?></p>
    <a class="btn btn-primary" href="panel?seccion=garage&accion=editar">Editar Garage</a>
    <a class="btn btn-danger" href="panel?seccion=garage&accion=eliminar">Eliminar Garage</a>
</div>
