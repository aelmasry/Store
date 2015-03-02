<div class="container">
	<div class="row">
		<?php foreach ($records as  $value): ?>
			<div class="col-md-3 pull-left thumbnail">
				<a href="<?=base_url("frontend/products/details/$value->id")?>" style="text-decoration: none;"><img src="<?=base_url("assets/images/$value->image")?>" style="width:200px;height:200px;"></a>
				<a class="btn btn-success my_button" style="margin-left: 100px;" href="<?=base_url("frontend/products/details/$value->id")?>">View details</a>
				<a href="<?=base_url("frontend/products/details/$value->id")?>" style="text-decoration: none;"><p class="product_desc"><?=$value->name?></p></a>
			</div>
		<?php endforeach ?>
	</div>
</div>