<h3>Bienvenido a EstacionAPP <?= $nombre ?></h3>
<div id="mySidenav" class="sidenav">
  <div class="boton">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  </div>
  <div class="bg-black p-4">
        <div class="container">
            <form class="text-center" action="" method="POST">
                <div class="d-grid gap-2 mx-auto">
                    <span class="h4 text-light">Vehiculo</span>
                    <select class="form-select mb-2" name="filtroVehiculo" id="filtroVehiculo">
                    <?php
                        foreach($estadiasVehiculos as $estadia){
                            $VPer=$estadia->getVehiculoPermitido();
                    ?>
                        <option value="<?= $estadia->getVehiculoPermitido() ?>"><?= $estadia->getVehiculoPermitido() ?></option>
                    <?php          
                    }
                    ?>
                    </select>
                    <span class="h4 text-light">Horario</span>
                    <select class="form-select mb-2" name="filtroHorario" id="filtroHorario">
                        <option <?= (isset($filtroHorario) && $filtroHorario == "Hora") ? "selected='selected'" : ""; ?> value="Hora">Hora</option>
                        <option <?= (isset($filtroHorario) && $filtroHorario == "Media Estadia") ? "selected='selected'" : ""; ?> value="Media Estadia">Media Estadia</option>
                        <option <?= (isset($filtroHorario) && $filtroHorario == "Estadia") ? "selected='selected'" : ""; ?> value="Estadia">Estadia</option>
                    </select>
                    <span class="h4 text-light">Precio</span>
                    <select class="form-select mb-2" name="filtroPrecio" id="filtroPrecio">
                        <option <?= (isset($filtroPrecio) && $filtroPrecio  == "DESC") ? "selected='selected'" : ""; ?> value="DESC">Alto</option>
                        <option <?= (isset($filtroPrecio) && $filtroPrecio == "ASC") ? "selected='selected'" : ""; ?> value="ASC">Bajo</option>
                    </select>
                    <button class="btn btn-outline-light mb-2" type="submit" name="submit">Filtar</button>
                </div>
            </form>
            <div class="d-grid gap-2 mx-auto">
                <a role="button" class="btn btn-outline-light" type="submit" href="mapa.php?seccion=mapa">Limpiar Filtro</a>
            </div>
        </div>
    </div>
</div>

<!-- Use any element to open the sidenav -->
<div class="mt-4" id="map"></div>