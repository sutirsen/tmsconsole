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
					<div class="span12 ">
						<!-- BEGIN Portlet PORTLET-->
						<div class="portlet box green">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i>Search</h4>
								<div class="tools">
									<a href="javascript:;" <?php if($filter_training_title != ""
															|| $filter_training_type != ""
															|| $filter_training_time != ""
															|| $filter_training_duration != ""
															|| $filter_training_location != ""
															|| $filter_training_cost != ""
															|| $filter_training_instructor != ""
															|| $filter_createdon != "") { ?>class="collapse"<?php } else { ?>class="expand"<?php } ?> ></a>
									<a href="<?php echo $resetSearch; ?>" class="reloadWithoutHandler"></a>
								</div>
							</div>
							<div class="portlet-body <?php if($filter_training_title != ""
															|| $filter_training_type != ""
															|| $filter_training_time != ""
															|| $filter_training_duration != ""
															|| $filter_training_location != ""
															|| $filter_training_cost != ""
															|| $filter_training_instructor != ""
															|| $filter_createdon != "") { ?><?php } else { echo "hide"; } ?>">
								<h3 class="form-section">Filters</h3>
								<div class="row-fluid">
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Title</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_training_title" value="<?php echo $filter_training_title; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Type</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_training_type" value="<?php echo $filter_training_type; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								</div>
								<!--/row-->
								<div class="row-fluid">
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Time</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_training_time" value="<?php echo $filter_training_time; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Duration</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_training_duration" value="<?php echo $filter_training_duration; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								</div>
								<!--/row-->
								<div class="row-fluid">
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Location</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_training_location" value="<?php echo $filter_training_location; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Cost</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_training_cost" value="<?php echo $filter_training_cost; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								</div>
								<!--/row-->
								<div class="row-fluid">
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Instructor</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_training_instructor" value="<?php echo $filter_training_instructor; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								   <div class="span6 ">
								      <div class="control-group">
								         <label class="control-label">Created On</label>
								         <div class="controls">
								            <input type="text" class="m-wrap span12" name="filter_createdon" value="<?php echo $filter_createdon; ?>" />
								         </div>
								      </div>
								   </div>
								   <!--/span-->
								</div>
								<!--/row-->
								<div class="form-actions">
                                       <button onclick="filter();" class="btn blue"><i class="icon-ok"></i> <?php echo $button_filter; ?></button>
                                </div>
							</div>
						</div>
						<!-- END Portlet PORTLET-->
					</div>
				</div>			
				<div class="row-fluid">
					<div class="span12">
					  <?php if ($error_warning) { ?>
					  <div class="alert">
									<button class="close" data-dismiss="alert"></button>
									<?php echo $error_warning; ?>
					  </div>
					  <?php } ?>
					  <?php if ($success) { ?>
					  <div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Success!</strong> <?php echo $success; ?>
					 </div>
					  <?php } ?>
					  <div class="clearfix">
									<div class="btn-group">
										<a href="<?php echo $insert; ?>">
										<button id="sample_editable_1_new" class="btn green">
										<?php echo $button_insert; ?> <i class="icon-plus"></i>
										</button>
										</a>
										<button id="sample_editable_1_new" onclick="$('form').submit();" class="btn blue" style="margin:5px;">
										<?php echo $button_delete; ?> <i class="icon-trash"></i>
										</button>
									</div>
									<div class="btn-group pull-right">
										<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
										</button>
										<ul class="dropdown-menu">
											<li><a href="#">Print</a></li>
											<li><a href="#">Save as PDF</a></li>
											<li><a href="#">Export to Excel</a></li>
										</ul>
									</div>
								</div>
						<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
						 <table class="table table-hover table-bordered table-striped" id="tblTrainingList">
				          <thead>
				            <tr>
				              	<th width="1" style="text-align: center;"><input id="selectall" type="checkbox" /></th>
				              	<th <?php if ($sort == 'training_title') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'training_title') { ?>
				                	<a href="<?php echo $sort_training_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_training_title; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_training_title; ?>"><?php echo $text_column_training_title; ?></a>
				                	<?php } ?>
				            	</th>
				            	<th <?php if ($sort == 'training_type') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'training_type') { ?>
				                	<a href="<?php echo $sort_training_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_training_type; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_training_type; ?>"><?php echo $text_column_training_type; ?></a>
				                	<?php } ?>
				            	</th>
				            	<th <?php if ($sort == 'training_time') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'training_time') { ?>
				                	<a href="<?php echo $sort_training_time; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_training_time; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_training_time; ?>"><?php echo $text_column_training_time; ?></a>
				                	<?php } ?>
				            	</th>
				            	<th <?php if ($sort == 'training_duration') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'training_duration') { ?>
				                	<a href="<?php echo $sort_training_duration; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_training_duration; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_training_duration; ?>"><?php echo $text_column_training_duration; ?></a>
				                	<?php } ?>
				            	</th>
				            	<th <?php if ($sort == 'training_location') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'training_location') { ?>
				                	<a href="<?php echo $sort_training_location; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_training_location; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_training_location; ?>"><?php echo $text_column_training_location; ?></a>
				                	<?php } ?>
				            	</th>
				            	<th <?php if ($sort == 'training_cost') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'training_cost') { ?>
				                	<a href="<?php echo $sort_training_cost; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_training_cost; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_training_cost; ?>"><?php echo $text_column_training_cost; ?></a>
				                	<?php } ?>
				            	</th>
				            	<th <?php if ($sort == 'training_instructor') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'training_instructor') { ?>
				                	<a href="<?php echo $sort_training_instructor; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_training_instructor; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_training_instructor; ?>"><?php echo $text_column_training_instructor; ?></a>
				                	<?php } ?>
				            	</th>
				            	<th <?php if ($sort == 'createdon') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'createdon') { ?>
				                	<a href="<?php echo $sort_createdon; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_column_createdon; ?></a>
				                	<?php } else { ?>
				                	<a href="<?php echo $sort_createdon; ?>"><?php echo $text_column_createdon; ?></a>
				                	<?php } ?>
				            	</th>
				            	
								<th><?php echo $text_column_action; ?></th>
				            </tr>
				          </thead>
				          <tbody>
				          	<?php if ($trainings) { ?>
				            <?php foreach ($trainings as $training) { ?>
				            <tr>
				              <td style="text-align: center;"><?php if ($training['selected']) { ?>
				                <input type="checkbox" name="selected[]" value="<?php echo $training['id']; ?>" class="selectedId" checked="checked" />
				                <?php } else { ?>
				                <input type="checkbox" name="selected[]" value="<?php echo $training['id']; ?>" class="selectedId" />
				                <?php } ?></td>
				              <td class="left"><?php echo $training['training_title']; ?></td>
				              <td class="left"><?php echo $training['training_type']; ?></td>
				              <td class="left"><?php echo $training['training_time']; ?></td>
				              <td class="left"><?php echo $training['training_duration']; ?></td>
				              <td class="left"><?php echo $training['training_location']; ?></td>
				              <td class="left"><?php echo $training['training_cost']; ?></td>
				              <td class="left"><?php echo $training['training_instructor']; ?></td>
				              <td class="left"><?php echo $training['createdon']; ?></td>
				              <td class="right"><?php foreach ($training['action'] as $action) { ?>
				                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
				                <?php } ?></td>
				            </tr>
				            <?php } ?>
				            <?php } else { ?>
				            <tr>
				              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
				            </tr>
				            <?php } ?>
				          </tbody>
				        </table>
				        </form>
				        <div class="pagination"><?php echo $pagination; ?></div>
					</div>
				</div>
