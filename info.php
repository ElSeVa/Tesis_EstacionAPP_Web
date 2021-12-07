<?php
    foreach($garages as $garage){
        $estadias = Estadia::traerTodoPorFiltro($garage->getId());
        foreach($estadias as $estadia){
            if(isset($filtroVehiculo) && $estadia->getVehiculoPermitido() == $filtroVehiculo->getVehiculoPermitido()){
?>
<div id="info-extra-<?=$garage->getId()?>" class="d-flex mt-3 flex-column">
    <span class="lead"><strong><?= $garage->getNombre() ?></strong></span>
    <span class="lead mx-2"><?= $garage->getDireccion() ?>, <?= $garage->getDisponibilidad()?></span>
    <span class="lead"><?= $garage->getTelefono()?></span>
    <div class="mx-2">
        <span class="py-1 lead"><strong>Vehiculos permitidos:</strong></span>
        
        <div class="d-inline-flex">
        
<?php
                foreach($estadias as $estadia){
                    if($estadia->getId_Garage() == $garage->getId()){
?>
            <div class="p-1 bd-highlight"><span class="lead"><?= $estadia->getVehiculoPermitido() ?></span></div>
<?php
                    }
                }
?>
        </div>
        <div class="d-block mb-3">
            
<?php
        if( isset($_POST['submit']) ){
            $vehiculoFiltro = $_POST["filtroVehiculo"];
            $filtros = Estadia::filtrar($filtroHorario, $vehiculoFiltro, $filtroPrecio);
            if (is_array($filtros) || is_object($filtros)){
                foreach($filtros as $f){
                    if($garage->getId() == $f->getId_Garage()){
?>
            <span class="py-1 lead"><strong>Precio de <?= $f->getHorario()?>:</strong></span>            
            <span class="py-1 lead">$<?= $f->getPrecio() ?></span>
<?php           
                    }
                }
            }
        }
?>  
        </div>
    </div>
    <a id="button-form" type="button" class="btn btn-primary w-50 mx-auto" href="mapa.php?seccion=comentarios&id=<?= $garage->getID() ?>">Ver Comentarios</a>
</div>
<?php
            }
        }
    }
?>



