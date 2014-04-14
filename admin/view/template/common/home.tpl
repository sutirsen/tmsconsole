<?php echo $header; ?>
<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">  	
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							<?php echo $heading_title; ?>
						</h3>
						<ul class="breadcrumb">
						<?php $breadcount = 0; ?>
						 <?php foreach ($breadcrumbs as $breadcrumb) { ?>
						 <li>
						 	<?php if($breadcount == 0) { ?>
						 	<i class="icon-home"></i>
						 	<?php } ?>
    						<a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    						<?php if($breadcount != (count($breadcrumbs)-1)) { ?>
    						<i class="icon-angle-right"></i>
    						<?php } ?>
    					 </li>
    <?php
    $breadcount++;
 } ?>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->				
				<div class="row-fluid">
					<div class="span12">
					  <?php if ($error_install) { ?>
					  <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_install; ?>
								</div>
					  <?php } ?>
					  <?php if ($error_image) { ?>
					  <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_image; ?>
								</div>
					  <?php } ?>
					  <?php if ($error_image_cache) { ?>
					  <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_image_cache; ?>
								</div>
					  <?php } ?>
					  <?php if ($error_cache) { ?>
					  <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_cache; ?>
								</div>
					  <?php } ?>
					  <?php if ($error_download) { ?>
					  <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_download; ?>
								</div>
					  <?php } ?>
					  <?php if ($error_logs) { ?>
					  <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_logs; ?>
								</div>
					  <?php } ?>
					</div>
				</div>
				<!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i><?php echo $text_overview; ?></h4>
                     </div>
                     <div class="portlet-body form">
                        <table class="table table-striped table-hover">
				            <tr>
				              <td>Statistics will be shown : </td>
				              <td>Here</td>
				            </tr>
				          </table>
                     </div>
                   </div>
<?php echo $footer; ?>