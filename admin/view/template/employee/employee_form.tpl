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
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal employeeInsert">
                        <div class="control-group">
                              <label class="control-label"><?php echo $entry_firstname; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_first_name" value="<?php echo $emp_first_name; ?>" id="emp_first_name" />
                                 <?php if ($error_emp_first_name) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_emp_first_name; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_middlename; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_middle_name" value="<?php echo $emp_middle_name; ?>" id="emp_middle_name" />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_lastname; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_last_name" value="<?php echo $emp_last_name; ?>" id="emp_last_name" />
                                 <?php if ($error_emp_last_name) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_emp_last_name; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_email; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_email" value="<?php echo $emp_email; ?>" id="emp_email" />
                                 <?php if ($error_emp_email) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_emp_email; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_dateofbirth; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap date-picker" name="emp_dob" value="<?php echo $emp_dob; ?>" id="emp_dob" />
                                 <?php if ($error_emp_dob) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_emp_dob; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_gender; ?></label>
                              <div class="controls">
                                 <select class="span6 m-wrap" name="emp_gender" id="emp_gender">
                                 	<option value="M" <?php if($emp_gender == "M") { echo "selected"; } ?>><?php echo $optvalue_gender_male; ?></option>
                                 	<option value="F" <?php if($emp_gender == "F") { echo "selected"; } ?>><?php echo $optvalue_gender_female; ?></option>
                                 </select>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_mobile1; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_mob1" value="<?php echo $emp_mob1; ?>" id="emp_mob1" />
                                 <?php if ($error_emp_mob1) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_emp_mob1; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_mobile2; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_mob2" value="<?php echo $emp_mob2; ?>" id="emp_mob2" />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_landphone; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_land_phn" value="<?php echo $emp_land_phn; ?>" id="emp_land_phn" />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_address; ?></label>
                              <div class="controls">
                                 <textarea class="span6 m-wrap" name="emp_address" id="emp_address"><?php echo $emp_address; ?></textarea>
                                 <?php if ($error_emp_address) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_emp_address; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_nationality; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_nationality" value="<?php echo $emp_nationality; ?>" id="emp_nationality" />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_dateofjoining; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap date-picker" name="emp_dateofjoining" value="<?php echo $emp_dateofjoining; ?>" id="emp_dateofjoining" />
                                 <?php if ($error_emp_dateofjoining) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_emp_dateofjoining; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_designation; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_designation" value="<?php echo $emp_designation; ?>" id="emp_designation" />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_passport; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="emp_passport" value="<?php echo $emp_passport; ?>" id="emp_passport" />
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