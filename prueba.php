<?php include_once("config.php");

$garages = Garage::traerTodo();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Searching map services</title>
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />

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
  <style>
    body { margin:0; padding:0; }
    #map { height: 360px; }
  </style>
</head>
<body>
<form action="formPrueba.php" method="post">
  <p>direccion</p>
  <input type="text" id="direccion" name="direccion">
  <select name="provincia" id="provincia">
    <option>Ciudad Autonoma Buenos Aires</option>
    <option>Jujuy</option>
  </select>
  <p>coordenadas</p>
  <input id="lat" type="text" name="lat">
  <input id="lng" type="text" name="lng">
  <input id="resultado" type="text">
  <input type="submit">
</form>
<div id="map"></div>

<script type="text/javascript">
var array_js = new Array();
var input = document.getElementById("direccion");
var inputLat = document.getElementById("lat");
var inputLng = document.getElementById("lng");
var map = L.map('map');
var points = new Array();
var greenIcon = L.icon({
    iconUrl: 'leaf-green.png',
    //shadowUrl: 'leaf-shadow.png',

    iconSize:     [38, 95], // size of the icon
    //shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    //shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

$(function(){
    $("#direccion").change(function(){
        L.esri.Geocoding.geocode().address(input.value).city("Buenos Aires").country("Argentina").run(function (err, results, response) {
        if (err) {
          console.log(err);
          return;
        }
        
        //var lat = results['results'][0]['latlng']['lat'];
        //var lng = results['results'][0]['latlng']['lng'];
        //document.body.onload = addElement(lat, lng);
        //
        var container = L.DomUtil.get('map');
        if(container != null){
          container._leaflet_id = null;
        }

        if(input.value!=""){
            $("#lat").attr("value",results['results'][0]['latlng']['lat']);
            $("#lng").attr("value",results['results'][0]['latlng']['lng']);
            $('#resultado').attr("value","");
            var point = L.marker(results['results'][0]['latlng'],{icon: greenIcon}).addTo(map).bindPopup("I am a circle.");
            points.push(point);
            map.setView([inputLat.value, inputLng.value], 20);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        }else{
          $('#resultado').attr("value","por favor complete el campo");
          //map.off();
          for (i=0;i<points.length;i++) {
            map.removeLayer(points[i]);
          }  
          points=[];
          return;
            //$("#resultado").attr("value","Campo Vacío");
        }
        console.log(results);
        });
      

        
    })
})


/*
$(function(){
    $("#direccion").change(function(){
      
      var select = document.getElementById("provincia");
      var coords = input.value + ", " + select.value;
      if(input.value==""){
        coords = "";
      }
      array_js.push(coords);
      for(var i = 0; i < array_js.length; i++){
        L.esri.Geocoding.geocode().text(array_js[i]).run(function (err, results, response) {
        if (err) {
          console.log(err);
          return;
        }
        
        //var lat = results['results'][0]['latlng']['lat'];
        //var lng = results['results'][0]['latlng']['lng'];
        //document.body.onload = addElement(lat, lng);
        //
        var container = L.DomUtil.get('map');
        if(container != null){
          container._leaflet_id = null;
        }

        if(input.value!=""){
            $("#lat").attr("value",results['results'][0]['latlng']['lat']);
            $("#lng").attr("value",results['results'][0]['latlng']['lng']);
            
            var point = L.marker(results['results'][0]['latlng'],{icon: greenIcon}).addTo(map)
            
            points.push(point);
            map.setView([inputLat.value, inputLng.value], 20);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        }else{
            map.off();
            for (i=0;i<points.length;i++) {
              map.removeLayer(points[i]);
              
            }
            
            points=[];
            //$("#resultado").attr("value","Campo Vacío");
        }
        console.log(results);
        });
      }

        
    })
})
/**
 * 
 * 
var searchControl = L.esri.Geocoding.geosearch().addTo(map);


  var array_js = new Array();

  console.log(array_js);
  var map = L.map('map').setView([-34.637820001057264, -58.36016996687286], 20);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  //var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider();



for(var i = 0; i < array_js.length; i++){
L.esri.Geocoding.geocode().text(array_js[i]).run(function (err, results, response) {
  if (err) {
    console.log(err);
    return;
  }

  L.marker(results['results'][0]['latlng'],{icon: greenIcon}).addTo(map)
  console.log(results);
});
searchControl.on('results', function (data) {
  results.clearLayers();
  
  //var datosLanLng = data.results[0].latlng;
  //alert(datosLanLng);
  for (var i = data.results.length - 1; i >= 0; i--) {
    var datosLanLng = data.results[i].latlng;
    
    results.addLayer(L.marker(data.results[i].latlng,{icon: greenIcon}));
    //alert(datosLanLng);
  }
});

 * 
 * 
 * 
 */

  //L.marker([search], {icon: greenIcon}).addTo(map);
</script>

</body>
</html>