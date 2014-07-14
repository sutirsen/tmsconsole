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
						 <table class="table table-hover table-bordered table-striped">
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
<style>
 table.table thead .sorting_desc
 {
 	background : url("assets/data-tables/images/sort_desc.png") no-repeat scroll right center rgba(0, 0, 0, 0);
 }
table.table thead .sorting_asc
 {
 	background : url("assets/data-tables/images/sort_asc.png") no-repeat scroll right center rgba(0, 0, 0, 0);
 }
</style>
<?php echo $footer; ?> 