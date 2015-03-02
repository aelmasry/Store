<?php if ($this->session->userdata('id') != null): ?>
	<div class="container">
	<div class="row">
		<div class="col-md-10">
		<?php foreach ($records as  $value): ?>
			<div class="col-md-3 pull-left thumbnail">
				<a href="<?=base_url("frontend/products/details/$value->id")?>" ><img src="<?=base_url("assets/images/$value->image")?>" style="width:200px;height:200px;"></a>
				<a class="btn btn-success my_button"  href="<?=base_url("frontend/products/details/$value->id")?>">View details</a>
				<a class="btn btn-success my_button"  href="<?=base_url("frontend/cart/delete/$value->cart_id")?>">Delete from cart</a>
				<input class="btn btn-success my_button count" name="<?=$value->cart_id?>" value="<?=$value->count?>" style="width:100px;">
				<a href="<?=base_url("frontend/products/details/$value->id")?>" style="text-decoration: none;"><p class="product_desc"><?=$value->name?></p></a>
			</div>
		<?php endforeach ?>
		</div>
		<?php if ($records != null ): ?>
			<div class="col-md-2">
			  <a id="next_id" href="<?=base_url("paypal/next/")?>"><img class="paypal" src="<?=base_url("assets/images/next.jpg")?>"></a>
		    </div>
		<?php endif ?>
	</div>
</div>
<?php endif ?>