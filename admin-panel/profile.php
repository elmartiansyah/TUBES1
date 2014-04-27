<?php
require_once ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
if (isset ($_GET['update']) && isset ($_POST['submit'])) {
	$username = isset ($_POST['username']) ? $_POST['username'] : '';
	$nick = isset ($_POST['nick']) ? $_POST['nick'] : '';
	$about = isset($_POST['about']) ? $_POST['about'] : '';
	if (empty ($nick))
		$_SESSION['set_err_msg'] = 'Insert nick please';
	if (empty ($username))
		$_SESSION['set_err_msg'] = 'Insert username please';

	if (!isset ($_SESSION['set_err_msg'])) {
			mysql_query("update user set " .
					"username='" . trim(mb_strtolower(mysql_real_escape_string($username))) . "'," .
					"nick='" . trim(mysql_real_escape_string($nick)) . "'," .
					"about='" . trim(mysql_real_escape_string($about)) . "'" .
					" where id='1'") or die(mysql_error());
		$_SESSION['set_success_msg'] = 'Profile successfully updated.';
	}
}

require_once ('../inc/header.php');
if (isset ($_SESSION['set_err_msg'])) {
	show_warning($_SESSION['set_err_msg']);
	unset ($_SESSION['set_err_msg']);
}
if (isset ($_SESSION['set_success_msg'])) {
	show_notif($_SESSION['set_success_msg']);
	unset ($_SESSION['set_success_msg']);
}
rt('tm');
echo '<div class="list-head">Manage profile</div>' .
'<div class="content"><form action="?update" method="post">' .
'Username: <small>(for login)</small><br /><input type="text" name="username" value="' . get_admin('username') . '"/><hr />' .
'Nick: <small>(name on article)</small><br /><input type="text" name="nick" value="' . get_admin('nick') . '"/><hr />' .
'About:<br /><textarea rows="10" name="about">' . get_admin('about') . '</textarea><hr />' .
'<input type="submit" name ="submit" value=" Save " /></form></div>';

rb('b');
require_once ('../inc/footer.php');
?>
