var map = L.map('map');
map.options.minZoom = 12;
map.locate();
function onLocationFound(e) {
    map.setView(e.latlng, 11);
    L.marker(e.latlng).addTo(map)
        .bindPopup("Esta es tu posicion");
    
}
function onLocationError(e) {
    alert(e.message);
}

map.on('locationerror', onLocationError);
map.on('locationfound', onLocationFound);

var greenIcon = L.icon({
    iconUrl: 'img/marker-icon-green.png',
    //shadowUrl: 'leaf-shadow.png',
    iconSize:     [20, 55], // size of the icon
    //shadowSize:   [50, 64], // size of the shadow
    //iconAnchor:   [75, 75], // point of the icon which will correspond to marker's location
    //shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var yellowIcon = L.icon({
    iconUrl: 'img/marker-icon-yellow.png',
    //shadowUrl: 'leaf-shadow.png',
    iconSize:     [20, 55], // size of the icon
    //shadowSize:   [50, 64], // size of the shadow
    //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    //shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var redIcon = L.icon({
    iconUrl: 'img/marker-icon-red.png',
    //shadowUrl: 'leaf-shadow.png',
    iconSize:     [20, 55], // size of the icon
    //shadowSize:   [50, 64], // size of the shadow
    //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    //shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var orangeIcon = L.icon({
    iconUrl: 'img/marker-icon-orange.png',
    //shadowUrl: 'leaf-shadow.png',
    iconSize:     [20, 55], // size of the icon
    //shadowSize:   [50, 64], // size of the shadow
    //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    //shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
,maxZoom: 18}).addTo(map);