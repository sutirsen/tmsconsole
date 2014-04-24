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
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal userGrpRegFrmHandle">
                        <div class="control-group">
                              <label class="control-label"><?php echo $entry_name; ?>*</label>
                              <div class="controls">
                                 <input type="text" class="span6 m-wrap" name="name" value="<?php echo $name; ?>" id="name" />
                                 <?php if ($error_name) { ?>
                                 <span class="help-inline" style="color:red;"><?php echo $error_name; ?></span>
              					 <?php } ?>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_access; ?></label>
                              <div class="controls">
                                 <div class="scrollbox">
					                <?php $class = 'odd'; ?>
					                <?php foreach ($permissions as $permission) { ?>
					                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					                <div class="<?php echo $class; ?>">
					                  <?php if (in_array($permission, $access)) { ?>
					                  <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" checked="checked" />
					                  <?php echo $permission; ?>
					                  <?php } else { ?>
					                  <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" />
					                  <?php echo $permission; ?>
					                  <?php } ?>
					                </div>
					                <?php } ?>
					              </div>
					              <a onclick="$(this).parent().find(':checkbox').attr('checked', true); $.uniform.update();"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false); $.uniform.update();"><?php echo $text_unselect_all; ?></a>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label"><?php echo $entry_modify; ?></label>
                              <div class="controls">
                                 <div class="scrollbox">
				                <?php $class = 'odd'; ?>
				                <?php foreach ($permissions as $permission) { ?>
				                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
				                <div class="<?php echo $class; ?>">
				                  <?php if (in_array($permission, $modify)) { ?>
				                  <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" checked="checked" />
				                  <?php echo $permission; ?>
				                  <?php } else { ?>
				                  <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" />
				                  <?php echo $permission; ?>
				                  <?php } ?>
				                </div>
				                <?php } ?>
				              </div>
				              <a onclick="$(this).parent().find(':checkbox').attr('checked', true); $.uniform.update();"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false); $.uniform.update();"><?php echo $text_unselect_all; ?></a>
                              </div>
                           </div>
                          </form>
                          <!-- END FORM -->
                        </div>
                       </div>
                     </div>
                   </div>
                   <!-- END Page Content -->
<?php echo $footer; ?> 