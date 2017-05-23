var map = L.map('map').setView([45.951, 25.153], 7);

var cloudmade = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
});
// omnivore.kml('images/KML/RevElectrRom.kml').addTo(map);

// Adauga un layer specific
map.addLayer(cloudmade);


// VERSIUNEA CARE FUNCTIONEAZA PENTRU AFISARE - SE VA INLOCUI CU CE ESTE LA CLUSTERING DUPA REPARARE erori
// TODO: Verifica versiunile de leaflet
var popUp = function (feature, layer) {
    var out = [];
    if(feature.properties){
      for (key in feature.properties) {
        out.push(key+": "+feature.properties[key]);
      }
      layer.bindPopup(out.join("<br />"));
    }
  };

var jsonTest = new L.GeoJSON.AJAX("images/KML/RevElectrRomDOAJ.json",{onEachFeature:popUp}).addTo(map);

// ADAUGA modul de căutare
map.addControl( new L.Control.Search({layer: searchLayer}) );




// INCERCARE DE CLUSTERING. ESTE O PROBLEMA IN VERSIUNEA DE LEAFLET (t is undefined)
// var geoJsonLayer = new L.GeoJSON.AJAX("images/KML/RevElectrRomDOAJ.json");
// var geoJsonLayer = L.geoJson(geoJsonLayer, {
//   onEachFeature: function (feature, layer) {
//     var out = [];
//     if(feature.properties){
//       for (key in feature.properties) {
//         out.push(key+": "+feature.properties[key]);
//       }
//       layer.bindPopup(out.join("<br />"));
//     }
//   }
// });
//
// markers.addLayer(geoJsonLayer);
// map.addLayer(markers);
// map.fitBounds(markers.getBounds());



// function popUp(f,l){
//     var out = [];
//     if (f.properties){
//         for(key in f.properties){
//             out.push(key+": "+f.properties[key]);
//         }
//         l.bindPopup(out.join("<br />"));
//     }
// }
//
//
