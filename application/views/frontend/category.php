<div class="container">
	<div class="row">
		<?php foreach ($records as  $value): ?>
			<div class="col-md-3 thumbnail" style="margin-bottom: 20px;" >
			  <a href="<?=base_url("frontend/products/details/$value->id")?>"><img src="<?=base_url("assets/images/$value->image")?>" class="cart_img_id"></a>
			  <a href="<?=base_url("frontend/products/details/$value->id")?>" class="a_dec"><p class="product_desc"><?=$value->name?></p></a>
			  	<a class="btn btn-success my_button" href="<?=base_url("frontend/products/details/$value->id")?>">View details</a>
			</div>
		<?php endforeach ?>
	</div>
</div>