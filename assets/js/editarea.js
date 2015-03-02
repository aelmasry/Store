var geocoder;
var map;
var marker;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(lat, lng);
  var mapOptions = {
    zoom: zoom,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  marker= new google.maps.Marker({
      position: latlng,
      map: map,
      title: 'Hello World!'
  });
  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  });
  
}

function placeMarker(location) {
  if(marker != null){
            marker.setMap(null);
  }
   marker = new google.maps.Marker({
    position: location,
    draggable: true,
    map: map,
  });
  google.maps.event.addListener(marker,'click', function(event){
    console.log(marker);
  });
  lat = location.lat(),
  lng = location.lng()
  var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });

  infowindow.open(map,marker);
}
function codeAddress() {
  if(marker != null){
            marker.setMap(null);
  }

  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
       marker = new google.maps.Marker({
          map: map,
          draggable: true,
          position: results[0].geometry.location
      });
       google.maps.event.addListener(marker,'click', function(event){
        console.log(marker);
      });
      lat = results[0].geometry.location.k,
      lng = results[0].geometry.location.D
      console.log(results[0].geometry);
       var infowindow = new google.maps.InfoWindow({
       content: 'Latitude: ' + results[0].geometry.location.k + '<br>Longitude: ' + results[0].geometry.location.D
  });

  infowindow.open(map,marker);
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });

}
$("#form_id").submit(function(e) {
     $.ajax({
        type: "POST",
        url: "http://shop.loc/admin/areas/add_edit",
        async: false, 
        data: {
          lat: lat,
          lng: lng,
          zoom: map.getZoom(),
          ajax_true: true
        },
   });
    });
google.maps.event.addDomListener(window, 'load', initialize);