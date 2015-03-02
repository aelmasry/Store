<div class="col-md-9" style="margin-top: 23px !important;">
    <h4 class="sub-header">Edit Product</h4>
    <form role="form" action="<?=base_url("admin/products/add_edit/$records->id?")?>" class="add_form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$records->name?>" >
        </div>
        <div class="error"><?php echo form_error('name'); ?></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$records->title?>">
        </div>
        <div class="error"><?php echo form_error('title'); ?></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?=$records->price?>">
        </div>
        <div class="error"><?php echo form_error('price'); ?></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" class="form-control" name="userfile" />
            <img src="<?=base_url("assets/images/$records->image")?>" style="width:100px;height:100px;">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <select class="" name="category">
                <?php foreach ($categories as $value): ?>
                    <?php if($value->id == $records->cat){
                        $selected = "selected";
                    }else{ $selected = ""; }            
                    ?>
                    <option value="<?=$value->id?>" <?=$selected?>><?=$value->name?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Area</label>
            <select class="" name="area">
                <?php foreach ($areas as $value): ?>
                    <?php if($value->id == $records->area){
                        $selected = "selected";
                    }else{ $selected = ""; }            
                    ?>
                    <option value="<?=$value->id?>" <?=$selected?>><?=$value->name?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea class="form-control" id="description" name="description"><?=$records->description?></textarea>
        </div>
        <div class="error"><?php echo form_error('description'); ?></div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Edit">
        </div>
    </form>
</div>