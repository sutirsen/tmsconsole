<?php
ob_start();
require("admin_utils.php");
if($_POST['mode']=="change_mail"){
	change_email();
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
                     <li><a href="#">Change Profile</a></li>
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
                        <h4><i class="icon-reorder"></i>Change Profile</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="reload"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form  name="form1" action="" method="post" onSubmit="return check(this);" class="form-horizontal">
                           <input type="hidden" name="mode" value="change_mail">	
                           <div class="control-group">
                              <label class="control-label">Username <font color="#FF0000">*</font></label>
                              <div class="controls">
                                 <input disabled="disabled" type="text" name="admin_login" value="<?php echo $old_data['admin_login'];  ?>" class="m-wrap large" >
                                 <span class="help-inline">Username can not be changed</span>
                              </div>
                           </div>
                           
                          <div class="control-group">
                              <label class="control-label">First Name <font color="#FF0000">*</font></label>
                              <div class="controls">
                                 <input tabindex="1" type="text" name="first_name" value="<?php echo $old_data['first_name'];  ?>" class="m-wrap large"  />
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label">Last Name <font color="#FF0000">*</font></label>
                              <div class="controls">
                                 <input tabindex="2" type="text" name="last_name" value="<?php echo $old_data['last_name'];  ?>" class="m-wrap large"  />
                              </div>
                           </div>
                           
                           <div class="control-group">
                              <label class="control-label">Mobile <font color="#FF0000">*</font></label>
                              <div class="controls">
                                 <input type="text" tabindex="3" name="mobile" value="<?php echo $old_data['mobile'];  ?>" class="m-wrap large"  />
                              </div>
                           </div>
                           <div class="control-group">
                              <label class="control-label">Email</label>
                              <div class="controls">
                                 <input type="text" tabindex="4" name="email" value="<?php echo $old_data['admin_email'];  ?>" class="m-wrap large"  />
                              </div>
                           </div>
                           <div class="form-actions">
                              <button tabindex="5" type="submit" class="btn red">Submit</button>
                              <button tabindex="6" type="button" class="btn black" onclick="cancel();">Cancel</button>
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
	if(form.first_name.value.search(/\S/)==-1){
	alert("Please enter first name");
	form.first_name.focus();
	return false;
}

if(form.last_name.value.search(/\S/)==-1){
	alert("Please enter last name");
	form.last_name.focus();
	return false;
}

if(form.email.value.search(/\S/)==-1){
	alert("Please enter e-mail");
	form.email.focus();
	return false;
}

/*if(form.email.value.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1)
{
	alert("Please enter valid E-mail");
	form.email.focus();
	return false;
}*/
	if(form.mobile.value.search(/\S/)==-1){
	alert("Please enter mobile");
	form.mobile.focus();
	return false;
}

return true;
}
//-->
</script>
<? }
function change_email()
{
		$admin_upd_sql="UPDATE admin_master SET admin_email = '".$_POST['email']."' , first_name = '".$_POST['first_name']."'  , last_name = '".$_POST['last_name']."' , mobile = '".$_POST['mobile']."'  WHERE id = '" . $_SESSION["admin_userid"]."'";
		mysql_query($admin_upd_sql);
		$_SESSION['succ_msg']="Profile Updated.";
		disphtml("main();");

}
?>