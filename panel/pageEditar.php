<form class="container" action="editarGarage.php" method="POST" enctype='multipart/form-data'>
    <p>Ingrese Nombre</p>
    <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>">
    <p>Ingrese Direccion</p>
    <input class="form-control" type="text" name="inputDireccion" id="inputDireccion" value="<?= $direccion?>">
    <p>Ingrese Telefono</p>
    <input class="form-control" type="text" name="telefono" value="<?= $telefono ?>">
    <label for="formFile" class="form-label">Elegir posicion</label>
    <select id="selector" class="form-select" name="selector">
        <option selected>Puede elegir la imagen principal o las secundarias</option>
        <option value="Principal">Principal</option>
        <option value="Secundario">Secundarias</option>        
    </select>
    <div class="mb-3">
        <label for="formFile" class="form-label">Agregar Imagen</label>        
        <input class="form-control" type="file" name="imagen" id="formFile">
    </div>
    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">
    <input type="hidden" name="idGarage" value="<?= $idGarage ?>">
    <br>
    <br>
    <input type="submit" name="submit" value="Enviar Datos">
</form>

<div class="m-3 d-flex flex-wrap justify-content-evenly align-items-start">
<?php
    foreach($imagenes as $img){
        if($img->getID_Garage() == $idGarage){
            ?>

    <div class="card" style="width: 18rem;">
        <div class="d-flex">
            <p class="ms-3">Eliminar foto</p>
            <form class="ms-auto" action="eliminarImagen.php" method="post">
                <input type="hidden" name="id" value="<?= $img->getID() ?>">
                <button type="submit" name="submitEliminar" class="btn-close" aria-label="Close"></button>
            </form>
        </div>
        <img src="data:image/jpeg;base64,<?= $img->getImagen() ?>" class="card-img-bottom" alt="...">
    </div>

            <?php
        }
    }
?>
</div>