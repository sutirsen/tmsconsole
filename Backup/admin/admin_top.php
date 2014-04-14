<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="index.php">
				<!--<img src="assets/img/logo.png" alt="logo" />-->
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="assets/img/menu-toggler.png" alt="" />
				</a>   
               <!-- <div align="center"  style="float:left; margin-left:620px; padding:6px 0px 7px 0px">
					<script language="javascript" src="liveclock.js"></script>
                    <script>
                    	show_clock();
                    </script>
                </div> -->     
				<!-- END RESPONSIVE MENU TOGGLER -->				
				<!-- BEGIN TOP NAVIGATION MENU -->	
                <?php
				if(isset($_SESSION['admin_userid']) && $_SESSION['admin_userid']!=NULL) { 
				$admin_details = mysql_fetch_array(mysql_query("select * from admin_master where id = ".$_SESSION['admin_userid']));
				?>				
		  <ul class="nav pull-right">
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="username"><?=stripslashes($admin_details['first_name'].' '.$admin_details['last_name'])?></span>
						<i class="icon-angle-down"></i>
						</a>
					  <ul class="dropdown-menu">
							<li><a href="admin_changeprofile.html"><i class="icon-user"></i> My Profile</a></li>
							<li><a href="#"><i class="icon-tasks"></i> Last Login: <br /><?=date('j M Y',strtotime($admin_details['last_login']))?> <br /> <?=date('g:i a',strtotime($admin_details['last_login']))?></a></li>
							<li class="divider"></li>
							<li><a href="logout.html"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
			  </ul>
             <?php } ?> 
				<!-- END TOP NAVIGATION MENU -->	
			</div>
		</div>