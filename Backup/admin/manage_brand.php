<?
include("admin_utils.php");
$currentPage = $_SESSION['currentPage'];
$GLOBALS['show'] = 20;
if($_REQUEST['pageNo']=="")
{
	$GLOBALS['start'] = 0;
	$_REQUEST['pageNo'] = 1;
}
else
{
	$GLOBALS['start']=($_REQUEST['pageNo']-1) * $GLOBALS['show'];
}

if($_REQUEST['mode'] =='add' || $_REQUEST['mode'] =='edit')  		disphtml("show_add_edit($_POST[row_id]);");
elseif($_REQUEST['mode'] == 'update')							   	update_record($_POST[row_id]);
elseif($_REQUEST['mode']=='change_status')				   			audit_status($_REQUEST['row_id']);
elseif($_REQUEST['mode']=='delete_rec')			       				delete_record();
else											       				disphtml("main();");
ob_end_flush();	
function main()
{
		if($_REQUEST[hold_page] > 0)   	$GLOBALS[start] = $_REQUEST[hold_page];
		if($count == $GLOBALS[start])  	$GLOBALS[start] = $GLOBALS[start] - $GLOBALS[show];
		if($GLOBALS[start] < 0)			$GLOBALS[start] = 0;
		
	
	if ($_POST[search_mode]=="ALPHA")
	{
		$sql="SELECT count(*) AS CNT FROM brand WHERE brand_name like '".$_POST[txt_alpha]."%' ";
		$row=mysql_fetch_array(mysql_query($sql));
		$count=$row['CNT'];
		$sql="select * FROM brand where brand_name like '".$_POST[txt_alpha]."%' ORDER BY  created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
	}
	if ($_POST[search_mode]=="SEARCH")
	{	
		$sql="SELECT count(*) AS CNT FROM brand WHERE ".$_POST['search_type']." like '".$_POST[txt_search]."%' ";
		$row=mysql_fetch_array(mysql_query($sql));
		$count=$row['CNT'];
		$sql="SELECT * FROM brand WHERE ".$_POST['search_type']." like '".$_POST[txt_search]."%' ORDER BY created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
	}
	
	if ($_POST[search_mode]=="")
	{
		$sql="SELECT * FROM brand ORDER BY created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
		$row=mysql_fetch_array(mysql_query("select count(*) as CNT FROM brand"));
		$count=$row['CNT'];
	}
	
	$rs=mysql_query($sql) or die(mysql_error()." Error : ".$sql);	
?>
<script language="JavaScript" type="text/javascript">

function show_all()
{
	document.frmSearch.search_mode.value = "";	
	document.frmSearch.txt_search.value="";
	document.frmSearch.txt_alpha.value="";
	document.frmSearch.search_type.value="";
	document.frmSearch.submit();	
}	
function search_text()
{
	if(document.frmSearch.search_type.value=="")
	{
		alert("Select a search type.");
		document.frmSearch.search_type.focus();
		return false;
	}
	
	if(document.frmSearch.txt_search.value.search(/\S/)==-1)
	{
		alert("Enter search text.");
		document.frmSearch.txt_search.focus();
		return false;
	}
	document.frmSearch.search_mode.value = "SEARCH";
	document.frmSearch.submit();
}
function search_alpha(alpha)
{
	document.frmSearch.search_mode.value = "ALPHA";
	document.frmSearch.txt_search.value = '';
	document.frmSearch.txt_alpha.value = alpha;
	document.frmSearch.submit();
}	
</script>
<script language="javascript">
function Add()
{
	document.frm_opts.mode.value="add";
	document.frm_opts.row_id.value="";
	document.frm_opts.submit();
}
function Edit(ID,record_no)
{
	document.frm_opts.mode.value='edit';
	document.frm_opts.row_id.value=ID;
	document.frm_opts.hold_page.value = record_no*1;
	document.frm_opts.submit();
}
function Delete(ID,record_no)
{
	var UserResp = window.confirm("Are you sure to remove this?");
	if( UserResp == true )
	{
		document.frm_opts.mode.value='delete_rec';
		document.frm_opts.row_id.value=ID;
		document.frm_opts.hold_page.value = record_no*1;
		document.frm_opts.submit();
	}
}
function ChangeStatus(ID,record_no,is_active)
{
		document.frm_opts.mode.value='change_status';
		document.frm_opts.row_id.value=ID;
		document.frm_opts.hold_page.value = record_no*1;
		document.frm_opts.submit();
}
</script>
<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
                    	 <!-- BEGIN STYLE CUSTOMIZER -->
                 		 <?php include("theme_colour.php");?>
                 		<!-- END BEGIN STYLE CUSTOMIZER -->  
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
                    		Product Brand Management
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Product Brand Management</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Manage Product Brand</a></li>
                  </ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
                <?php if($_SESSION['succ_msg']!='') { ?>
                <div class="alert alert-success">
									<button data-dismiss="alert" class="close"></button>
									<strong>Success!</strong> <?=$_SESSION['succ_msg']; unset($_SESSION['succ_msg']);?>
				</div>
                <?php } ?>
                <?php if($_SESSION['err_msg']!='') {
				 ?>
                <div class="alert alert-error">
									<button data-dismiss="alert" class="close"></button>
									<strong>Error!</strong> <?=$_SESSION['err_msg']; unset($_SESSION['err_msg']);?>
				</div>
                 <?php } ?>
				<!-- END PAGE HEADER-->
				<div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box red">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Product Brand Search Panel</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="reload"></a>
                        </div>
                     </div>
                     <div class="portlet-body" style="padding:1px;">
                        <!-- BEGIN FORM-->
                        <form name = "frmSearch" method="post" action="">
                        <input type="hidden" name="search_mode" value="<?=$_POST['search_mode']?>">
                        <input type="hidden" name="txt_alpha" value="<?=$_POST['txt_alpha']?>">
                        <input type="hidden" name="mode_toggle" value="">
                        
                        <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1"  class="table table-hover">
                            <tr>
                                <td width="6%" align="right" valign="middle">Search By</td>
                                <td width="1%" align="center" valign="middle">:</td>
                                <td width="93%" align="left" valign="middle">
                                    <select tabindex="1" name="search_type" class="medium m-wrap" >
                                    <option value="">Select One</option>
                                    <option value="brand_name"  <? if($_POST[search_type]=="brand_name") echo "selected" ?>>Brand Name</option>
                                    </select>
                                &nbsp;&nbsp;
                                    <input tabindex="2" name="txt_search" class="m-wrap medium" type="text"  value="<?=stripslashes($_REQUEST['txt_search']);?>">
                                &nbsp;&nbsp;
                                    <input tabindex="3" type="button" class="btn red" onClick="search_text()" value="Search"  style="margin-bottom:10px;">
                               		<input tabindex="4" name="btnShowAll" type="button" class="btn black" value="Show All" onClick="javascript:show_all();" style="margin-bottom:10px;">
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="3" align="center" valign="top" style="text-align:center"><? DisplayAlphabet(); ?></td>
                            </tr>
                        </table>
                        </form>
                        <!-- END FORM-->  
                     </div>
                  </div>
                  <!-- END SAMPLE FORM PORTLET-->
                  
                  <!-- BEGIN BORDERED TABLE PORTLET-->
						<div class="portlet box red">
							<div class="portlet-title">
                                <h4><i class="icon-reorder"></i>Product Brand List</h4>
                                <div class="tools">
                                   <a href="javascript:;" class="collapse"></a>
                                   <a href="javascript:;" class="reload"></a>
                                </div>
                     		</div>
							<div class="portlet-body">
                                <form name="frm_opts" id="frm_opts" action="" method="POST">
                                <input type="hidden" name="mode" value="<?=$_POST['mode']?>">
                                <input type="hidden" name="pageNo" value="<?=$_POST['pageNo']?>">
                                <input type="hidden" name="url" value="<?=$currentPage?>">
                                <input type="hidden" name="row_id" value="">
                                <input type="hidden" name="id" value="">
                                <input type="hidden" name="search_type" value="<?=$_POST['search_type']?>">
                                <input type="hidden" name="search_mode" value="<?=$_POST['search_mode']?>">
                                <input type="hidden" name="txt_alpha" value="<?=$_POST['txt_alpha']?>">
                                <input type="hidden" name="txt_search" value="<?=$_POST['txt_search']?>">
                                <input type="hidden" name="hold_page" value="">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
                                        <th width="3%">#</th>
                                        <th width="67%" valign="top" align="left">Brand</th>
                                        <th width="10%" valign="top" align="center">Status</th>
                                        <th width="10%" valign="top" align="center">Edit</th>
                                        <th width="10%" valign="top" align="center">Delete</th>
										</tr>
									</thead>
									<tbody>
                                     <?php 
									   if($count == 0){ ?>
                                        <tr><td colspan="8" style="text-align:center">No records found.</td></tr>
                                      <?php } else { ?> 
									<?
                                    $cnt=$GLOBALS[start]+1;
                                    while($row=mysql_fetch_array($rs))
                                    {
 									?> 
                                <tr class="<?php echo ++$flag%2==0?"alternate_color1":"alternate_color2";?>" > 
                                <td align="center" valign="top" ><?=$cnt++ ?></td>
                                <td align="left" valign="top" ><?=stripslashes($row['brand_name'])?></td>
                                <td align="center" valign="top"  >
                                <? if(stripslashes($row['status'])=='Active') {?>
                                <a class="btn mini green" href="javascript:void(0);" onclick="ChangeStatus(<?=$row['brand_id']?>,<?=$GLOBALS[start]?>,'<?=$row['status']?>')"><i class="icon-unlock"></i> Unlocked</a>
                                <?php }
                                else {?>
                                <a class="btn mini red" href="javascript:void(0);" onclick="ChangeStatus(<?=$row['brand_id']?>,<?=$GLOBALS[start]?>,'<?=$row['status']?>')"><i class="icon-lock"></i> Locked</a>
                                <?php } ?>
                                </td>
                                <td valign="top" align="center" width="10%" ><a class="btn mini blue" href="javascript:void(0);" onclick="Edit('<?=$row['brand_id'];?>','<?=$GLOBALS[start]?>');"> <i class="icon-edit"></i> Edit </a>
                                </td>
                                <td align="center" valign="top" >
                                <a class="btn mini red" href="javascript:void(0);" onclick="Delete(<?=$row['brand_id'];?>,<?=$GLOBALS[start]?>)">
                                <i class="icon-trash"></i> Delete</a>
                                </td>
                                </tr>
                                        <?php } } ?>
									</tbody>
								</table>
                                </form>
                                <div class="pagination">
                                    <?
									if($count>0 && $count > $GLOBALS['show'])	
									{
									?>
										<table width="99%" align="center" border="0" cellpadding="5" cellspacing="2">
											<tr><td align="center">
											<?php pagination($count,"frm_opts"); ?>
											</td></tr>
										</table>
									<?
									}
								?>
                                </div>
							</div>
						</div>
				  <!-- END BORDERED TABLE PORTLET-->
                  
               </div>
            </div>
		</div>
	</div>
<? }
function show_add_edit($row_id = '')
{	

	if ($row_id == '') 
	{
		$current_mode = "Add";	
	}	
	else 
	{
		$current_mode = "Edit";		
		
		$sql="SELECT * FROM `brand` WHERE brand_id = ".$row_id;   
		$rs=mysql_query($sql) or die(mysql_error()." Error in show edit: ");
		$rec=mysql_fetch_array($rs);	
	}
	
?>
<script language="JavaScript" type="text/javascript">
function trim(str)
{
	return str.replace(/^\s+|\s+$/g,'');
}

function chkSubmit()
{
	if(document.frmedit.brand_name.value=='')
	{
		alert('Please enter brand name');
		document.frmedit.brand_name.focus();
		return false;
	}
}
function cancel(){ 
		window.location.href = 'manage_brand.html';
}
</script>
<div class="container-fluid">
<div class="row-fluid">
					<div class="span12">
                       <!-- BEGIN STYLE CUSTOMIZER -->
                 		 <?php include("theme_colour.php");?>
                 		<!-- END BEGIN STYLE CUSTOMIZER --> 
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
                    		Product Brand Management
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Product Brand Management</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#"><?=$current_mode?> Product Brand</a></li>
                  </ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
                 <?php if($_SESSION['succ_msg']!='') { ?>
                <div class="alert alert-success">
									<button data-dismiss="alert" class="close"></button>
									<strong>Success!</strong> <?=$_SESSION['succ_msg']; unset($_SESSION['succ_msg']);?>
				</div>
                <?php } ?>
                <?php if($_SESSION['err_msg']!='') {
				 ?>
                <div class="alert alert-error">
									<button data-dismiss="alert" class="close"></button>
									<strong>Error!</strong> <?=$_SESSION['err_msg']; unset($_SESSION['err_msg']);?>
				</div>
                 <?php } ?>
<div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box red">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i><?=$current_mode?> Product Brand</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="reload"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                         <form name="frmedit" method="post" class="form-horizontal form-bordered" action="" onSubmit="return chkSubmit();" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="update">
        <input type="hidden" name="current_mode" value="<?=$current_mode?>" />
        <input type="hidden" name="row_id" value="<?=$row_id?>" >
        <input type="hidden" name="pageNo" value="<?=$_REQUEST[pageNo]?>">
        <input type="hidden" name="url" value="<?=$currentPage?>">
        <input type="hidden" name="search_type" value="<?=$_REQUEST['search_type']?>">
        <input type="hidden" name="search_mode" value="<?=$_REQUEST['search_mode']?>">
        <input type="hidden" name="txt_alpha" value="<?=$_REQUEST['txt_alpha']?>">
        <input type="hidden" name="txt_search" value="<?=$_REQUEST['txt_search']?>">
        <input type="hidden" name="hold_page" value="<?=$_REQUEST['hold_page']?>">
                           
                           <div class="control-group">
                              <label class="control-label" >Brand Name <font color="#FF0000">*</font></label>
                              <div class="controls">
                               <input tabindex="1" type="text" name="brand_name" id="brand_name"  class="m-wrap large" value="<?=trim(stripslashes($rec['brand_name']))?>"  />
                              </div>
                           </div>
                          
                           <div class="form-actions">
                              <button tabindex="2" type="submit" class="btn red">Submit</button>
                              <button tabindex="3" type="button" class="btn black" onclick="cancel();">Cancel</button>
                           </div>
                        </form>

                        <!-- END FORM-->           
                     </div>
                  </div>
                  <!-- END SAMPLE FORM PORTLET-->
               </div>
            </div>
            </div>
<? 
}
function update_record($row_id='')
{     
	if($row_id == '') 
	{
	   $id = 0;
	   
	   
			  $sql1  = "INSERT INTO brand SET
						`brand_name` 		= '".addslashes(trim($_REQUEST['brand_name']))."',
						`created_date`    	= '".date('Y-m-d H:i:s')."'";
						
				   mysql_query($sql1) or die(mysql_error()." Error in insert.".$sql1);
						
			       $_SESSION['succ_msg'] = "Product Brand has been successfully added.";
				   
				   header("Location:".$currentPage);
				   
				   exit();
	}
	else 
	{
		 $id = $row_id;
	
	 			 $sql1 = "update brand SET
						`brand_name` 		= '".addslashes(trim($_REQUEST['brand_name']))."'
						 where brand_id 	=  ".$id;
	  
		  mysql_query($sql1) or die(mysql_error()." Error in update.".$sql1);
		  
	      $_SESSION['succ_msg'] = "Product Brand has been successfully updated.";
		  
		  disphtml("main();");
		
	}

	
}
function audit_status($row_id='')
{	
	$sql = "UPDATE `brand` SET status = if(status = 'Active','Inactive','Active') WHERE brand_id = ".$row_id."";
	mysql_query($sql) or die(mysql_error().$sql);		
	if(mysql_affected_rows()>0) {
		$_SESSION['succ_msg'] = "Product Brand status has been changed successfully.";
	}
	else {
		$_SESSION['err_msg'] = "Product Brand status has not been changed.";
	}
	
	disphtml("main();");
}
function delete_record(){
	$id=$_REQUEST['row_id'];
	$del_subs=mysql_query("DELETE FROM `brand` WHERE brand_id = ".$id);
	if($del_subs) {
		$_SESSION['succ_msg'] = "Product Brand successfully deleted.";
	}
	header("location:".$currentPage);
	exit();
}

?>