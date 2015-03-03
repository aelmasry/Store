<div class="col-md-9 add_div" >
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
		<div id="map-canvas"></div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Save">
		</div>
	</form>
</div>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="<?=base_url('assets/js/jquery-2.1.1.min.js')?>"></script>
<script src="<?=base_url('assets/js/addarea.js')?>"></script>
