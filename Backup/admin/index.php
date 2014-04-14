<?php
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);
if($_SESSION['admin_userid']!=''){
	header('Location: admin_main.php');
}
require("includes/config.php");
require("includes/functions.php");

if($_POST['mode']=="login"){
	login();
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>Welcome to Admin Control Panel</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/metro.css" rel="stylesheet" />
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/style_responsive.css" rel="stylesheet" />
  <link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
  <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
  <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
  <!-- BEGIN LOGO -->
  <div class="logo">
   <!-- <img src="assets/img/logo-big.png" alt="" /> -->
  </div>
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form name="frm_login" class="form-vertical login-form" action="" method="post">
    <input type="hidden" name="mode" value="login">
      <h3 class="form-title">Login to Admin Panel</h3>
      <?php
	  if($_SESSION['err_msg']!='') {
	  ?>
       <div class="alert alert-error">
        <button class="close" data-dismiss="alert"></button>
        <strong>Error!</strong> <?=$_SESSION['err_msg']; unset($_SESSION['err_msg']);?>
      </div>
      <?php } ?>
      <div class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        <span>Enter any username and passowrd.</span>
      </div>
      <div class="control-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="admin_userid" autocomplete = "off" value="<?php if(isset($_COOKIE['admin_login'])) echo $_COOKIE['admin_login']; ?>"/>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="admin_password" autocomplete = "off" value="<?php if(isset($_COOKIE['admin_pwd'])) echo $_COOKIE['admin_pwd']; ?>"/>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <label class="checkbox">
        <input type="checkbox" name="remember" id="remember" value="yes"  <?php if(isset($_COOKIE['admin_login'])) { echo 'checked="checked"'; } else { echo ''; } ?>/> Remember Me
        </label>
        <button type="submit" class="btn green pull-right">
        Login <i class="m-icon-swapright m-icon-white"></i>
        </button>            
      </div>
     <!-- <div class="forget-password">
        <h4>Forgot your password ?</h4>
        <p>
          no worries, click <a href="javascript:;" class="" id="forget-password">here</a>
          to reset your password.
        </p>
      </div>-->
    </form>
    <!-- END LOGIN FORM -->        
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <!--<form class="form-vertical forget-form" action="index.html">
      <h3 class="">Forget Password ?</h3>
      <p>Enter your e-mail address below to reset your password.</p>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-envelope"></i>
            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email" />
          </div>
        </div>
      </div>
      <div class="form-actions">
        <button type="button" id="back-btn" class="btn">
        <i class="m-icon-swapleft"></i> Back
        </button>
        <button type="submit" class="btn green pull-right">
        Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>            
      </div>
    </form>-->
    <!-- END FORGOT PASSWORD FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div class="copyright">
    Copyright &copy; <?=date('Y')?> | All Rights Reserved
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="assets/js/jquery-1.8.3.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>  
  <script src="assets/uniform/jquery.uniform.min.js"></script> 
  <script src="assets/js/jquery.blockui.js"></script>
  <script type="text/javascript" src="assets/jquery-validation/dist/jquery.validate.min.js"></script>
  <script src="assets/js/app.js"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<?php
function login()
	{
		$loginSql="select * from admin_master where status = 'Active' and admin_login='".$_POST[admin_userid]."' and admin_pwd='".$_POST[admin_password]."'";
		$loginRs= mysql_query($loginSql) or die ("table not found");
		if($loginRow=mysql_fetch_array($loginRs))
		{
			$_SESSION['admin_userid']	= $loginRow['id']; 
			$_SESSION['admin_username']	= $loginRow['admin_login']; 
			mysql_query("update admin_master set last_login = NOW() where id = ".$_SESSION['admin_userid']);
			
			if($_REQUEST['remember'] == "yes") {    // if user check the remember me checkbox     
			    $expire = time()+60*60*24*100;   
				setcookie('admin_login', $loginRow['admin_login'], $expire, "/");
				setcookie("admin_pwd", $loginRow['admin_pwd'], $expire, "/");
			}
			else {   // if user not check the remember me checkbox
				setcookie('admin_login', $loginRow['admin_login'], time()-60*60*24*100, "/"); 
				setcookie('admin_pwd', $loginRow['admin_pwd'], time()-60*60*24*100, "/");            
			}
			header('location: admin_main.html');
		}
		else
		{
			$_SESSION['err_msg']="Invalid Username or Password.";
			header('Location: index.html');
			exit();
		}

	}
?>