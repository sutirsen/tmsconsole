<?php
require("admin_utils.php");
if($_SESSION['admin_userid']==''){
	header('location: index.html');
}
else{
	disphtml("main();");
}
ob_end_flush();

function main(){?>
<style>
a {
   /* color: #000 !important;*/
}
</style>
<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
                    	<!-- BEGIN STYLE CUSTOMIZER -->
                 		 <?php include("theme_colour.php");?>
                 		<!-- END BEGIN STYLE CUSTOMIZER -->  
						<!-- BEGIN STYLE CUSTOMIZER -->
						
						<!-- END BEGIN STYLE CUSTOMIZER -->   	
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							Dashboard				
							<!--<small>statistics and more</small>-->
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="admin_main.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
							
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div id="dashboard">
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row-fluid">
                    <div style="width:100%; float:left;">
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat blue">
								<div class="visual">
                                	<i class="icon-glass"></i>
									<!--<img src="images/godown.png" />-->
								</div>
								<div class="details">
									<div class="number">
										GODOWN
									</div>
                                    <br />
									<div class="desc">									
										<a href="#">MANAGE BRAND</a>
									</div>
                                    <div class="desc">									
										<a href="#">MANAGE SUPPLIER</a>
									</div>
                                    <div class="desc">									
										<a href="#">MANAGE PRODUCT</a>
									</div>
                                    <br />
								</div>
								<a class="more" href="#">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat green">
								<div class="visual">
                                	<i class="icon-glass"></i>
									<!--<img src="images/wine.png" />-->
								</div>
								<div class="details">
									<div class="number">OFFSHOP</div>
									 <br />
									<div class="desc">									
										<a href="#">PRESENT STOCK</a>
									</div>
                                    <div class="desc">									
										<a href="#">SELL PRODUCT</a>
									</div>
                                    <div class="desc">									
										<a href="#">SEARCH REPORT</a>
									</div>
                                    <br />
								</div>
								<a class="more" href="#">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
                    </div>  
                      <div style="width:100%; float:left">
						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
							<div class="dashboard-stat purple">
								<div class="visual">
                                	<i class="icon-glass"></i>
									<!--<img src="images/main_bar.png" />-->
								</div>
								<div class="details">
									<div class="number">MAIN BAR COUNTER</div>
									 <br />
									<div class="desc">									
										<a href="#">PRESENT STOCK</a>
									</div>
                                    <div class="desc">									
										<a href="#">SELL PRODUCT</a>
									</div>
                                    <div class="desc">									
										<a href="#">SEARCH REPORT</a>
									</div>
                                    <br />
								</div>
								<a class="more" href="#">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat yellow">
								<div class="visual">
									<i class="icon-glass"></i>
                                    <!--<img src="images/main_bar.png" />-->
								</div>
								<div class="details">
									<div class="number">ADDITIONAL BAR COUNTER</div>
                                     <br />
									<div class="desc">									
										<a href="#">PRESENT STOCK</a>
									</div>
                                    <div class="desc">									
										<a href="#">SELL PRODUCT</a>
									</div>
                                    <div class="desc">									
										<a href="#">SEARCH REPORT</a>
									</div>
                                    <br />
								</div>
								<a class="more" href="#">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
                      </div>  
					</div>
					<!-- END DASHBOARD STATS -->
				</div>
			</div>
<? }?>