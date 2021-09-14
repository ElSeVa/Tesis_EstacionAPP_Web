<?php session_start();
    include_once("config.php");
    if(!$_GET){
        header("location:mapa.php?seccion=mapa");
    }
    if(!$_SESSION["IDC"]){
        header("location:index.php?accion=errorPagina");
    }
    $id = $_SESSION["IDC"];
    $conductor = Conductor::traerPorId($id);
    $nombre = $conductor->getEmail();
    $garages = Garage::traerTodo();
    $mapas = Mapa::traerTodo();
    if(isset($_SESSION["IDP"])){
        $reservaciones = Reservacion::traerTodoPorID($_SESSION["IDP"]);
    }
    $estadiasVehiculos = Estadia::traerTodoGroupBy('VehiculoPermitido');
    if( isset($_POST['submit']) ){
        $filtroVehiculo = $_POST["filtroVehiculo"];
        $filtroHorario = $_POST["filtroHorario"];
        $filtroPrecio = $_POST["filtroPrecio"];
        $filtroVehiculo = Estadia::filtroPorVehiculo($filtroVehiculo);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet"  href="css/style.css"/>
    <!-- Load Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Load Leaflet from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>

    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">

    <link rel="stylesheet" href="js/leaflet-search-master/src/leaflet-search.css" />


    <title>Bienvenido</title>
</head>
<body class="text-center">

    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
            <div class="container">
                <span class="navbar-toggler-icon mx-2" onclick="openNav()"></span>
                <a class="navbar-brand" href="mapa.php">EstacionAPP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample07">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                        if(isset($_SESSION["IDP"])){
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $active = ($_GET["seccion"] == "garage") ? "active": "" ?>" aria-current="page" href="panel/panel.php?seccion=garage">Garage</a>
                        </li>
                    <?php
                        }
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $active = ($_GET["seccion"] == "mapa") ? "active": "" ?>" aria-current="page" href="mapa.php?seccion=mapa">Mapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div id="main">
            <?php
                if(isset($_GET["seccion"])){
                    $seccion = $_GET["seccion"];
                    if($seccion == "mapa"){
                        require_once("seccion/pageMapa.php");
                    }else if($seccion == "crearGarage"){
                        require_once("crearGarage.php");
                    }else if ($seccion == "comentarios"){
                        require_once("seccion/pageComentarios.php");
                    }
                }
            ?>
            <?php require_once("info.php"); ?>
        </div>
    </div>
    <!-- Load Leaflet from CDN -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.5.1/dist/esri-leaflet.js"
        integrity="sha512-q7X96AASUF0hol5Ih7AeZpRF6smJS55lcvy+GLWzJfZN+31/BQ8cgNx2FGF+IQSA4z2jHwB20vml+drmooqzzQ=="
        crossorigin=""></script>
    <!-- Load Esri Leaflet Geocoder from CDN -->
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
        integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
        crossorigin=""></script>
    <!-- Load Leaflet Search from CDN -->
    <script src="js/leaflet-search-master/src/leaflet-search.js"></script>
    <!-- Load JQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Load Push JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>

    <!-- Load sideNav JS -->
    <script src="js/sideNav.js" type="text/javascript"></script>
    <!-- Load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <?php
        if(isset($_GET["seccion"])){
            $seccion = $_GET["seccion"];
            if($seccion == "mapa"){
    ?>
    <!-- Load AgregarElementos JS-->
    <script src="js/agregarElementos.js"></script>
    <!-- Load gps JS -->
    <script src="js/gps.js"></script>
    
    <script type="text/javascript">
        map.zoomControl.setPosition('topright');

        var searchControl = L.esri.Geocoding.geosearch({placeholder:'Ingrese direccion, barrio',title:'Buscador',expanded:false}).addTo(map);
        
        var results = L.layerGroup().addTo(map);

        searchControl.on('results', function (data) {
        results.clearLayers();
            for (var i = data.results.length - 1; i >= 0; i--) {
                results.addLayer(L.marker(data.results[i].latlng));
            }
        });
        <?php
        foreach($mapas as $mapa){
            $lat = $mapa->getLatitud();
            $lng = $mapa->getLongitud();
            $garage = Garage::traerPorId($mapa->getID_Garage());
            $estadias = Estadia::traerTodoPorFiltro($garage->getID());
            
                foreach($estadias as $estadia){
                    if($estadia->getID_Garage() == $garage->getID()){
                        $vehiculos[] = $estadia->getVehiculoPermitido();
                    }
                    if(isset($filtroVehiculo) && $estadia->getVehiculoPermitido() == $filtroVehiculo->getVehiculoPermitido()){
                
                        if($garage->getDisponibilidad() != "Cerrado"){
        ?>
        var pop = L.marker(['<?= $lat ?>','<?= $lng ?>'],{icon: greenIcon}).addTo(map);
        pop.bindPopup('<b><?= $garage->getNombre() ?></b><br><?= $garage->getDireccion()?><br>Vehiculos: <?= $estadia->getVehiculoPermitido() ?>');
        var popup = pop.getPopup();
        pop.on('popupopen',function(e){
                if(popup.isOpen){
                    console.log("abierto");
                    var info_extra = document.getElementById("info-extra-<?=$garage->getID()?>");
                    if(!info_extra){
                        console.log("verifico el pop abierto");
                        if(verificar(popup, <?=$garage->getID()?>)){
                            buscarYllenar("strong_nombre","<?= $garage->getNombre() ?>");
                            buscarYllenar("direccion-disponibildad-span","<?= $garage->getDireccion()?>, <?= $garage->getDisponibilidad() ?>");
                            buscarYllenar("vehiculos-span","<?= implode(", ",$vehiculos) ?>");
                            crearElemento("vehiculo-strong",'strong','Vehiculos permitidos:',"vehiculo-span");
                            crearLink("button-form",'a','Ver Comentarios',"info-extra-<?=$garage->getID()?>","<?=$garage->getID()?>");
                            buscarYllenar("telefono-span","<?= $garage->getTelefono() != null ? $garage->getTelefono() : " " ?>");
                            buscarYllenar("precio-horario","Precio por <?= $estadia->getHorario() ?>: $");
                            buscarYllenar("precio-span","<?= $estadia->getPrecio()?>");
                        }
                    }
                }
            });
        pop.on('popupclose',function(e){
                if(popup.isOpen){
                    console.log("cerrado");
                    var info_extra = document.getElementById("info-extra-<?=$garage->getID()?>");
                    if(info_extra){
                        eliminarElemento("info-extra-<?=$garage->getID()?>");
                    }
                }
            });
        <?php           
                    }
                }
            }
                if(!isset($filtroVehiculo) && $garage->getDisponibilidad() != "Cerrado" && isset($vehiculos)){
        ?>
    var pop = new L.marker(['<?= $lat ?>','<?= $lng ?>'],{icon: greenIcon}).addTo(map);
            pop.bindPopup('<b><?= $garage->getNombre() ?></b><br><?= $garage->getDireccion()?><br>Vehiculos: <?= implode(", ",$vehiculos) ?>');
            var popup = pop.getPopup();
            pop.on('popupopen',function(e){
                if(popup.isOpen){
                    console.log("abierto");
                    if(verificar(popup, <?=$garage->getID()?>)){
                        console.log("verifico el pop abierto");
                        var info_extra = document.getElementById("info-extra-<?=$garage->getID()?>");
                        if(info_extra){
                            buscarYllenar("strong_nombre","<?= $garage->getNombre() ?>");
                            buscarYllenar("direccion-disponibildad-span","<?= $garage->getDireccion()?>, <?= $garage->getDisponibilidad() ?>");
                            buscarYllenar("vehiculos-span","<?= implode(", ",$vehiculos) ?>");
                            crearElemento("vehiculo-strong",'strong','Vehiculos permitidos:',"vehiculo-span");
                            crearLink("button-form",'a','Ver Comentarios',"info-extra-<?=$garage->getID()?>","<?=$garage->getID()?>");
                            buscarYllenar("telefono-span","<?= $garage->getTelefono() != null ? $garage->getTelefono() : " " ?>");
                            buscarYllenar("precio-horario","Precio por <?= $estadia->getHorario() ?>: $");
                            buscarYllenar("precio-span","<?= $estadia->getPrecio()?>");
                        }
                    }
                }
            });            
            pop.on('popupclose',function(e){
                if(popup.isOpen){
                    console.log("cerrado");
                    var info_extra = document.getElementById("info-extra-<?=$garage->getID()?>");
                    if(info_extra){
                        eliminarElemento("info-extra-<?=$garage->getID()?>");
                    }
                }
            });
            
        <?php       
                }
            unset($vehiculos);            
        }
        ?>

    </script>
        <?php
            }
        }
    ?>
</body>
<footer class="mt-3">
        <p class="mt-3 mb-3 text-muted">© Derechos de autor - Sebastian Gonzalez 2017–2021</p>
        <th>
            <tr>
                Tienes una propiedad? <a href="mapa.php?seccion=crearGarage">haz click aqui</a>
            </tr>
        </th>
</footer>
</html>