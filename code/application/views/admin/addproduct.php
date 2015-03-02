<div class="col-md-9" style="margin-top: 23px !important;">
    <h4 class="sub-header">Add Product</h4>
    <form role="form" action="<?=base_url('admin/products/add_edit/')?>" class="add_form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
        </div>
        <div class="error"><?php echo form_error('name'); ?></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo set_value('title'); ?>" >
        </div>
        <div class="error"><?php echo form_error('title'); ?></div>
         <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo set_value('price'); ?>" >
        </div>
        <div class="error"><?php echo form_error('price'); ?></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" class="form-control" name="userfile" />
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <select class="" name="category">
                <?php foreach ($records as $value): ?>
                    <option value="<?=$value->id?>"><?=$value->name?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Area</label>
            <select class="" name="area">
                <?php foreach ($areas as $value): ?>
                    <option value="<?=$value->id?>"><?=$value->name?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea class="form-control" id="description" name="description" value="<?php echo set_value('description'); ?>"></textarea>
        </div>
        <div class="error"><?php echo form_error('description'); ?></div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Add">
        </div>
    </form>
</div>