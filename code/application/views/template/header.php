<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="<?=base_url('assets/js/jquery-ui.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/docs.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/bootstrap-social.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default" role="navigation" style="background:#D1ECE3;">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
					<a href="<?=base_url('frontend/home/index');?>">Home</a>
					</li>
					<li>
						<a href="<?=base_url('frontend/products/index');?>">Products</a>
					</li>
					<li>
						<a href="<?=base_url('frontend/areas/index');?>">Areas</a>
					</li>
					<li>
						<a href="<?=base_url('frontend/categories/index');?>">Categories</a>
					</li>
					<li>
						<a href="<?=base_url('frontend/cart/index');?>"><img src="<?=base_url('assets/images/cart.png')?>" style="width: 40px;" id="cart_icon"></a>
						<?php if ($this->session->userdata('id') != null): ?>
						<span id="nav-cart-num" class="cart-number"></span>	
						<?php endif ?>
					</li>
					<?php if ($this->session->userdata('id') != null): ?>
						<div class="btn-group log_in_out">
						  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#" style="background-color: #90B5C8;border-color: #90B5C8;min-width: 91px;"><i class="icon-user icon-white"></i> <?=$this->session->userdata('first_name')?></a>
						  <ul class="dropdown-menu" style=" min-width: 0px; padding: 0px 0;">
					    <?php if ($this->session->userdata('link') != null): ?>
					    	<a  href="<?=base_url('auth/log_out');?>" class="btn" style="padding: 6px 9px;"><img src='http://graph.facebook.com/<?=$this->session->userdata('link')?>/picture' style="width:22px;">Log out</a>
					    <?php else: ?>
					    	<a href="<?=base_url('auth/log_out');?>" class="btn" style="padding: 6px 9px;"><img src='<?=base_url('assets/images/default.png')?>' style="width:22px;">Log out</a>
					    <?php endif; ?>
					    </div>
					<?php else: ?>
						<li>
						  <a data-toggle="modal" data-target="#myModal" href="#">Log in</a>
					    </li>
					<?php endif ?>
				</ul>
			</div>

		</div>
	</nav>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form class="form-signin" method="POST" action="<?=base_url('auth/sign_in')?>">
						<h2 class="form-signin-heading">Please sign in</h2>
						<label for="inputEmail" class="sr-only">Email address</label>
						<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
						<label for="inputPassword" class="sr-only">Password</label>
						<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
						<div class="modal-footer">
							<div class="col-md-6 modal_login">
								<input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Sign in">
							</div>
							<div class="col-md-6 modal_login">
								<a class="btn btn-lg btn-success btn-block" type="submit" href="<?=base_url('auth/register')?>">Register</a>
							</div>
							<div class="col-md-6 modal_login social_div" style="right: 223px;top: 333px;">
								<a class="facebook_connect btn btn-social-icon btn-facebook" style="margin-top: 2px;" type="submit" href=""><i class="fa fa-facebook"></i></a>
								<a class="twitter_connect btn btn btn-social-icon btn-twitter" type="submit" href="<?=base_url('auth/twitter_login')?>"><i class="fa fa-twitter"></i></a>
								<a class="linkedin_connect btn btn-social-icon btn-linkedin" type="submit" href=""><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
					
					</form>

				</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
      <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log out?</div>
      <div class="modal-footer"><button id="loged_out" class="btn btn-primary btn-block">Logout</a></div>
      <div class="modal-footer"><button class="btn btn-primary btn-block" data-dismiss="modal">Cancel</a></div>
    </div>
  </div>
</div>