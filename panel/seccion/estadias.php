<?php

$precio = "";
$horario = "";
$vehiculo = "";
$metodo = "agregar";
if(isset($_GET["accion"])){
    $accion = $_GET["accion"];
    if($accion == "editar"){
        $metodo = "editar";
    }
}

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $editar = Estadia::traerPorId($id);
    if($editar){
        $precio = $editar->getPrecio();
        $horario = $editar->getHorario();
        $vehiculo = $editar->getVehiculoPermitido();
    }
}

    
?>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Precio</th>
                <th scope="col">Horario</th>
                <th scope="col">Vehiculo Permitido</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $estadias = Estadia::traerTodo();
                $c = 1;
                foreach($estadias as $estadia){
                    $idEstadia = $estadia->getID();
                    $idEstadia = Util::limpiar($idEstadia);
                    if($estadia->getID_Garage() == $idGarage){
            ?>
                        <tr>
                            <th><?php echo $c++; ?></th>
                            <td>$<?= Util::limpiar($estadia->getPrecio()); ?></td>
                            <td><?= Util::limpiar($estadia->getHorario()); ?></td>
                            <td><?= Util::limpiar($estadia->getVehiculoPermitido()); ?></td>
                            <td><a class="btn btn-primary" role="button" href="panel?seccion=modificar&accion=editar&id=<?= $idEstadia ?>">editar</a></td>
                            <td><a class="btn btn-danger" role="button" href="eliminarEstadia?id=<?= $idEstadia ?>">eliminar</a></td>
                        </tr>
            <?php
                    }
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <form action="<?= $metodo ?>Estadia.php" method="POST">
                    <th>°</th>
                    <td><input class="form-control" placeholder="Ingrese un precio" type="number" min="0" max="1000" name="precio" value=<?= $precio ?>></td>
                    <td>
                        <select class="form-select" name="horario">
                            <option <?= ($horario == "Hora") ? "selected='selected'" : ""; ?>>Hora</option>
                            <option <?= ($horario == "Media Estadia") ? "selected='selected'" : ""; ?>>Media Estadia</option>
                            <option <?= ($horario == "Estadia") ? "selected='selected'" : ""; ?>>Estadia</option>
                        </select>
                    </td>
                    <td><input class="form-control" placeholder="Ingrese un vehiculo" type="text" name="vehiculoPermitido" value=<?= Util::limpiar($vehiculo) ?>></td>
                    <td><input class="btn btn-outline-dark" type="submit" value="<?= $metodo ?> Enviar Datos"></td>
                    <input type="hidden" name="idGarage" value="<?= $idGarage ?>">
                    <input type="hidden" name="idConductor" value="<?= $idc ?>">
                    <input type="hidden" name="id" value="<?= $active = (isset($_GET["id"])) ?  $_GET["id"] : "" ?>">
                </form>
            </tr>
        </tfoot>
    </table>
</div>