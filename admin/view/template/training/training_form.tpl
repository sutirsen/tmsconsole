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
                                 <?php if ($error_name) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_name; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_type; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="type" value="<?php echo $type; ?>" id="type" />
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_date; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap date-picker" name="date" value="<?php echo $date; ?>" id="date" />
                                 <?php if ($error_date) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_date; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_duration; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="duration" value="<?php echo $duration; ?>" id="duration" />
                                 <?php if ($error_duration) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_duration; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_location; ?></label>
                              <div class="controls">
             					 <select name="location" class="span6 m-wrap" id="location">
					                <?php foreach ($locations as $location) { ?>
					                <?php  echo $location['location_name']; ?>
					                <?php if ($location['location_name'] == $trng_location) { ?>
					                <option value="<?php echo $location['location_name']; ?>" selected="selected"><?php echo $location['location_name']; ?></option>
					                <?php } else { ?>
					                <option value="<?php echo $location['location_name']; ?>"><?php echo $location['location_name']; ?></option>
					                <?php } ?>
					                <?php } ?>
					              </select>
                              </div>
                           </div>
                              </div>
                           </div>
                        </form>
                        <!-- END FORM -->
                     </div>
                    </div>
                  <!-- END SAMPLE FORM PORTLET-->
               </div>
            </div>
<?php echo $footer; ?> 