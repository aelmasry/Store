	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>
		<div class="bs-example">
			<section class="block">
			    <div id="myCarousel" class="carousel slide">
			        <div class="carousel-inner">
			            <div class="active item">
			                <img src="<?=base_url('assets/images/slider/1.jpg')?>" class="slider_img" alt="Slide1"  />
			            </div>
			            <div class="item">
			                <img src="<?=base_url('assets/images/slider/2.jpg')?>" class="slider_img" alt="Slide2"  />
			            </div>
			            <div class="item">
			                <img src="<?=base_url('assets/images/slider/3.jpg')?>" class="slider_img" alt="Slide3"  />
			            </div>
			            <div class="item">
			                <img src="<?=base_url('assets/images/slider/4.jpg')?>" class="slider_img" alt="Slide3"  />
			            </div>
			        </div>
			        <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>
			        <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>

			    </div>
			</section>
		</div>
		</div>
	</body>
	</html>
<div class="container">
	<div class="row" >
	<?php foreach ($records as  $value): ?>
		<div class="row thumbnail" id="index_row">
			<div class="col-md-4 col-lg-4  pull-left">
				<a href="<?=base_url("frontend/products/details/$value->id")?>"><img src="<?=base_url("assets/images/$value->image")?>" id="index_img" ></a>
			</div>
			<div class="col-md-8">
				<a href="<?=base_url("frontend/products/details/$value->id")?>" style="text-decoration: none;"><p><?=$value->name?></p></a>
				<p><?=$value->title?></p>
				<p><?=$value->description?></p>
				<a class="btn btn-success my_button margin_button" href="<?=base_url("frontend/products/details/$value->id")?>">View details</a>
			</div>
		</div>
	<?php endforeach ?>
	<?php echo $this->pagination->create_links(); ?>
	</div>
</div>
<script>window.close();</script>