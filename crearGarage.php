<?php
if(!$_SESSION["IDC"]){
    header("location:pageIndex?accion=errorPagina");
}

if(isset($_SESSION["IDP"])){
    header("location:panel/panel?accion=errorGarage");
}

?>

<main class="form-signin">
    <h3 class="mb-3 fw-normal">Crear su garage</h3>
    <p>Volver al <a href="mapa.php?seccion=mapa">Atras</a> </p>

    <form class="was-validated" action="agregarGarage.php" method="post">
        <label for="inputGarage" class="visually-hidden">Nombre de Garage</label>
        <input class="form-control mb-2" type="text" id="inputGarage" name="garage" placeholder="Nombre de Garage" required="" autofocus="">
        <div class="invalid-feedback">
            Por favor ingrese un nombre de garage
        </div>
        <label for="inputDireccion" class="visually-hidden">Direccion</label>
        <input class="form-control mb-2" type="text" id="inputDireccion" name="direccion" placeholder="Direccion" required="" autofocus="">
        <div class="invalid-feedback">
            Por favor ingrese una direccion
        </div>    
        <select class="form-select mb-2" id="inputDisponibilidad" name="disponibilidad" placeholder="Disponibilidad">
            <option>Abierto</option>
            <option>Cerrado</option>
        </select>        
        <label for="inputTelefono" class="visually-hidden">Telefono</label>
        <input class="form-control" type="text" id="inputTelefono" name="telefono" placeholder="Telefono">
        <div class="valid-feedback mb-2">
            No es necesario que ingreses un telefono pero por las dudas tienes la opcion.
        </div>
        <label for="inputLatitud" class="visually-hidden">Latitud-Direccion</label>
        <input type="hidden" id="lat" name="lat">
        <label for="inputLongitud" class="visually-hidden">Longitud-Direccion</label>
        <input type="hidden" id="lng" name="lng">
        <br>
        <br>
        <input class="w-100 btn btn-lg btn-primary" type="submit" name="sendForm" value="Enviar">
    </form>
</main>