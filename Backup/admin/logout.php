<?php
session_start();
$_SESSION['admin_userid'] = "";
$_SESSION['admin_userid'] = NULL;
unset($_SESSION['admin_userid']);
header('Location: index.html');
?>