<!-- END PAGE CONTENT-->
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=training/training&token=<?php echo $token; ?>';
	
	var filter_training_title = $('input[name=\'filter_training_title\']').attr('value');
	
	if (filter_training_title) {
		url += '&filter_training_title=' + encodeURIComponent(filter_training_title);
	}
	
	var filter_training_type = $('input[name=\'filter_training_type\']').attr('value');
	
	if (filter_training_type) {
		url += '&filter_training_type=' + encodeURIComponent(filter_training_type);
	}
	
	var filter_training_time = $('input[name=\'filter_training_time\']').attr('value');
	
	if (filter_training_time) {
		url += '&filter_training_time=' + encodeURIComponent(filter_training_time);
	}
	
	var filter_training_location = $('input[name=\'filter_training_location\']').attr('value');
	
	if (filter_training_location) {
		url += '&filter_training_location=' + encodeURIComponent(filter_training_location);
	}
	
	var filter_training_duration = $('input[name=\'filter_training_duration\']').attr('value');
	
	if (filter_training_duration) {
		url += '&filter_training_duration=' + encodeURIComponent(filter_training_duration);
	}
	
	var filter_training_cost = $('input[name=\'filter_training_cost\']').attr('value');
	
	if (filter_training_cost) {
		url += '&filter_training_cost=' + encodeURIComponent(filter_training_cost);
	}
	
	var filter_training_instructor = $('input[name=\'filter_training_instructor\']').attr('value');
	
	if (filter_training_instructor) {
		url += '&filter_training_instructor=' + encodeURIComponent(filter_training_instructor);
	}
	
	var filter_createdon = $('input[name=\'filter_createdon\']').attr('value');
	
	if (filter_createdon) {
		url += '&filter_createdon=' + encodeURIComponent(filter_createdon);
	}
	
		

	location = url;
}
//--></script> 
<style>
 table.table thead .sorting_desc
 {
 	background : url("assets/data-tables/images/sort_desc.png") no-repeat scroll right center rgba(0, 0, 0, 0);
 }
table.table thead .sorting_asc
 {
 	background : url("assets/data-tables/images/sort_asc.png") no-repeat scroll right center rgba(0, 0, 0, 0);
 }
 table.table tbody tr.filter td input{
 	width:120px;
 }
</style>
<?php echo $footer; ?> 