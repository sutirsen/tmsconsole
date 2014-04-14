<?php
ob_start();
require("admin_utils.php");
if($_POST['mode']=="change_pwd"){
	change_pwd();
}
else{
	disphtml("main();");
}
ob_end_flush();

function main(){
	$old_data=mysql_fetch_array(mysql_query("select * from admin_master where id = '" . $_SESSION["admin_userid"]."'"));
?>
<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
                   	    <!-- BEGIN STYLE CUSTOMIZER -->
                 		 <?php include("theme_colour.php");?>
                 		<!-- END BEGIN STYLE CUSTOMIZER -->  
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
                    		Admin Utilities
                        </h3>
                 		<ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="admin_main.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Admin Utilities</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Change Password</a></li>
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
                        <h4><i class="icon-reorder"></i>Change Password</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="reload"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form  name="form1" action="" method="post" onSubmit="return check(this);" class="form-horizontal">
                           <input type="hidden" name="mode" value="change_pwd">	
                           <div class="control-group">
                              <label class="control-label" style="width:168px;">Old Password <font color="#FF0000">*</font></label>
                              <div class="controls">
                                <input type="password" tabindex="1" name="old_admin_pwd" class="m-wrap large" autocomplete = "off">
                              </div>
                           </div>
                           
                          <div class="control-group">
                              <label class="control-label" style="width:168px;">New Password <font color="#FF0000">*</font></label>
                              <div class="controls">
                                <input type="password" name="new_admin_pwd" tabindex="2" class="m-wrap large">
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label" style="width:168px;">Confirm New Password <font color="#FF0000">*</font></label>
                              <div class="controls">
                                <input type="password" name="conf_new_admin_pwd" tabindex="3" class="m-wrap large">
                              </div>
                           </div>
                           
                          
                           <div class="form-actions">
                              <button tabindex="4" type="submit" class="btn red">Submit</button>
                              <button tabindex="5" type="button" class="btn black" onclick="cancel();">Cancel</button>
                           </div>
                        </form>

                        <!-- END FORM-->           
                     </div>
                  </div>
                  <!-- END SAMPLE FORM PORTLET-->
               </div>
            </div>
		</div>
<script language="JavaScript">
function cancel(){ 
	window.location.href = 'admin_main.html';
}
function check(form){
		if(form.old_admin_pwd.value.search(/\S/)==-1){
			alert("Please enter old password");
			form.old_admin_pwd.focus();
			return false;
		}

		if(form.new_admin_pwd.value.search(/\S/)==-1){
			alert("Please enter new password");
			form.new_admin_pwd.focus();
			return false;
		}

		if(form.new_admin_pwd.value.length<5){
			alert("Please choose a new password atleast 5 character long");
			form.new_admin_pwd.focus();
			return false;
		}

		if(form.conf_new_admin_pwd.value.search(/\S/)==-1){
			alert("Please enter confirm new password");
			form.conf_new_admin_pwd.focus();
			return false;
		}

		if(form.new_admin_pwd.value!=form.conf_new_admin_pwd.value){
			alert("Please enter similair passwords");
			form.conf_new_admin_pwd.focus();
			return false;
		}

		return true;
}
//-->
</script>
<? }
function change_pwd()
{
	$admin_pwd_sql="select id from admin_master where id='".$_SESSION["admin_userid"]."' and admin_pwd = '".$_POST["old_admin_pwd"]."'";
	$admin_pwd_res=mysql_query($admin_pwd_sql);
	if(mysql_num_rows($admin_pwd_res)>0)
	{
		$admin_pwd_row=mysql_fetch_array($admin_pwd_res);
		$admin_upd_sql="UPDATE  admin_master SET admin_pwd = '".$_POST[new_admin_pwd]."' WHERE id = '" . $_SESSION["admin_userid"]."'";
		mysql_query($admin_upd_sql);
		$_SESSION['succ_msg']="Password Updated Successfully.";
	}
	else
	{
		$_SESSION['err_msg']="Old Password Mismatch.";
	}
	disphtml("main();");
}
?>