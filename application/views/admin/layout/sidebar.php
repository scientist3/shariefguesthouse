<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('admin/contact'); ?>" class="brand-link">
		<img src="<?php echo base_url('vendor/almasaeed2010/adminlte/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Sharief Guest House</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?php echo base_url('vendor/almasaeed2010/adminlte/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Admin</a>
			</div>
		</div>

		<!-- SidebarSearch Form -->
		<div class="form-inline d-none">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column my-3 text-sm" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

				<!-- DASHBOARD -->
				<!-- < ? php echo ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(3) == 'index') ? "menu-open" : null; ?> -->
				<li class="nav-item ">
					<a href="<?php echo base_url('admin/booking') ?>" class="nav-link <?php echo $this->uri->segment(2) == 'booking' ? 'active' : null ?>">
						<i class="nav-icon fas fa-calendar-alt"></i>
						<p>Bookings</p>
					</a>
				</li>

				<!-- <li class="nav-header">BackEnd</li> -->
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>