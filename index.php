<?php
if (isset($_COOKIE['COOKIE_INDEFINED_SESSION'])) {
	if ($_COOKIE['COOKIE_INDEFINED_SESSION']) {
        include_once("config.php");
		$email_user = $_COOKIE['COOKIE_DATA_INDEFINED_SESSION']['email'];
		$contrasena_user = $_COOKIE['COOKIE_DATA_INDEFINED_SESSION']['contrasena'];
        $email = Util::limpiar($email_user);
        $contrasena = Util::limpiar($contrasena_user);
        $conductor = Conductor::traerPorEmail($email);
        if($conductor->getEmail() == $email){
            if($conductor->getPropietario() == 1){
                header("Location: panel/panel.php?seccion=garage"); //envias al usuario a home.php si se lo encontro en la BD!
            }else{
                header("Location: mapa.php?seccion=mapa"); //envias al usuario a home.php si se lo encontro en la BD!
            }        
        }
		//AQUI HACES LA QUERY PARA BUSCAR EN TU BD UN USUARIO Y SU PASSWORD CON LAS VARIABLES ANTERIORES
	}
}

if(!isset($_GET["seccion"])){
    header("Location: index.php?seccion=home");
}

$active = null;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <!-- Load Bootstrap CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!-- Load Leaflet from CDN -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

        <!-- Load Esri Leaflet from CDN -->
        <script src="https://unpkg.com/esri-leaflet@2.5.1/dist/esri-leaflet.js"
        integrity="sha512-q7X96AASUF0hol5Ih7AeZpRF6smJS55lcvy+GLWzJfZN+31/BQ8cgNx2FGF+IQSA4z2jHwB20vml+drmooqzzQ=="
        crossorigin=""></script>

        <!-- Load Esri Leaflet Geocoder from CDN -->
        <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">
        <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
        integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
        crossorigin=""></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <title>EstacionAPP</title>
    </head>
    <header >
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
            <div class="container">
                <a class="navbar-brand" href="index.php">EstacionAPP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample07">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= $active = ($_GET["seccion"] == "home") ? "active": "" ?>" aria-current="page" href="index.php?seccion=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active = ($_GET["seccion"] == "login") ? "active": "" ?>" href="index.php?seccion=login">Login/Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <body class="text-center">

        <?php
        
        if(!empty($_GET["accion"])){
            $accion = $_GET["accion"];
            if ($accion == "exitosoConductor"){
                include_once("seccion/404.php");
            } else if ($accion == "exitosoGarage"){
                include_once("seccion/404.php");
            } else if($accion == "errorLogin"){
                include_once("seccion/404.php");
            } else if ($accion == "errorCompletar"){
                include_once("seccion/404.php");
            } else if ($accion == "errorDireccionOcupado"){
                include_once("seccion/404.php");
            } else {}
        }

        if(!empty($_GET["seccion"])){
            $seccion = $_GET["seccion"];            
            if($seccion == "login"){
                include_once("seccion/pageLogin.php");
            } else if ($seccion == "register"){
                include_once("seccion/pageRegister.php");
            } else if($seccion == "home"){
                include_once("seccion/home.php");
            } else {
                include_once("seccion/404.php");
                include_once("seccion/home.php");
            }
        }else{
            include_once("seccion/home.php");
        }

        ?>
        

        <script src="js/maps.js"></script>
        <script type="text/javascript" src="js/javascript.js"></script>
        <!-- Load Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
    <footer>
        <p class="mt-5 mb-3 text-muted">© Derechos de autor - Sebastian Gonzalez 2017–2021</p>
    </footer>
</html>