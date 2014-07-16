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
					  <div class="alert">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_warning; ?>
					  </div>
					  <?php } ?>
					  <div class="clearfix">
									<div class="btn-group">
										
										<button id="sample_editable_1_new" class="btn green" onclick="$('#form').submit();">
										<?php echo $button_save; ?></i>
										</button>
										<a href="<?php echo $cancel; ?>">
											<button id="sample_editable_1_new" class="btn blue" style="margin:5px;">
												<?php echo $button_cancel; ?></i>
											</button>
										</a>
									</div>
								</div>
                  <!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i><?php echo $heading_title; ?></h4>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_title; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="training_title" value="<?php echo $training_title; ?>" id="training_title" />
                                 <?php if ($error_training_title) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_training_title; ?></span>
              					         <?php } ?>
                              </div>
                           </div>
                           <!-- END Control -->
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_description; ?></label>
                              <div class="controls">
                                 <textarea class="span6 m-wrap" rows="3" name="training_description" id="training_description"><?php echo $training_description; ?></textarea>
                              </div>
                           </div>
                           <!-- END Control -->
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_type; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="training_type" value="<?php echo $training_type; ?>" id="training_type" />
                              </div>
                           </div>
                           <!-- END Control -->
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_time; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="training_time" value="<?php echo $training_time; ?>" id="training_time" />
                                 <?php if ($error_training_time) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_training_time; ?></span>
                                 <?php } ?>
                              </div>
                           </div>
                           <!-- END Control -->
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_duration; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="training_duration" value="<?php echo $training_duration; ?>" id="training_duration" />
                                 <?php if ($error_training_duration) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_training_duration; ?></span>
                                 <?php } ?>
                              </div>
                           </div>
                           <!-- END Control -->
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_location; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="training_location" value="<?php echo $training_location; ?>" id="training_location" />
                                 <?php if ($error_training_location) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_training_location; ?></span>
                                 <?php } ?>
                              </div>
                           </div>
                           <!-- END Control -->
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_cost; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="training_cost" value="<?php echo $training_cost; ?>" id="training_cost" />
                              </div>
                           </div>
                           <!-- END Control -->
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_training_instructor; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="training_instructor" value="<?php echo $training_instructor; ?>" id="training_instructor" />
                              </div>
                           </div>
                           <!-- END Control -->
                           
                        </form>
                        <!-- END FORM -->
                     </div>
                    </div>
                  <!-- END SAMPLE FORM PORTLET-->
               </div>
            </div>
<?php echo $footer; ?> 