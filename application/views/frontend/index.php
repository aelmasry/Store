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
			                <img src="<?=base_url('assets/images/slider/1.jpg')?>" alt="Slide1" style="width:1400px; height:300px;" />
			            </div>
			            <div class="item">
			                <img src="<?=base_url('assets/images/slider/2.jpg')?>" alt="Slide2" style="width:1400px; height:300px;" />
			            </div>
			            <div class="item">
			                <img src="<?=base_url('assets/images/slider/3.jpg')?>" alt="Slide3" style="width:1400px; height:300px;" />
			            </div>
			            <div class="item">
			                <img src="<?=base_url('assets/images/slider/4.jpg')?>" alt="Slide3" style="width:1400px; height:300px;" />
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
		<div class="row thumbnail" style="margin-bottom: 40px">
			<div class="col-md-4 col-lg-4  pull-left">
				<a href="<?=base_url("frontend/products/details/$value->id")?>"><img src="<?=base_url("assets/images/$value->image")?>" style="width:200px;height:200px;"></a>
			</div>
			<div class="col-md-8">
				<a href="<?=base_url("frontend/products/details/$value->id")?>" style="text-decoration: none;"><p><?=$value->name?></p></a>
				<p><?=$value->title?></p>
				<p><?=$value->description?></p>
				<a class="btn btn-success my_button" style="margin-left:0px;" href="<?=base_url("frontend/products/details/$value->id")?>">View details</a>
			</div>
		</div>
	<?php endforeach ?>
	<?php echo $this->pagination->create_links(); ?>
	</div>
</div>
<script>window.close();</script>