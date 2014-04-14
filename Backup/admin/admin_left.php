<?php
$currentPage = $_SESSION['currentPage'];

$dashboard 		 		= array('admin_main.php');
$admin_utilities 		= array('admin_changeprofile.php' , 'admin_changepwd.php');
$user_management 		= array('manage_user.php');
$supplier_management 	= array('manage_supplier.php');
$brand_management	 	= array('manage_brand.php');
$product_godown	 		= array('manage_product_godown.php');
?>
<ul>
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!--<form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />				
							<input type="button" class="submit" value=" " />
						</div>
					</form>-->
                    <br />
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
                <?php
				if (in_array($currentPage, $dashboard)) {
					$active 		= ' active ';
					$span_selected  = '<span class="selected"></span>';
				} else {
					$active 		= '';
					$span_selected  = '';
				}
				?>
				<li class="start <?=$active?> ">
					<a href="admin_main.php">
					<i class="icon-home"></i> 
					<span class="title">Dashboard</span>
					<?=$span_selected?>
					</a>
				</li>
                <?php
				if (in_array($currentPage, $admin_utilities)) {
					$active 		= 'active ';
					$span_selected  = '<span class="selected"></span>';
					$arrow_open     = ' open';
				} else {
					$active 		= '';
					$span_selected  = '';
					$arrow_open		= '';
				}
				?>
				<li class="<?=$active?> has-sub ">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Admin Utilities</span>
                    <?=$span_selected?>
					<span class="arrow <?=$arrow_open?>"></span>
					</a>
					<ul class="sub">
						<li <?php if($currentPage == 'admin_changeprofile.php') { echo 'class="active"';}?>><a href="admin_changeprofile.php">Change Profile</a></li>
						<li <?php if($currentPage == 'admin_changepwd.php') { echo 'class="active"';}?>><a href="admin_changepwd.php">Change Password</a></li>
					</ul>
				</li>
                 <?php
				if (in_array($currentPage, $user_management)) {
					$active 		= 'active ';
					$span_selected  = '<span class="selected"></span>';
					$arrow_open     = ' open';
				} else {
					$active 		= '';
					$span_selected  = '';
					$arrow_open		= '';
				}
				?>
				<li class="<?=$active?> has-sub ">
					<a href="javascript:;">
					<i class="icon-user"></i> 
					<span class="title">User Management</span>
                    <?=$span_selected?>
					<span class="arrow <?=$arrow_open?>"></span>
					</a>
					<ul class="sub">
						<li <?php if($currentPage == 'manage_user.php' && $_REQUEST['mode'] == 'add') { echo 'class="active"';}?>><a href="manage_user.php?mode=add">Create New User</a></li>
						<li <?php if($currentPage == 'manage_user.php' && $_REQUEST['mode'] != 'add') { echo 'class="active"';}?>><a href="manage_user.php">Manage User</a></li>
					</ul>
				</li>
                
                <?php
				if (in_array($currentPage, $supplier_management)) {
					$active 		= 'active ';
					$span_selected  = '<span class="selected"></span>';
					$arrow_open     = ' open';
				} else {
					$active 		= '';
					$span_selected  = '';
					$arrow_open		= '';
				}
				?>
				<li class="<?=$active?> has-sub ">
					<a href="javascript:;">
					<i class="icon-user-md"></i> 
					<span class="title">Supplier Management</span>
                    <?=$span_selected?>
					<span class="arrow <?=$arrow_open?>"></span>
					</a>
					<ul class="sub">
						<li <?php if($currentPage == 'manage_supplier.php' && $_REQUEST['mode'] == 'add') { echo 'class="active"';}?>><a href="manage_supplier.php?mode=add">Create New Supplier</a></li>
						<li <?php if($currentPage == 'manage_supplier.php' && $_REQUEST['mode'] != 'add') { echo 'class="active"';}?>><a href="manage_supplier.php">Manage Supplier</a></li>
					</ul>
				</li>
                
                <?php
				if (in_array($currentPage, $brand_management)) {
					$active 		= 'active ';
					$span_selected  = '<span class="selected"></span>';
					$arrow_open     = ' open';
				} else {
					$active 		= '';
					$span_selected  = '';
					$arrow_open		= '';
				}
				?>
				<li class="<?=$active?> has-sub ">
					<a href="javascript:;">
					<i class="icon-sitemap"></i> 
					<span class="title">Brand Management</span>
                    <?=$span_selected?>
					<span class="arrow <?=$arrow_open?>"></span>
					</a>
					<ul class="sub">
						<li <?php if($currentPage == 'manage_brand.php' && $_REQUEST['mode'] == 'add') { echo 'class="active"';}?>><a href="manage_brand.php?mode=add">Add Product Brand</a></li>
						<li <?php if($currentPage == 'manage_brand.php' && $_REQUEST['mode'] != 'add') { echo 'class="active"';}?>><a href="manage_brand.php">Manage Product Brand</a></li>
					</ul>
				</li>
                
                <?php
				if (in_array($currentPage, $product_godown)) {
					$active 		= 'active ';
					$span_selected  = '<span class="selected"></span>';
					$arrow_open     = ' open';
				} else {
					$active 		= '';
					$span_selected  = '';
					$arrow_open		= '';
				}
				?>
				<li class="<?=$active?> has-sub ">
					<a href="javascript:;">
					<i class="icon-barcode"></i> 
					<span class="title">Godown Product</span>
                    <?=$span_selected?>
					<span class="arrow <?=$arrow_open?>"></span>
					</a>
					<ul class="sub">
						<li <?php if($currentPage == 'manage_product_godown.php' && $_REQUEST['mode'] == 'add') { echo 'class="active"';}?>><a href="manage_product_godown.php?mode=add">Add Product</a></li>
						<li <?php if($currentPage == 'manage_product_godown.php' && $_REQUEST['mode'] != 'add') { echo 'class="active"';}?>><a href="manage_product_godown.php">Manage Product</a></li>
					</ul>
				</li>
				
				<li class="">
					<a href="logout.php">
					<i class="icon-key"></i> 
					<span class="title">Logout</span>
					</a>
				</li>
			</ul>