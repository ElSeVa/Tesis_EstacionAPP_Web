var input = document.getElementById("inputDireccion");
var inputLat = document.getElementById("lat");
var inputLng = document.getElementById("lng");

$(function(){
    $("#inputDireccion").on("keyup", function(){
        L.esri.Geocoding.geocode().address(input.value).city("Buenos Aires").country("Argentina").run(function (err, results, response) {
        if (err) {
          console.log(err);
          return;
        }
        if(input.value!=""){
            $("#lat").attr("value",results['results'][0]['latlng']['lat']);
            $("#lng").attr("value",results['results'][0]['latlng']['lng']);
            console.log(results['results'][0]['latlng']['lat']);
            console.log(results['results'][0]['latlng']['lng']);
        }else{
          alert("por favor complete el campo Direccion");
          return;
        }
        console.log(results);
        });
    })
})