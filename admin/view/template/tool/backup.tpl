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
					  <?php if ($success) { ?>
					  <div class="alert">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $success; ?>
					  </div>
					  <?php } ?>
					  <div class="clearfix">
									<div class="btn-group">
										
										<button id="sample_editable_1_new" class="btn green" onclick="$('#restore').submit();">
										<?php echo $button_restore; ?>
										</button>
										<button id="sample_editable_1_new" class="btn blue" style="margin:5px;" onclick="$('#backup').submit();">
										<?php echo $button_backup; ?></i>
										</button>
									</div>
								</div>
                  <!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box blue">
                     <div class="portlet-title">
                        <h4><img src="view/image/backup.png" alt="" /><?php echo $heading_title; ?></h4>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo $restore; ?>" method="post" enctype="multipart/form-data" id="restore" class="form-horizontal">
                        	<div class="control-group">
                              <label class="control-label"><?php echo $entry_restore; ?></label>
                              <div class="controls">
                                 <input type="file" name="import" />
                              </div>
                             </div>
                        </form>
                        <form action="<?php echo $backup; ?>" method="post" enctype="multipart/form-data" id="backup" class="form-horizontal">
                        	<div class="control-group">
                              <label class="control-label"><?php echo $entry_restore; ?></label>
                              <div class="controls">
                                <div class="scrollbox" style="margin-bottom: 5px;">
					                <?php $class = 'odd'; ?>
					                <?php foreach ($tables as $table) { ?>
					                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					                <div class="<?php echo $class; ?>">
					                  <input type="checkbox" name="backup[]" value="<?php echo $table; ?>" checked="checked" />
					                  <?php echo $table; ?></div>
					                <?php } ?>
					              </div>
					              <a onclick="$(this).parent().find(':checkbox').attr('checked', true); $.uniform.update();"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false); $.uniform.update();"><?php echo $text_unselect_all; ?></a>
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