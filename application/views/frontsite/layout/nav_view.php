<header class="header-container">
	<div class="container">
		<div class="top-row">
			<div class="row">
				<div class="col-md-2 col-sm-6 col-xs-6">
					<div id="logo">
						<a href="<?= base_url() ?>"><span>Sharief</span> Guest house</a>
					</div>
				</div>
				<div class="col-sm-6 visible-sm">
					<div class="text-right"><button type="button" class="book-now-btn"><a href="<?= base_url('front/booking'); ?>">Book Now</a></button></div>
				</div>
				<div class="col-md-8 col-sm-12 col-xs-12 remove-padd">
					<nav class="navbar navbar-default">
						<div class="navbar-header page-scroll">
							<button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navigation navbar-collapse navbar-ex1-collapse remove-space">
							<ul class="list-unstyled nav1 cl-effect-10">
								<?php $current_page = $this->uri->segment(2); ?>
								<li><a data-hover="Home" class="<?= ($current_page == 'index') ? 'active' : '' ?>" href="<?= base_url('front/index') ?>"><span>Home</span></a></li>
								<li><a class="<?= ($current_page == 'about') ? 'active' : '' ?>" data-hover="About" href="<?= base_url('front/about') ?>"><span>About</span></a></li>
								<li><a class="<?= ($current_page == 'rooms') ? 'active' : '' ?>" data-hover="Rooms" href="<?= base_url('front/rooms') ?>"><span>Rooms</span></a></li>
								<li><a class="<?= ($current_page == 'gallery') ? 'active' : '' ?>" data-hover="Gallery" href="<?= base_url('front/gallery') ?>"><span>Gallery</span></a></li>
								<li><a class="<?= ($current_page == 'dinning') ? 'active' : '' ?>" data-hover="Dinning" href="<?= base_url('front/dinning') ?>"><span>Dinning</span></a></li>
								<li><a class="<?= ($current_page == 'contact') ? 'active' : '' ?>" data-hover="Contact Us" href="<?= base_url('front/contact') ?>"><span>Contact Us</span></a></li>
							</ul>
						</div>
					</nav>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-12 hidden-sm">
					<div class="text-right"><button type="button" class="book-now-btn"><a href="<?= base_url('front/booking'); ?>">Book Now</a></button></div>
				</div>
			</div>
		</div>
	</div>
	</div>
</header>
