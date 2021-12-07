<?php
$iniciar = 0;
$articulos_x_paginas = 6;

if(isset($_GET['pagina'])){
    $iniciar = ($_GET['pagina']-1)*$articulos_x_paginas;
}

if(isset($_SESSION["IDP"])){
    $idGarage = $_SESSION["IDP"];
    $reservaciones = Reservacion::traerTodoPorID($_SESSION["IDP"]);
    $reservaciones_Limit = Reservacion::traerPorLimit($_SESSION["IDP"],$iniciar, 6);    
}

/*foreach($reservaciones as $reserva){
    $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
    $fecha_entrada = strtotime($reserva->getFecha_inicio());
    if($reserva->getID_Garage() == $idGarage){
        if($fecha_actual <= $fecha_entrada){
            $id = Reservacion::actualizarReserva(array("id" => $reserva->getId(), "Estado" => "Cancelado"));
        }
    }
}
*/
?>
<div class="tablon">

    <table class="table">

        <thead >
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Conductor</th>
                <th scope="col">Vehiculo</th>
                <th scope="col">Precio</th>
                <th scope="col">Horario</th>
                <th score="col">Cantidad</th>
                <th score="col">Fecha de inicio</th>
                <th score="col">Fecha de final</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
                <th scope="col"></th>

            </tr>
        </thead>
        <tbody>
            <tr></tr>
        <?php
            $c = 1;
            foreach($reservaciones_Limit as $reserva){

                $conductores = Conductor::traerPorId($reserva->getId_Conductor());
        ?>
            <tr>
                <th><?= $reserva->getId() ?></th>        
                <td><?= $conductores->getNombre()?></td>
                <td><?= $conductores->getTipo_Vehiculo()?></td>
                <td><?= $reserva->getPrecio()?></td>
                <td><?= $reserva->getEstadia()?></td>
                <td><?= $reserva->getCantidad()?></td>
                <td><?= $reserva->getFecha_inicio()?></td>        
                <td><?= $reserva->getFecha_final()?></td>
                <td><?= $reserva->getEstado()?></td>            
                <form  action="definirReserva.php" method="post">
                    <input type="hidden" name="idReserva" value="<?= $reserva->getId() ?>">
                    <td><button class="btn btn-primary" name="confirmarForm" type="submit">Confirmar</button></td>
                    <td><button class="btn btn-danger" name="denegarForm" type="submit">Denegar</button></td>                
                </form>

            </tr>

        <?php
            }
        ?>    
        </tbody>

    </table>
</div>


<nav class="d-flex justify-content-center" aria-label="Page navigation example">
  <ul class="pagination">
    <?php
        foreach($reservaciones as $reserva){
            $c++;
        }
        $paginas = $c / $articulos_x_paginas;
        $paginas = ceil($paginas);
    ?>
    <li class="page-item <?= $_GET['pagina']<=1 ? 'disabled' : '' ?>"><a class="page-link" href="?seccion=reservaciones&pagina=<?=$_GET['pagina']-1?>">Previous</a></li>
    <?php
 
        for($i=0;$i<$paginas;$i++){
    ?>
        <li class="page-item <?= $_GET['pagina']==$i+1 ? 'active' : '' ?>"><a class="page-link" href="?seccion=reservaciones&pagina=<?= $i+1 ?>"><?= $i+1?></a></li>
    <?php
        }
        
    ?>
    <li class="page-item <?= $_GET['pagina']>=$paginas ? 'disabled' : '' ?>"><a class="page-link" href="?seccion=reservaciones&pagina=<?=$_GET['pagina']+1?>">Next</a></li>
  </ul>
</nav>