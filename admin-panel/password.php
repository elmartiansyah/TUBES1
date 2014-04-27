<?php
require_once ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
if (isset ($_GET['update']) && isset ($_POST['submit'])) {
	$old = isset ($_POST['old']) ? $_POST['old'] : '';
	$new = isset ($_POST['new']) ? $_POST['new'] : '';
	$confirm = isset ($_POST['confirm']) ? $_POST['confirm'] : '';
	if ($new != $confirm)
		$_SESSION['set_err_msg'] = 'New password and confirmation password does not match';
	if (empty ($confirm))
		$_SESSION['set_err_msg'] = 'Insert password confrmation please!';
	if (empty ($new))
		$_SESSION['set_err_msg'] = 'Insert new password please!';
	$cek = mysql_fetch_assoc(mysql_query("select * from user where id='$user_id' and password='" . md5(md5(md5(trim(mysql_real_escape_string($old))))) . "'"));
	if (!$cek['password'])
		$_SESSION['set_err_msg'] = 'Old password incorrect';
	if (empty ($old))
		$_SESSION['set_err_msg'] = 'Insert old password please';
	if (!isset ($_SESSION['set_err_msg'])) {
		mysql_query("update user set " .
		"password='" . md5(md5(md5(trim($new)))) . "'" .
		" where id='$user_id'") or die(mysql_error());
		$_SESSION['set_success_msg'] = 'Password successfully updated.';
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
'Old password:<br /><input type="password" name="old" value=""/><hr />' .
'New password:<br /><input type="password" name="new" value=""/><hr />' .
'New password confirmation:<br /><input type="password" name="confirm" value=""/><hr />' .
'<input type="submit" name ="submit" value=" Update " /></form></div>';

rb('b');
require_once ('../inc/footer.php');
?>
