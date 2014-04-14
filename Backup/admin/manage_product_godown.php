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
		$sql="SELECT count(*) AS CNT FROM product_godown WHERE product_name like '".$_POST[txt_alpha]."%' ";
		$row=mysql_fetch_array(mysql_query($sql));
		$count=$row['CNT'];
		$sql="select * FROM product_godown where product_name like '".$_POST[txt_alpha]."%' ORDER BY  created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
	}
	if ($_POST[search_mode]=="SEARCH")
	{	
		$sql="SELECT count(*) AS CNT FROM product_godown WHERE ".$_POST['search_type']." like '".$_POST[txt_search]."%' ";
		$row=mysql_fetch_array(mysql_query($sql));
		$count=$row['CNT'];
		$sql="SELECT * FROM product_godown WHERE ".$_POST['search_type']." like '".$_POST[txt_search]."%' ORDER BY created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
	}
	
	if ($_POST[search_mode]=="")
	{
		$sql="SELECT * FROM product_godown ORDER BY created_date ASC LIMIT ".$GLOBALS[start].",".$GLOBALS[show];
		$row=mysql_fetch_array(mysql_query("select count(*) as CNT FROM product_godown"));
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
                    		Product Management
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Product Management</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Manage Product</a></li>
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
                        <h4><i class="icon-reorder"></i>Product Search – Product Purchase at Godown</h4>
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
                                    <select name="search_type" class="medium m-wrap" >
                                    <option value="">Select One</option>
                                    <option value="product_name"  <? if($_POST[search_type]=="product_name") echo "selected" ?>>Product Name</option>
                                    </select>
                                &nbsp;&nbsp;
                                    <input name="txt_search" class="m-wrap medium" type="text"  value="<?=stripslashes($_REQUEST['txt_search']);?>">
                                &nbsp;&nbsp;
                                    <input type="button" class="btn red" onClick="search_text()" value="Search"  style="margin-bottom:10px;">
                               		<input name="btnShowAll" type="button" class="btn black" value="Show All" onClick="javascript:show_all();" style="margin-bottom:10px;">
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
                                <h4><i class="icon-reorder"></i>Product List</h4>
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
                                        <th width="20%" valign="top" align="left">Product Name</th>
                                        <th width="20%" valign="top" align="left">Brand Name</th>
                                        <th width="27%" valign="top" align="left">Total Stock</th>
                                        <th width="10%" valign="top" align="left">Date</th>
                                        <th width="10%" valign="top" align="center">Edit</th>
                                        <th width="10%" valign="top" align="center">Delete</th>
										</tr>
									</thead>
									<tbody>
                                     <?php 
									   if($count == 0){ ?>
                                        <tr><td colspan="10" style="text-align:center">No records found.</td></tr>
                                      <?php } else { ?> 
									<?
                                    $cnt=$GLOBALS[start]+1;
                                    while($row=mysql_fetch_array($rs))
                                    {
 									?> 
                                <tr class="<?php echo ++$flag%2==0?"alternate_color1":"alternate_color2";?>" > 
                                <td align="center" valign="top" ><?=$cnt++ ?></td>
                                <td align="left" valign="top" ><?=stripslashes($row['product_name'])?></td>
                                <td align="left" valign="top" >
                                <?php
									$brandRw = mysql_fetch_array(mysql_query("select * from brand where brand_id='".$row['brand_id']."'"));
									echo stripslashes($brandRw['brand_name'])
								?>
                                </td>
                                <td align="left" valign="top" >
								<style>
                                .m-wrap.small {
                                	width: 90px !important;
                                }
                                </style>
                                <table width="400" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000; border-collapse:separate">
                                <thead>
										<tr>
                                        <th valign="top" align="center" style="text-align:center; font-size:12px;">Category</th>
                                        <th valign="top" align="center" style="text-align:center; font-size:12px;">Quantity</th>
                                        <th valign="top" align="center" style="text-align:center; font-size:12px;">Rate</th>
										</tr>
								</thead>
                                <tr>
                                    <td width="61" align="left" valign="top" style="padding:2px; text-align:center;">2000ML</td>
                                    <td width="61" align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_2000'])?></td>
                                    <td width="270" align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_2000'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div></td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">1000ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_1000'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_1000'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">750ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_750'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_750'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">650ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_650'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_650'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">500ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_500'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_500'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">375ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_375'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_375'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">275ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_275'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_275'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">200ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_200'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_200'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">180ML</td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;"><?=stripslashes($row['qty_180'])?></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['rate_180'])?>"  disabled="disabled"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td colspan="2" align="left" valign="top" style="padding:2px; text-align:right; padding-right:10px; font-size:12px"><strong>Total Amount</strong></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['total_amount'])?>"  disabled="disabled"/><span class="add-on">/-</span>
                                    </div></td>
                                </tr>
                                 <tr>
                                   <td colspan="2" align="left" valign="top" style="padding:2px; text-align:right; padding-right:10px; font-size:12px"><strong>Discount</strong></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['discount'])?>"  disabled="disabled"/><span class="add-on">/-</span>
                                    </div></td>
                                </tr>
                                 <tr>
                                    <td colspan="2" align="left" valign="top" style="padding:2px; text-align:right; padding-right:10px; font-size:12px"><strong>Total Amount after Discount</strong></td>
                                    <td align="left" valign="top" style="padding:2px; text-align:center;">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" class="m-wrap small" value="<?=stripslashes($row['total_amount_after_discount'])?>"  disabled="disabled"/><span class="add-on">/-</span>
                                    </div></td>
                                </tr>
                                </table>
                                </td>
                                <td align="left" valign="top" ><?=date('d-m-Y',strtotime($row['created_date']))?></td>
                                <td valign="top" align="center" width="11%" ><a class="btn mini blue" href="javascript:void(0);" onclick="Edit('<?=$row['product_godown_id'];?>','<?=$GLOBALS[start]?>');"> <i class="icon-edit"></i> Edit </a>
                                </td>
                                <td align="center" valign="top" >
                                <a class="btn mini red" href="javascript:void(0);" onclick="Delete(<?=$row['product_godown_id'];?>,<?=$GLOBALS[start]?>)">
                                <i class="icon-trash"></i> Delete</a>
                                </td>
                                </tr>
                                        <?php } } ?>
									</tbody>
								</table>
                                </form>
                                <div class="pagination">
                                    <?php
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
		
		$sql="SELECT * FROM `product_godown` WHERE product_godown_id = ".$row_id;   
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
	if(document.frmedit.stock_type.value=='')
	{
		alert('Please select stock type');
		document.frmedit.stock_type.focus();
		return false;
	}
	if(document.frmedit.product_name.value=='')
	{
		alert('Please enter product name');
		document.frmedit.product_name.focus();
		return false;
	}
	if(document.frmedit.brand_id.value=='')
	{
		alert('Please select brand name');
		document.frmedit.brand_id.focus();
		return false;
	}
	if(document.frmedit.supplier_id.value=='')
	{
		alert('Please select supplier name');
		document.frmedit.supplier_id.focus();
		return false;
	}
	if(document.frmedit.invoice_no.value=='')
	{
		alert('Please enter invoice no');
		document.frmedit.invoice_no.focus();
		return false;
	}
	if(document.frmedit.invoice_date.value=='')
	{
		alert('Please enter invoice date');
		document.frmedit.invoice_date.focus();
		return false;
	}
	if(document.frmedit.bottle_qty.value=='')
	{
		alert('Please enter bottle quantity');
		document.frmedit.bottle_qty.focus();
		return false;
	}
	var countBottle = countTotalBottle();
	if(countBottle == '0')
	{
		alert('Quantity in bottles is not matching with category wise bottle quantity');
		document.frmedit.bottle_qty.focus();
		return false;
	}
}
function cancel(){ 
		window.location.href = 'manage_product_godown.html';
}
</script>
<script language="JavaScript" type="text/javascript">
        function addRow(tableID) {
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
				//console.log(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    
                }
            }
        }
