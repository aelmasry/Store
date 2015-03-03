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
<script typ="text/javascript">
var lat = <?php echo json_encode($records->lat);?>;
var lng = <?php echo json_encode($records->lng);?>;
var zoom = parseInt(<?php echo json_encode($records->zoom);?>);
</script>
<script src="<?=base_url('assets/js/editarea.js')?>"></script>