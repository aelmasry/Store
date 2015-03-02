	<nav class="navbar navbar-default" role="navigation" style="background:#D1ECE3;">
		<div class="container">
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				<?php foreach ($records as  $value): ?>
					<li>
						<a href="<?=base_url("frontend/areas/area/$value->id");?>"><?=$value->name?></a>
					</li>
				<?php endforeach ?>	
				</ul>
			</div>

		</div>
	</nav>