</script>
<script>
      function isNumberKey(evt) 
	  {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  function getId(val)
	  {
		  return parseFloat(document.getElementById(val).value);
	  }
	  function calculateTotalRate(qty,rate)
	  {
		  var total = 0;
		  total 	= parseFloat(qty * rate);
		  return total;
	  }
	  function calculateTotal()
	  {
		  var qty_2000 		= getId('qty_2000') ? getId('qty_2000') : 0;
		  var rate_2000 	= getId('rate_2000') ? getId('rate_2000') : 0;
		  var total_2000 	= calculateTotalRate(qty_2000,rate_2000);
		  
		  var qty_1000 		= getId('qty_1000') ? getId('qty_1000') : 0;
		  var rate_1000 	= getId('rate_1000') ? getId('rate_1000') : 0;
		  var total_1000 	= calculateTotalRate(qty_1000,rate_1000);
		  
		  var qty_750 		= getId('qty_750') ? getId('qty_750') : 0;
		  var rate_750 		= getId('rate_750') ? getId('rate_750') : 0;
		  var total_750 	= calculateTotalRate(qty_750,rate_750);
		  
		  var qty_650 		= getId('qty_650') ? getId('qty_650') : 0;
		  var rate_650 		= getId('rate_650') ?getId('rate_650') : 0;
		  var total_650 	= calculateTotalRate(qty_650,rate_650);
		  
		  var qty_500 		= getId('qty_500') ? getId('qty_500') : 0;
		  var rate_500 		= getId('rate_500') ? getId('rate_500') : 0;
		  var total_500 	= calculateTotalRate(qty_500,rate_500);
		  
		  var qty_375 		= getId('qty_375') ? getId('qty_375') : 0;
		  var rate_375 		= getId('rate_375') ? getId('rate_375') : 0;
		  var total_375 	= calculateTotalRate(qty_375,rate_375);
		  
		  var qty_275 		= getId('qty_275') ? getId('qty_275') : 0;
		  var rate_275 		= getId('rate_275') ? getId('rate_275') : 0;
		  var total_275		= calculateTotalRate(qty_275,rate_275);
		  
		  var qty_200 		= getId('qty_200') ? getId('qty_200') : 0;
		  var rate_200 		= getId('rate_200') ? getId('rate_200') : 0;
		  var total_200 	= calculateTotalRate(qty_200,rate_200);
		  
		  var qty_180 		= getId('qty_180') ? getId('qty_180') : 0;
		  var rate_180 		= getId('rate_180') ? getId('rate_180') : 0;
		  var total_180 	= calculateTotalRate(qty_180,rate_180);
		  
		  var total_amount 	= total_2000 + total_1000 + total_750 + total_650 + total_500 + total_375 + total_275 + total_200 + total_180;
		  total_amount 		= total_amount.toFixed(2);
		  
		  document.getElementById('rate_2000').value = rate_2000.toFixed(2);
	      document.getElementById('rate_1000').value = rate_1000.toFixed(2);
		  document.getElementById('rate_750').value  = rate_750.toFixed(2);
		  document.getElementById('rate_650').value  = rate_650.toFixed(2);
		  document.getElementById('rate_500').value  = rate_500.toFixed(2);
		  document.getElementById('rate_375').value  = rate_375.toFixed(2);
		  document.getElementById('rate_275').value  = rate_275.toFixed(2);
		  document.getElementById('rate_200').value  = rate_200.toFixed(2);
		  document.getElementById('rate_180').value  = rate_180.toFixed(2);
			
		  document.getElementById('total_amount').value = total_amount;
		  calculateDiscount();
	  }
	  function calculateDiscount()
	  {
		 var total_amount 	= getId('total_amount') ? getId('total_amount') : 0;
		 var discount 		= getId('discount') ? getId('discount') : 0; 
		 
		 var total_amount_after_discount = total_amount - discount;
		 total_amount_after_discount = total_amount_after_discount.toFixed(2);
		 
		 document.getElementById('discount').value = discount.toFixed(2);
		 document.getElementById('total_amount_after_discount').value = total_amount_after_discount;
	  }
	  
	  function countTotalBottle()
	  {
			var qty_2000 		= getId('qty_2000') ? getId('qty_2000') : 0;
			var qty_1000 		= getId('qty_1000') ? getId('qty_1000') : 0;
			var qty_750 		= getId('qty_750') ? getId('qty_750') : 0;
			var qty_650 		= getId('qty_650') ? getId('qty_650') : 0;
			var qty_500 		= getId('qty_500') ? getId('qty_500') : 0;
			var qty_375 		= getId('qty_375') ? getId('qty_375') : 0;
			var qty_275 		= getId('qty_275') ? getId('qty_275') : 0;
			var qty_200 		= getId('qty_200') ? getId('qty_200') : 0;
			var qty_180 		= getId('qty_180') ? getId('qty_180') : 0;
			
			var bottle_qty		= getId('bottle_qty') ? getId('bottle_qty') : 0;
			var total_bottle 	= qty_2000 + qty_1000 + qty_750 + qty_650 + qty_500 + qty_375 + qty_275 + qty_200 + qty_180;
			
			if(total_bottle != bottle_qty)
			{
				return 0;
			}
			else
			{
				return 1;
			}
	  }
</script>
<style>
.form-horizontal .control-label {
    width: 200px;
}
.form-horizontal .controls {
    margin-left: 220px;
}
</style>
<div class="container-fluid">
<div class="row-fluid">
					<div class="span12">
                       <!-- BEGIN STYLE CUSTOMIZER -->
                 		 <?php include("theme_colour.php");?>
                 		<!-- END BEGIN STYLE CUSTOMIZER --> 
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
                    		Product Management
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Product Management</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#"><?=$current_mode?> Product</a></li>
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
                        <h4><i class="icon-reorder"></i><?=$current_mode?> Product</h4>
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
                              <label class="control-label" >Stock Type <font color="#FF0000">*</font></label>
                              <div class="controls">
                               <select tabindex="1" class="large m-wrap" name="stock_type" id="stock_type">
                               				 <option value="">Select</option>	
                                             <option value="Opening Balance" <?php if($rec['stock_type'] == 'Opening Balance') { echo "selected = 'selected'"; } ?>>Opening Balance</option>
                                             <option value="Purchase" <?php if($rec['stock_type'] == 'Purchase') { echo "selected = 'selected'"; } ?>>Purchase</option>
                                </select>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" >Product Name <font color="#FF0000">*</font></label>
                              <div class="controls">
                               <input type="text" tabindex="2" name="product_name" id="product_name"  class="m-wrap large" value="<?=stripslashes($rec['product_name'])?>"  />
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label" >Brand Name <font color="#FF0000">*</font></label>
                              <div class="controls">
							<?php
								$brandSql="select * from brand where status = 'Active' order by brand_name asc";
								$brandResult=mysql_query($brandSql) or die(mysql_error());
                            ?>
                               <select tabindex="3" class="large m-wrap" name="brand_id" id="brand_id">
                               				 <option value="">Select</option>	
                               <?php
									while($brandRow=mysql_fetch_array($brandResult))
									{
								?>               
                                             <option value="<?=$brandRow['brand_id']?>" <?php if($brandRow['brand_id'] == $rec['brand_id']) { echo "selected = 'selected'"; } ?>><?=stripslashes($brandRow['brand_name'])?></option>
								<?php } ?>
                                </select>
                              </div>
                           </div>
                           
                           
                           <div class="control-group">
                              <label class="control-label" >Batch No </label>
                              <div class="controls">
                              <?php
							    if($current_mode == 'Edit') {
								$batchSql="select * from `product_godown_batch` WHERE product_godown_id = ".$row_id;   
								$batchRs=mysql_query($batchSql);
								if(mysql_num_rows($batchRs) > 0) {
							  ?> 
                              <table cellpadding="2">
                              	<?php 
								
								while($batchRec=mysql_fetch_array($batchRs))
								{
								?>
                              	  <tr>
                                	<td align="left" valign="top">
                                           &bull; <?php echo stripslashes($batchRec['batch_no'])?>
                                           <input type="hidden" name="batch_no[]" value="<?php echo stripslashes($batchRec['batch_no'])?>" />
                             		</td>
                                  </tr>
                                  <?php } ?>
                               </table> 
                               <?php } ?>
							  <?php 
							  echo "------------------------------------------------------------------------------------";
							  }
							  ?>
                              <table cellpadding="2" id="dataTable">
                              	<tr>
                                	<td align="left" valign="top">
                                           <input type="text" name="batch_no[]" class="m-wrap large"  />
                             		</td>
                                  </tr>
                               </table> 
                               <a href="javascript:void(0);" onclick="addRow('dataTable')">Add Product Batch No</a> 
                              
                             </div>
                           </div>
                           
                          <div class="control-group">
                              <label class="control-label" >Mfg Date</label>
                              <div class="controls">
                              <input tabindex="5" class="m-wrap small m-ctrl-medium date-picker" placeholder= "yyyy-mm-dd" data-date-format="yyyy-mm-dd"  type="text"  name="mfg_date" id="mfg_date" readonly="readonly" value="<?=stripslashes($rec['mfg_date'])?>" />
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label" >Pass No.</label>
                              <div class="controls">
                               <input type="text" tabindex="6" name="pass_no" id="pass_no"  class="m-wrap large" value="<?=stripslashes($rec['pass_no'])?>"  />
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label" >Supplier <font color="#FF0000">*</font></label>
                              <div class="controls">
							<?php
								$supplierSql="select * from supplier where status = 'Active' order by name asc";
								$supplierResult=mysql_query($supplierSql) or die(mysql_error());
                            ?>
                               <select tabindex="7" class="large m-wrap" name="supplier_id" id="supplier_id">
                               				 <option value="">Select</option>	
                               <?php
									while($supplierRow=mysql_fetch_array($supplierResult))
									{
								?>               
                                             <option value="<?=$supplierRow['supplier_id']?>" <?php if($supplierRow['supplier_id'] == $rec['supplier_id']) { echo "selected = 'selected'"; } ?>><?=stripslashes($supplierRow['name'])?></option>
								<?php } ?>
                                </select>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" >Bill / Invoice No. <font color="#FF0000">*</font></label>
                              <div class="controls">
                               <input type="text" tabindex="8" name="invoice_no" id="invoice_no"  class="m-wrap large" value="<?=stripslashes($rec['invoice_no'])?>"  />
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" >Bill / Invoice Date <font color="#FF0000">*</font></label>
                              <div class="controls">
                              <input tabindex="9" class="m-wrap small m-ctrl-medium date-picker"  type="text"  placeholder= "yyyy-mm-dd" name="invoice_date" id="invoice_date" readonly="readonly" data-date-format="yyyy-mm-dd" value="<?=stripslashes($rec['invoice_date'])?>" />
                              </div>
                           </div>
                           
                            <div class="control-group">
                              <label class="control-label" >Quantity in Bottles <font color="#FF0000">*</font></label>
                              <div class="controls">
                              <input tabindex="10" class="m-wrap small"  type="text"  name="bottle_qty" id="bottle_qty" onkeypress="return isNumberKey(event)" value="<?=stripslashes($rec['bottle_qty'])?>"/>
                              <br /><br />
                                <table width="400" border="0" cellspacing="2" cellpadding="5">
                                <thead>
										<tr>
                                        <th valign="top" align="left">Category</th>
                                        <th valign="top" align="left">Quantity</th>
                                        <th valign="top" align="left">Rate</th>
										</tr>
								</thead>
                                <tr>
                                    <td width="61" align="left" valign="top">2000ML</td>
                                    <td width="144" align="left" valign="top"><input tabindex="11" class="m-wrap small"  type="text"  name="qty_2000" id="qty_2000"  onkeypress="return isNumberKey(event)"  placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_2000'])?>" /></td>
                                    <td width="157" align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="12" class="m-wrap small" name="rate_2000" id="rate_2000" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_2000'])?>" /><span class="add-on">/ Bottle</span>
                                    </div></td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">1000ML</td>
                                    <td align="left" valign="top"><input tabindex="13" class="m-wrap small"  type="text"  name="qty_1000" id="qty_1000" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_1000'])?>"/></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="14" class="m-wrap small" name="rate_1000" id="rate_1000" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_1000'])?>" /><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">750ML</td>
                                    <td align="left" valign="top"><input tabindex="15" class="m-wrap small"  type="text"  name="qty_750" id="qty_750" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_750'])?>" /></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="16" class="m-wrap small" name="rate_750" id="rate_750" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_750'])?>" /><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">650ML</td>
                                    <td align="left" valign="top"><input tabindex="17" class="m-wrap small"  type="text"  name="qty_650" id="qty_650" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_650'])?>"/></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="18" class="m-wrap small" name="rate_650" id="rate_650" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_650'])?>"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">500ML</td>
                                    <td align="left" valign="top"><input tabindex="19" class="m-wrap small"  type="text"  name="qty_500" id="qty_500" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_500'])?>"/></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="20" class="m-wrap small" name="rate_500" id="rate_500" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_500'])?>" /><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">375ML</td>
                                    <td align="left" valign="top"><input tabindex="21" class="m-wrap small"  type="text"  name="qty_375" id="qty_375" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_375'])?>"/></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="22" class="m-wrap small" name="rate_375" id="rate_375" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_375'])?>"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">275ML</td>
                                    <td align="left" valign="top"><input tabindex="23" class="m-wrap small"  type="text"  name="qty_275" id="qty_275" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_275'])?>"/></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="24" class="m-wrap small" name="rate_275" id="rate_275" placeholder="0.00" onchange="calculateTotal();"  value="<?=stripslashes($rec['rate_275'])?>"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">200ML</td>
                                    <td align="left" valign="top"><input tabindex="25" class="m-wrap small"  type="text"  name="qty_200" id="qty_200" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_200'])?>"/></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="26" class="m-wrap small" name="rate_200" id="rate_200" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_200'])?>" /><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">180ML</td>
                                    <td align="left" valign="top"><input tabindex="27" class="m-wrap small"  type="text"  name="qty_180" id="qty_180" onkeypress="return isNumberKey(event)" placeholder="0" onchange="calculateTotal();" value="<?=stripslashes($rec['qty_180'])?>"/></td>
                                    <td align="left" valign="top">
                                    <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="28" class="m-wrap small" name="rate_180" id="rate_180" placeholder="0.00" onchange="calculateTotal();" value="<?=stripslashes($rec['rate_180'])?>"/><span class="add-on">/ Bottle</span>
                                    </div>
                                    </td>
                                </tr>
                                </table>
                                
                                <!--<br />
                                <button tabindex="1" type="button" class="btn black" onclick="calculateTotal();">Calculate Total</button>-->

                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" >Total Amount</label>
                              <div class="controls">
                               <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="29" class="m-wrap small" name="total_amount" id="total_amount" placeholder="0.00" readonly="readonly" value="<?=stripslashes($rec['total_amount'])?>"/><span class="add-on">/-</span>
                                    </div>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" >Discount</label>
                              <div class="controls">
                               <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="30" class="m-wrap small" name="discount" id="discount" placeholder="0.00" onchange="calculateDiscount();" value="<?=stripslashes($rec['discount'])?>"/><span class="add-on">/-</span>
                                    </div>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" >Total Amount after Discount</label>
                              <div class="controls">
                               <div class="input-prepend input-append">
                                    <span class="add-on">Rs.</span><input type="text" tabindex="31" class="m-wrap small" name="total_amount_after_discount" id="total_amount_after_discount" placeholder="0.00" readonly="readonly" value="<?=stripslashes($rec['total_amount_after_discount'])?>"/><span class="add-on">/-</span>
                                    </div>
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" >Remarks</label>
                              <div class="controls">
                                <textarea tabindex="32" rows="3" name="remarks" id="remarks" class="m-wrap large" style="width: 320px; height: 69px; resize:none;"><?=stripslashes($rec['remarks'])?></textarea>
                              </div>
                           </div>
                           
                           <div class="form-actions">
                              <button tabindex="33" type="submit" class="btn red">Submit</button>
                              <button tabindex="34" type="button" class="btn black" onclick="cancel();">Cancel</button>
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
	   
			  $sql1  = "INSERT INTO product_godown SET
						`stock_type` 		= '".addslashes(trim($_REQUEST['stock_type']))."',
						`product_name` 		= '".addslashes(trim($_REQUEST['product_name']))."',
						`brand_id` 			= '".(trim($_REQUEST['brand_id']))."',
						`mfg_date` 			= '".(trim($_REQUEST['mfg_date']))."',
						`pass_no` 			= '".addslashes(trim($_REQUEST['pass_no']))."',
						`supplier_id` 		= '".(trim($_REQUEST['supplier_id']))."',
						`invoice_no` 		= '".addslashes(trim($_REQUEST['invoice_no']))."',
						`invoice_date` 		= '".(trim($_REQUEST['invoice_date']))."',
						`bottle_qty` 		= '".(trim($_REQUEST['bottle_qty']))."',
						`qty_2000` 			= '".(trim($_REQUEST['qty_2000']))."',
						`rate_2000` 		= '".(trim($_REQUEST['rate_2000']))."',
						`qty_1000` 			= '".(trim($_REQUEST['qty_1000']))."',
						`rate_1000` 		= '".(trim($_REQUEST['rate_1000']))."',
						`qty_750` 			= '".(trim($_REQUEST['qty_750']))."',
						`rate_750` 			= '".(trim($_REQUEST['rate_750']))."',
						`qty_650` 			= '".(trim($_REQUEST['qty_650']))."',
						`rate_650` 			= '".(trim($_REQUEST['rate_650']))."',
						`qty_500` 			= '".(trim($_REQUEST['qty_500']))."',
						`rate_500` 			= '".(trim($_REQUEST['rate_500']))."',
						`qty_375` 			= '".(trim($_REQUEST['qty_375']))."',
						`rate_375` 			= '".(trim($_REQUEST['rate_375']))."',
						`qty_275` 			= '".(trim($_REQUEST['qty_275']))."',
						`rate_275` 			= '".(trim($_REQUEST['rate_275']))."',
						`qty_200` 			= '".(trim($_REQUEST['qty_200']))."',
						`rate_200` 			= '".(trim($_REQUEST['rate_200']))."',
						`qty_180` 			= '".(trim($_REQUEST['qty_180']))."',
						`rate_180` 			= '".(trim($_REQUEST['rate_180']))."',
						`total_amount` 		= '".(trim($_REQUEST['total_amount']))."',
						`discount` 			= '".(trim($_REQUEST['discount']))."',
						`total_amount_after_discount` = '".(trim($_REQUEST['total_amount_after_discount']))."',
						`remarks` 			= '".(trim($_REQUEST['remarks']))."',
						`created_date`    	= '".date('Y-m-d H:i:s')."'";
						
				   mysql_query($sql1) or die(mysql_error()." Error in insert.".$sql1);
				   
				   $product_godown_id 	= mysql_insert_id();
				   $batch_no 			= $_REQUEST['batch_no'];
				   for($i=0; $i<count($batch_no); $i++)
				   {
					   if($batch_no[$i]!='')
					   {
							$sql2  = "INSERT INTO product_godown_batch SET
							`product_godown_id`	= '".$product_godown_id."' ,
							`batch_no` 			= '".$batch_no[$i]."'";
							
							mysql_query($sql2);
					   }
						
				   }
						
			       $_SESSION['succ_msg'] = "Product has been successfully added.";
				   
				   header("Location:".$currentPage);
				   
				   exit();
	}
	else 
	{
		 		 $id = $row_id;
	
	 			 $sql1 = "update product_godown SET
						`stock_type` 		= '".addslashes(trim($_REQUEST['stock_type']))."',
						`product_name` 		= '".addslashes(trim($_REQUEST['product_name']))."',
						`brand_id` 			= '".(trim($_REQUEST['brand_id']))."',
						`mfg_date` 			= '".(trim($_REQUEST['mfg_date']))."',
						`pass_no` 			= '".addslashes(trim($_REQUEST['pass_no']))."',
						`supplier_id` 		= '".(trim($_REQUEST['supplier_id']))."',
						`invoice_no` 		= '".addslashes(trim($_REQUEST['invoice_no']))."',
						`invoice_date` 		= '".(trim($_REQUEST['invoice_date']))."',
						`bottle_qty` 		= '".(trim($_REQUEST['bottle_qty']))."',
						`qty_2000` 			= '".(trim($_REQUEST['qty_2000']))."',
						`rate_2000` 		= '".(trim($_REQUEST['rate_2000']))."',
						`qty_1000` 			= '".(trim($_REQUEST['qty_1000']))."',
						`rate_1000` 		= '".(trim($_REQUEST['rate_1000']))."',
						`qty_750` 			= '".(trim($_REQUEST['qty_750']))."',
						`rate_750` 			= '".(trim($_REQUEST['rate_750']))."',
						`qty_650` 			= '".(trim($_REQUEST['qty_650']))."',
						`rate_650` 			= '".(trim($_REQUEST['rate_650']))."',
						`qty_500` 			= '".(trim($_REQUEST['qty_500']))."',
						`rate_500` 			= '".(trim($_REQUEST['rate_500']))."',
						`qty_375` 			= '".(trim($_REQUEST['qty_375']))."',
						`rate_375` 			= '".(trim($_REQUEST['rate_375']))."',
						`qty_275` 			= '".(trim($_REQUEST['qty_275']))."',
						`rate_275` 			= '".(trim($_REQUEST['rate_275']))."',
						`qty_200` 			= '".(trim($_REQUEST['qty_200']))."',
						`rate_200` 			= '".(trim($_REQUEST['rate_200']))."',
						`qty_180` 			= '".(trim($_REQUEST['qty_180']))."',
						`rate_180` 			= '".(trim($_REQUEST['rate_180']))."',
						`total_amount` 		= '".(trim($_REQUEST['total_amount']))."',
						`discount` 			= '".(trim($_REQUEST['discount']))."',
						`total_amount_after_discount` = '".(trim($_REQUEST['total_amount_after_discount']))."',
						`remarks` 			= '".(trim($_REQUEST['remarks']))."'
						 where product_godown_id =  ".$id;
	  
		 		   mysql_query($sql1) or die(mysql_error()." Error in update.".$sql1);
		  
		  		   $product_godown_id 	= $id;
				   $batch_no 			= $_REQUEST['batch_no'];
				   
				   mysql_query("delete from product_godown_batch where product_godown_id = ".$product_godown_id);
				   
				   for($i=0; $i<count($batch_no); $i++)
				   {
					   if($batch_no[$i]!='')
					   {
							$sql2  = "INSERT INTO product_godown_batch SET
							`product_godown_id`	= '".$product_godown_id."' ,
							`batch_no` 			= '".$batch_no[$i]."'";
							
							mysql_query($sql2);
					   }
						
				   }
		  
	      $_SESSION['succ_msg'] = "Product has been successfully updated.";
		  
		  disphtml("main();");

	}

	
}

function delete_record(){
	$id=$_REQUEST['row_id'];
	$del_subs=mysql_query("DELETE FROM `product_godown` WHERE product_godown_id = ".$id);
	$del_subs2=mysql_query("DELETE FROM `product_godown_batch` WHERE product_godown_id = ".$id);
	if($del_subs) {
		$_SESSION['succ_msg'] = "Product successfully deleted.";
	}
	header("location:".$currentPage);
	exit();
}

?>