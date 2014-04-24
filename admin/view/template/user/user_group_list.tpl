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
									<?php echo $success; ?>
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
					  </div>
					  <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
						 <table class="table table-hover table-bordered table-striped">
				          <thead>
				           <tr>
				              <th width="1" style="text-align: center;"><input type="checkbox" id="selectall" /></th>
				              <th <?php if ($sort == 'name') { ?> class="sorting_<?php echo strtolower($order); ?>"<?php } ?>> <?php if ($sort == 'name') { ?>
				                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
				                <?php } else { ?>
				                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
				                <?php } ?></th>
				              <th><?php echo $column_action; ?></th>
				            </tr>
				          </thead>
				          <tbody>
				            <?php if ($user_groups) { ?>
				            <?php foreach ($user_groups as $user_group) { ?>
				            <tr>
				              <td style="text-align: center;"><?php if ($user_group['selected']) { ?>
				                <input type="checkbox" name="selected[]" value="<?php echo $user_group['user_group_id']; ?>" class="selectedId" checked="checked" />
				                <?php } else { ?>
				                <input type="checkbox" name="selected[]" value="<?php echo $user_group['user_group_id']; ?>" class="selectedId" />
				                <?php } ?></td>
				              <td class="left"><?php echo $user_group['name']; ?></td>
				              <td class="right"><?php foreach ($user_group['action'] as $action) { ?>
				                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
				                <?php } ?></td>
				            </tr>
				            <?php } ?>
				            <?php } else { ?>
				            <tr>
				              <td class="center" colspan="3"><?php echo $text_no_results; ?></td>
				            </tr>
				            <?php } ?>
				          </tbody>
				         </table>
				      </form>
				      <div class="pagination"><?php echo $pagination; ?></div>
					</div>
				</div>
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