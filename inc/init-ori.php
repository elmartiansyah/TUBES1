<?php
date_default_timezone_set('GMT');
error_reporting(0);
session_start();
if (isset ($_GET['logout'])) {
	session_destroy();
	session_start();
}
require_once ('db_connect.php');
require_once ('function.php');
$connect = mysql_connect(db_host, db_username, db_password) or die('Cannot connect to server');
mysql_select_db(db_name) or die('Database not found');
mysql_query("SET NAMES 'utf8'", $connect);
$isadmin = false;
$admin_id=0;

$username = isset ($_SESSION['username']) ? $_SESSION['username'] : '';
$password = isset ($_SESSION['password']) ? $_SESSION['password'] : '';

if (isset ($_GET['login'])) {
	if (isset ($_POST['username']))
		$username = $_POST['username'];
	if (isset ($_POST['password']))
		$password = md5(md5(md5($_POST['password'])));
}
$user = mysql_fetch_assoc(mysql_query("select * from user where username='$username' and password='$password'"));
if ($user['password']) {
	$isadmin = true;
	$user_id=$user['id'];
	if (isset ($_GET['login'])) {
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
	}
}else if (isset ($_GET['login']) && isset ($_POST['submit'])){
	$err='Login failed';
}

?>
