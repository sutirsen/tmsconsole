<?php
	// Turn off all error reporting
	error_reporting(0);
	if($_SERVER['HTTP_HOST'] == 'tms.console.com')
	{
		define ('DBNAME', 'guest_house');
		define ('DBUSER', 'root');
		define ('DBPASS', '');
		define ('DB_HOST', 'localhost');
		
		define("SITE_URL","http://localhost/admin/");
		define("ADMIN_URL","http://localhost/admin/");
	}
	else
	{
		define ('DBNAME', 'u327350003_guest');
		define ('DBUSER', 'u327350003_guest');
		define ('DBPASS', 'u327350003_guest');
		define ('DB_HOST', 'mysql.serversfree.com');
		
		define("SITE_URL","http://projects.bugs3.com/");
		define("ADMIN_URL","http://projects.bugs3.com/");
	}
$link=mysql_connect(DB_HOST,DBUSER,DBPASS);
if($link)
{
	mysql_select_db(DBNAME,$link);
}
$pageArr = explode("/",$_SERVER['PHP_SELF']);
$_SESSION['currentPage'] = $pageArr[count($pageArr) - 1];
?>