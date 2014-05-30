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
				              <th <?php if ($sort == 'trng_name') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'trng_name') { ?>
				                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
				                <?php } else { ?>
				                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
				                <?php } ?></th>
								<th <?php if ($sort == 'trng_type') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'trng_type') { ?>
				                <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_type; ?></a>
				                <?php } else { ?>
				                <a href="<?php echo $sort_type; ?>"><?php echo $column_type; ?></a>
				                <?php } ?></th>
				          	  <th <?php if ($sort == 'trng_date') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'trng_date') { ?>
				                <a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
				                <?php } else { ?>
				                <a href="<?php echo $sort_date; ?>"><?php echo $column_date; ?></a>
				                <?php } ?></th>
				             
				              <th><?php echo $column_duration; ?></th>
				              
				              <th <?php if ($sort == 'trng_location') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>><?php if ($sort == 'trng_location') { ?>
				                <a href="<?php echo $sort_location; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_location; ?></a>
				                <?php } else { ?>
				                <a href="<?php echo $sort_location; ?>"><?php echo $column_location; ?></a>
				                <?php } ?></th>
				              <th><?php echo $column_action; ?></th>
				            </tr>
				          </thead>
				          <tbody>
				            <?php if ($trainings) { ?>
				            <?php foreach ($trainings as $training) { ?>
				            <tr>
				              <td style="text-align: center;"><?php if ($training['selected']) { ?>
				                <input type="checkbox" name="selected[]" value="<?php echo $training['code']; ?>" class="selectedId" checked="checked" />
				                <?php } else { ?>
				                <input type="checkbox" name="selected[]" value="<?php echo $training['code']; ?>" class="selectedId" />
				                <?php } ?></td>
				              <td class="left"><?php echo $training['name']; ?></td>
				              <td class="left"><?php echo $training['type']; ?></td>
				              <td class="left"><?php echo $training['date']; ?></td>
				              <td class="left"><?php echo $training['duration']; ?></td>
				              <td class="left"><?php echo $training['location']; ?></td>
				              <td class="right"><?php foreach ($training['action'] as $action) { ?>
				                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
				                <?php } ?></td>
				            </tr>
				            <?php } ?>
				            <?php } else { ?>
				            <tr>
				              <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
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