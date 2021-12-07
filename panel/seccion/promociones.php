<?php
$frecuencias = Frecuencia::traerTodoPorFrecuencia($idGarage);
?>
<h2>Promociones</h2>
<label class="switch">
  <input type="checkbox" id="switch1" checked>
  <span class="slider round">
  </span>
</label>
<?php
include_once("./tiposError.php");
?>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo vehiculo</th>
                <th scope="col">Frecuencia</th>
                <th scope="col">Promo</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $c = 1;
            $promos = Promos::traerTodoId_Garage($idGarage);
            foreach($frecuencias as $frecuencia){
            ?>
                <tr>
                    <form action="agregarPromocion.php" method="post">
                        <th><?php echo $c++; ?></th>
                        <td><?= $frecuencia->getNombre(); ?></td>
                        <td><?= $frecuencia->getTipo_Vehiculo(); ?></td>
                        <td><?= $frecuencia->getFrecuencia(); ?></td>
                        <td>
                            <select class="form-select mb-2" name="idPromo">
                                <?php
                                foreach($promos as $promo){
                                ?>
                                    <option value="<?= $promo->getId() ?>"><?= Util::limpiar($promo->getTipo_Promo()) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <input type="hidden" name="idGarage" value="<?= $idGarage ?>">
                        <input type="hidden" name="idConductor" value="<?= $frecuencia->getId() ?>">
                        <td><input name="darPromo" class="btn btn-primary" type="submit" value="Dar promo"></td>
                        <td><input name="quitarPromo" class="btn btn-danger" type="submit" value="Quitar promo"></td>
                    </form>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
            </tr>
        </tfoot>
    </table>
</div>