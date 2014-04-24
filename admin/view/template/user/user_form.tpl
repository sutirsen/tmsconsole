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
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal userRegFrmHandle">
                        <div class="control-group">
                              <label class="control-label"><?php echo $entry_username; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="username" value="<?php echo $username; ?>" id="username" />
                                 <?php if ($error_username) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_username; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_firstname; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="firstname" value="<?php echo $firstname; ?>" id="firstname" />
                                 <?php if ($error_firstname) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_firstname; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_lastname; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="lastname" value="<?php echo $lastname; ?>" id="lastname" />
                                 <?php if ($error_lastname) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_lastname; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_email; ?></label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="email" value="<?php echo $email; ?>" id="email" />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_user_group; ?></label>
                              <div class="controls">
             					 <select name="user_group_id" class="span6 m-wrap" id="user_group_id">
					                <?php foreach ($user_groups as $user_group) { ?>
					                <?php if ($user_group['user_group_id'] == $user_group_id) { ?>
					                <option value="<?php echo $user_group['user_group_id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
					                <?php } else { ?>
					                <option value="<?php echo $user_group['user_group_id']; ?>"><?php echo $user_group['name']; ?></option>
					                <?php } ?>
					                <?php } ?>
					              </select>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_password; ?></label>
                              <div class="controls">
                                 <input type="password" class="span6 m-wrap" name="password" value="<?php echo $password; ?>" id="password" />
                                 <?php if ($error_password) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_password; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_confirm; ?></label>
                              <div class="controls">
                                 <input type="password" class="span6 m-wrap" name="confirm" value="<?php echo $confirm; ?>" id="confirm" />
                                 <?php if ($error_confirm) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_confirm; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_status; ?></label>
                              <div class="controls">
                                 <select name="status" class="span6 m-wrap" id="status">
					                <?php if ($status) { ?>
					                <option value="0"><?php echo $text_disabled; ?></option>
					                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					                <?php } else { ?>
					                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					                <option value="1"><?php echo $text_enabled; ?></option>
					                <?php } ?>
					              </select>
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