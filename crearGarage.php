<?php
if(!$_SESSION["IDC"]){
    header("location:index.php?accion=errorPagina");
}

if(isset($_SESSION["IDP"])){
    header("location:panel/panel.php?accion=errorGarage");
}

?>

<p>Volver al <a href="mapa.php?seccion=mapa">Atras</a> </p>
<main class="form-signin">
    <form action="agregarGarage.php" method="post">
        <p>Nombre de Garage</p>
        <input class="form-control" type="text" id="inputGarage" name="garage">
        <p>Direccion</p>
        <input class="form-control" type="text" id="inputDireccion" name="direccion">
        <p>Disponibilidad</p>
        <select class="form-select" id="inputDisponibilidad" name="disponibilidad">
            <option>Abierto</option>
            <option>Cerrado</option>
        </select>
        <p>Telefono</p>
        <input class="form-control" type="text" id="inputTelefono" name="telefono">
        <input type="hidden" id="lat" name="lat">
        <input type="hidden" id="lng" name="lng">
        <br>
        <br>
        <input type="submit" name="sendForm" value="Enviar">
    </form>
</main>