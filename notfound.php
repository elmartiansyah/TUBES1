<?php
	session_start();
	include('inc/init.php');
	$_SESSION['notfound'] = 'Page not found';
	header('location:' . get_setting('blogurl'));
?>
