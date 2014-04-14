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
					<?php if ($error_warning) { ?>
					  <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_warning; ?>
					  </div>
					  <?php } ?>
					  <div class="clearfix">
									<div class="btn-group">
										
											<button id="sample_editable_1_new" class="btn green" onclick="$('#forgotten').submit();">
											<?php echo $button_reset; ?>
											</button>
										
										<a href="<?php echo $cancel; ?>">
											<button id="sample_editable_1_new" onclick="$('form').submit();" class="btn blue" style="margin:5px;">
											<?php echo $button_cancel; ?>
											</button>
										</a>
									</div>
								</div>
					</div>
				</div>
				<!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i><?php echo $text_email; ?></h4>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="forgotten">
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_email; ?></label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="icon-envelope"></i>
                                    <input class="m-wrap " type="text" placeholder="Email Address" name="email" value="<?php echo $email; ?>" />    
                                 </div>
                              </div>
                           </div>
                         </form>
                        <!-- END FORM -->
                     </div>
                   </div>
<?php echo $footer; ?>