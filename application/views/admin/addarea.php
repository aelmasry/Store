<div class="col-md-9" style="margin-top: 23px !important;">
	<h4 class="sub-header">Add Area</h4>
	<form role="form" action="" id="form_id" class="add_form" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
		</div>
		<div class="error"><?php echo form_error('name'); ?></div>
		<div id="panel">
			<input id="address" type="textbox" value="Sydney, NSW">
			<input type="button" value="Geocode" onclick="codeAddress()">
		</div>
		<div id="map-canvas" style="width:800px;height:200px;"></div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Save">
		</div>
	</form>
</div>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="<?=base_url('assets/js/jquery-2.1.1.min.js')?>"></script>
<script type="text/javascript">
var geocoder;
var map;
var marker;
var is_lat_lng;
var lat = 0;
var lng = 0;
   
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
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
    
      if(marker != null){
	        is_lat_lng = true;
      }else{
          is_lat_lng = false;
      }
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