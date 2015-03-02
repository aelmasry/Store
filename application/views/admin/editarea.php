<div class="col-md-9" style="margin-top: 23px !important;">
	<h4 class="sub-header">Edit Area</h4>
	<form role="form" id="form_id" action="<?=base_url("admin/areas/add_edit/$records->id")?>" class="add_form" method="POST" >
		<div class="form-group">
			<label for="exampleInputEmail1">Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?=$records->name?>" >
		</div>
		<div class="error"><?php echo form_error('name'); ?></div>
		<div class="form-group">
			<input type="hidden" name="product_id" value="<?=$records->id?>">
			<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Save">
		</div>
	</form>
	 <div id="panel">
      <input id="address" type="textbox" value="Sydney, NSW">
      <input type="button" value="Geocode" onclick="codeAddress()">
    </div>
	 <div id="map-canvas" style="width: 750px;height: 200px;margin-top: 20px;float: left;"></div>
</div>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="<?=base_url('assets/js/jquery-2.1.1.min.js')?>"></script>
<script type="text/javascript">
var lat = <?php echo json_encode($records->lat);?>;
var lng = <?php echo json_encode($records->lng);?>;
var zoom = parseInt(<?php echo json_encode($records->zoom);?>);
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
</script>