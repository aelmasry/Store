<div class="container">
	<div class="row">
		<div class="col-md-4 ">
			<img class="thumbnail img-rounded" src="<?=base_url("assets/images/$records->image")?>" style="width: 300px;height:300px;">
		</div>
		<div class="col-md-6">
			<p><?=$records->name?></p>
			<p><?=$records->title?></p>
			<p><?=$records->description?></p>
			<span class="btn btn-info"><?=$records->price?> $</span>
			<input type="hidden" id="cart_id_value" value="<?=$records->id?>">
			<?php if ($this->session->userdata('id') != null): ?>
				<button class="btn btn-success my_button" style="margin: 0;" id="cart_button"  >Add to Cart</button>
			<?php endif ?>
		</div>
 <div id="map-product" style="width: 750px;height: 200px;margin-top: 20px;float: left;"></div>
	</div>
</div>
</div>
<div class="modal fade" id="myModaladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				Added to Cart
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="<?=base_url('assets/js/jquery-2.1.1.min.js')?>"></script>
<script type="text/javascript">
var area = <?php echo json_encode($records->area);?>;
var lat,lng,zoom;
$.ajax({
      type: "POST",
      url: "http://shop.loc/frontend/areas/get_areas_lat_lng",
      async: false, 
      data: {id:area},
        success: function(data){
        	var data_parse = JSON.parse(data);
        	lat = data_parse[0].lat;
        	lng = data_parse[0].lng;
        	zoom = parseInt(data_parse[0].zoom);
        }
});
function initialize_product_map() {
  var myLatlng = new google.maps.LatLng(lat,lng);
  var mapOptions = {
    zoom: zoom,
    center: myLatlng
  }
  var map_product = new google.maps.Map(document.getElementById('map-product'), mapOptions);

  var marker_product = new google.maps.Marker({
      position: myLatlng,
      map: map_product,
      title: 'Hello World!'
  });
}

google.maps.event.addDomListener(window, 'load', initialize_product_map);
</script>