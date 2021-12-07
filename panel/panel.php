<?php session_start();
include_once("../config.php");
if(!$_SESSION["IDP"]){
    header("location:../pageIndex?accion=errorPagina");
}
$idc = $_SESSION["IDC"];
$idp = $_SESSION["IDP"];
$conductor = Conductor::traerPorId($idc);
$garage = Garage::traerPorId($idp);
$idGarage = $garage->getId();
$nombre = $conductor->getEmail();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
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
    <title>Document</title>
</head>
<body class="text-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar">
        <div class="container">
            <a class="navbar-brand" href="panel">Panel EstacionAPP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsToogler" aria-controls="navbarsToogler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsToogler">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $active = ($_GET["seccion"] == "garage") ? "active": "" ?>" aria-current="page" href="panel?seccion=garage">Garage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active = ($_GET["seccion"] == "promos" || $_GET["seccion"] == "promociones" ) ? "active": "" ?>" aria-current="page" href="panel?seccion=promos">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active = ($_GET["seccion"] == "modificar") ? "active": "" ?>" aria-current="page" href="panel?seccion=modificar">Estadia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active = ($_GET["seccion"] == "reservaciones") ? "active": "" ?>" aria-current="page" href="panel?seccion=reservaciones&pagina=1">Reservaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active = ($_GET["seccion"] == "mapa") ? "active": "" ?>" aria-current="page" href="../mapa?seccion=mapa">Mapa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Bienvenido al panel <?= $nombre ?></h1>

<?php
if(isset($_GET["seccion"])){
    $seccion = $_GET["seccion"];
    if($seccion == "modificar"){
        include_once("seccion/estadias.php");
    }elseif($seccion == "garage"){
        include_once("seccion/garages.php");
    }elseif($seccion == "reservaciones"){
        include_once("seccion/reservaciones.php");
    }elseif($seccion == "promos"){
        include_once("seccion/promos.php");
    }elseif($seccion == "promociones"){
        include_once("seccion/promociones.php");
    }
}


?>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.5.1/dist/esri-leaflet.js"
    integrity="sha512-q7X96AASUF0hol5Ih7AeZpRF6smJS55lcvy+GLWzJfZN+31/BQ8cgNx2FGF+IQSA4z2jHwB20vml+drmooqzzQ=="
    crossorigin=""></script>

    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
    integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
    crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
    <script src="../js/multiplesFotos.js"></script>
    <script src="../js/maps.js"></script>
    <script src="../js/javascript.js"></script>
    <!-- <script src="../js/cerrarSession.js"></script> -->
    <!-- Load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>