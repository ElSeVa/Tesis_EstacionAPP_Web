<?php
$tipo_promos = "";
$descripcion = "";
$metodo = "agregar";
if(isset($_GET["accion"])){
    $accion = $_GET["accion"];
    if($accion == "editar"){
        $metodo = "editar";
    }
}

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $editar = Promos::traerPorId($id);
    if($editar){
        $tipo_promos = $editar->getTipo_Promo();
        $descripcion = $editar->getDescripcion();        
    }
}
?>
<h2>Promos</h2>
<label class="switch">
  <input type="checkbox" id="switch">
  <span class="slider round">
  </span>
</label>
<?php
include_once("./tiposErrorPromos.php")
?>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Tipo de promo</th>
                <th scope="col">Descripcion</th>     
                <th></th>           
                <th></th>           
            </tr>
        </thead>
        <tbody>
            <?php
            $promos = Promos::traerTodoId_Garage($idGarage);
            $c = 1;
            foreach($promos as $promo){
                $idPromo = $promo->getID();
                $idPromo = Util::limpiar($idPromo);
            ?>
            <tr>
                <th><?php echo $c++; ?></th>
                <td><?= Util::limpiar($promo->getTipo_Promo()); ?></td>
                <td><?= Util::limpiar($promo->getDescripcion()); ?></td>
                <td><a class="btn btn-primary" role="button" href="panel.php?seccion=promos&accion=editar&id=<?= $idPromo ?>">editar</a></td>
                <td><a class="btn btn-danger" role="button" href="eliminarPromo.php?id=<?= $idPromo ?>">eliminar</a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <form action="<?= $metodo ?>Promo.php" method="POST">
                    <th>°</th>
                    <td><input class="form-control" placeholder="Ingrese el tipo de promocion" type="text" name="tipo_promo" value="<?= $tipo_promos ?>"></td>
                    <td><input class="form-control" placeholder="Ingrese una descripcion" type="text" name="descripcion" value="<?= $descripcion ?>"></td>
                    <td><input class="btn btn-outline-dark" type="submit" value="<?= $metodo ?> Enviar Datos"></td>
                    <input type="hidden" name="idGarage" value="<?= $idGarage ?>">
                    <input type="hidden" name="id" value="<?= $active = (isset($_GET["id"])) ?  $_GET["id"] : "" ?>">
                    <td></td>
                </form>
            </tr>
        </tfoot>
    </table>
</div>