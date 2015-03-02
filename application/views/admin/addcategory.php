<div class="col-md-9" style="margin-top: 23px !important;">
	<h4 class="sub-header">Add Category</h4>
	<form role="form" action="<?=base_url('admin/categories/add_edit/')?>" class="add_form" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
		</div>
		<div class="error"><?php echo form_error('name'); ?></div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Add">
		</div>
	</form>
</div>