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
elseif($_REQUEST['mode']=='view')					       			disphtml("view_data();");
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
		$sql="SELECT count(*) AS CNT FROM supplier WHERE name like '".$_POST[txt_alpha]."%' ";
		$row=mysql_fetch_array(mysql_query($sql));
		$count=$row['CNT'];
		$sql="select * FROM supplier where name like '".$_POST[txt_alpha]."%' ORDER BY  created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
	}
	if ($_POST[search_mode]=="SEARCH")
	{	
		$sql="SELECT count(*) AS CNT FROM supplier WHERE ".$_POST['search_type']." like '".$_POST[txt_search]."%' ";
		$row=mysql_fetch_array(mysql_query($sql));
		$count=$row['CNT'];
		$sql="SELECT * FROM supplier WHERE ".$_POST['search_type']." like '".$_POST[txt_search]."%' ORDER BY created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
	}
	
	if ($_POST[search_mode]=="")
	{
		$sql="SELECT * FROM supplier ORDER BY created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
		$row=mysql_fetch_array(mysql_query("select count(*) as CNT FROM supplier"));
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
                    		Supplier Management
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Supplier Management</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Manage Supplier</a></li>
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
                        <h4><i class="icon-reorder"></i>Supplier Search Panel</h4>
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
                                    <select name="search_type" class="medium m-wrap" tabindex="1">
                                    <option value="">Select One</option>
                                    <option value="name"  <? if($_POST[search_type]=="name") echo "selected" ?>>Name</option>
                                    </select>
                                &nbsp;&nbsp;
                                    <input tabindex="2" name="txt_search" class="m-wrap medium" type="text"  value="<?=stripslashes($_REQUEST['txt_search']);?>">
                                &nbsp;&nbsp;
                                    <input type="button" tabindex="3" class="btn red" onClick="search_text()" value="Search"  style="margin-bottom:10px;">
                               		<input name="btnShowAll" tabindex="4" type="button" class="btn black" value="Show All" onClick="javascript:show_all();" style="margin-bottom:10px;">
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
                                <h4><i class="icon-reorder"></i>Supplier List</h4>
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
                                        <th width="2%">#</th>
                                        <th width="20%" valign="top" align="left">Name</th>
                                        <th width="20%" valign="top" align="left">Address</th>
                                        <th width="18%" valign="top" align="center">Phone No</th>
                                        <th width="10%" valign="top" align="center">View</th>
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
                                <td align="left" valign="top" ><a href="<?=$currentPage?>?mode=view&row_id=<?=$row['supplier_id']?>"><?=stripslashes($row['name'])?></a></td>
                                <td align="left" valign="top" ><?=stripslashes($row['address'])?></td>
                                <td align="center" valign="top" ><?=stripslashes($row['phone'])?></td>
                                <td align="center" valign="top"  ><a  class="btn mini purple" href="<?=$currentPage?>?mode=view&row_id=<?=$row['supplier_id']?>"><i class="icon-search"></i> View</a></td>
                                <td align="center" valign="top"  >
                                <? if(stripslashes($row['status'])=='Active') {?>
                                <a class="btn mini green" href="javascript:void(0);" onclick="ChangeStatus(<?=$row['supplier_id']?>,<?=$GLOBALS[start]?>,'<?=$row['status']?>')"><i class="icon-unlock"></i> Unlocked</a>
                                <?php }
                                else {?>
                                <a class="btn mini red" href="javascript:void(0);" onclick="ChangeStatus(<?=$row['supplier_id']?>,<?=$GLOBALS[start]?>,'<?=$row['status']?>')"><i class="icon-lock"></i> Locked</a>
                                <?php } ?>
                                </td>
                                <td valign="top" align="center" width="8%" ><a class="btn mini blue" href="javascript:void(0);" onclick="Edit('<?=$row['supplier_id'];?>','<?=$GLOBALS[start]?>');"> <i class="icon-edit"></i> Edit </a>
                                </td>
                                <td align="center" valign="top" >
                                <a class="btn mini red" href="javascript:void(0);" onclick="Delete(<?=$row['supplier_id'];?>,<?=$GLOBALS[start]?>)">
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
		
		$sql="SELECT * FROM `supplier` WHERE supplier_id = ".$row_id;   
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
	if(document.frmedit.name.value=='')
	{
		alert('Please enter name');
		document.frmedit.name.focus();
		return false;
	}
	if(document.frmedit.address.value=='')
	{
		alert('Please enter address');
		document.frmedit.address.focus();
		return false;
	}
	if(document.frmedit.phone.value=='')
	{
		alert('Please enter phone');
		document.frmedit.phone.focus();
		return false;
	}
}
function cancel(){ 
		window.location.href = 'manage_supplier.html';
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
                    		Supplier Management
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Supplier Management</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#"><?=$current_mode?> Supplier</a></li>
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
                        <h4><i class="icon-reorder"></i><?=$current_mode?> Supplier</h4>
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
                              <label class="control-label" >Name <font color="#FF0000">*</font></label>
                              <div class="controls">
                               <input tabindex="1" type="text" name="name" id="name"  class="m-wrap large" value="<?=trim(stripslashes($rec['name']))?>"  />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label" >Address <font color="#FF0000">*</font></label>
                              <div class="controls">
                                <textarea  tabindex="2" rows="3" name="address" id="address" class="m-wrap large" style="width: 320px; height: 69px; resize:none;"><?=trim(stripslashes($rec['address']))?></textarea>
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label" >Phone No <font color="#FF0000">*</font></label>
                              <div class="controls">
                                <input tabindex="3" type="text" name="phone" id="phone"  class="m-wrap large" value="<?=trim(stripslashes($rec['phone']))?>"  />
                              </div>
                           </div>
                            <div class="control-group">
                              <label class="control-label" >Remarks</label>
                              <div class="controls">
                                <textarea tabindex="4" rows="3" name="remarks" id="remarks" class="m-wrap large" style="width: 320px; height: 69px; resize:none;"><?=trim(stripslashes($rec['remarks']))?></textarea>
                              </div>
                           </div>
                           
                           <div class="form-actions">
                              <button tabindex="5" type="submit" class="btn red">Submit</button>
                              <button tabindex="6"v type="button" class="btn black" onclick="cancel();">Cancel</button>
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
function view_data()
{
	$sql_view="SELECT * FROM supplier WHERE supplier_id =".$_REQUEST['row_id'];
	$row_view=mysql_fetch_array(mysql_query($sql_view)) or die(mysql_error());
?>	
<div class="container-fluid">
<div class="row-fluid">
					<div class="span12">
                     	<!-- BEGIN STYLE CUSTOMIZER -->
                 		 <?php include("theme_colour.php");?>
                 		<!-- END BEGIN STYLE CUSTOMIZER --> 
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
                    		Supplier Management
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Supplier Management</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">View Supplier</a></li>
                  </ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
<div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN SAMPLE FORM PORTLET-->   
                  <div class="portlet box red">
                     <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>View Supplier</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="reload"></a>
                        </div>
                     </div>
                      <div class="portlet-body">
                     <table width="100%" border="0" cellspacing="2" cellpadding="5" style="font-size:14px">
                           <tr>
                            <td width="13%">Name: </td>
                            <td width="87%"> <?=stripslashes($row_view['name'])?></td>
                          </tr>
                           <tr>
                            <td>Address: </td>
                            <td> <?=stripslashes($row_view['address'])?></td>
                          </tr>
                           <tr>
                            <td>Phone No: </td>
                            <td> <?=stripslashes($row_view['phone'])?></td>
                          </tr>
                           <tr>
                            <td>Remarks: </td>
                            <td> <?=stripslashes($row_view['remarks'])?></td>
                          </tr>
					</table> 
                    <div align="center" style="padding-top:20px;">
                              <button type="button" class="btn black" onclick="window.location.href='manage_supplier.html';">Back</button>
                     </div>
                    </div>
                  </div>
                  <!-- END SAMPLE FORM PORTLET-->
               </div>
            </div>
            </div>
<?php }
function update_record($row_id='')
{     
	if($row_id == '') 
	{
	   $id = 0;
	   
	   
			  $sql1  = "INSERT INTO supplier SET
						`name` 				= '".addslashes(trim($_REQUEST['name']))."',
						`address` 			= '".addslashes(trim($_REQUEST['address']))."',
						`phone` 		 	= '".addslashes(trim($_REQUEST['phone']))."',
						`remarks` 		 	= '".addslashes(trim($_REQUEST['remarks']))."',
						`created_date`    	= '".date('Y-m-d H:i:s')."'";
						
				   mysql_query($sql1) or die(mysql_error()." Error in insert.".$sql1);
						
			       $_SESSION['succ_msg'] = "Supplier has been successfully added.";
				   
				   header("Location:".$currentPage);
				   
				   exit();
	}
	else 
	{
		 $id = $row_id;
	
	 	 $sql1 = "update supplier SET
						`name` 				= '".addslashes(trim($_REQUEST['name']))."',
						`address` 			= '".addslashes(trim($_REQUEST['address']))."',
						`phone` 		 	= '".addslashes(trim($_REQUEST['phone']))."',
						`remarks` 		 	= '".addslashes(trim($_REQUEST['remarks']))."'
						 where supplier_id 	=  ".$id;
	  
		  mysql_query($sql1) or die(mysql_error()." Error in update.".$sql1);
		  
	      $_SESSION['succ_msg'] = "Supplier has been successfully updated.";
		  
		  disphtml("main();");	
		
	}
	
}
function audit_status($row_id='')
{	
	$sql = "UPDATE `supplier` SET status = if(status = 'Active','Inactive','Active') WHERE supplier_id = ".$row_id."";
	mysql_query($sql) or die(mysql_error().$sql);		
	if(mysql_affected_rows()>0) {
		$_SESSION['succ_msg'] = "Supplier status has been changed successfully.";
	}
	else {
		$_SESSION['err_msg'] = "Supplier status has not been changed.";
	}
	
	disphtml("main();");
}
function delete_record(){
	$id=$_REQUEST['row_id'];
	$del_subs=mysql_query("DELETE FROM `supplier` WHERE supplier_id = ".$id);
	if($del_subs) {
		$_SESSION['succ_msg'] = "Supplier successfully deleted.";
	}
	header("Location: manage_supplier.html");
	exit();
}

?>