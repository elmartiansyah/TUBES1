<?php
require_once ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
if (isset ($_GET['update']) && isset ($_POST['submit'])) {
	$setting = array (
		1 => isset ($_POST['blogurl']) ? trim(preg_replace('/\/$/', '', $_POST['blogurl'])) : '',
		2 => isset ($_POST['blogname']) ? trim($_POST['blogname']) : '',
		3 => isset ($_POST['blogdescription']) ? trim($_POST['blogdescription']) : '',
		4 => isset ($_POST['timeshift']) ? trim($_POST['timeshift']) : '',
		5 => isset ($_POST['list']) ? trim($_POST['list']) : '',
		6 => isset ($_POST['theme']) ? trim($_POST['theme']) : '',
		7 => isset ($_POST['nocomment']) ? trim($_POST['nocomment']) : '0',
		8 => isset ($_POST['noblogroll']) ? trim($_POST['noblogroll']) : '0',
		9 => isset ($_POST['nocategory']) ? trim($_POST['nocategory']) : '0',
		10 => isset ($_POST['norelated']) ? trim($_POST['norelated']) : '0',
		11 => isset ($_POST['norecentcomment']) ? trim($_POST['norecentcomment']) : '0',
		12 => isset ($_POST['noprofile']) ? trim($_POST['noprofile']) : '0');

	$setting[5] = trim(preg_replace('/[^0-9]/', '', $setting[5]));
	if ($setting[5] < 5 || $setting[5] > 100 || $setting[5] == '')
		$_SESSION['set_err_msg'] = 'Total items per page invalid.';

	if (!isset ($_SESSION['set_err_msg'])) {
		$i = 1;
		foreach ($setting as $setting) {
			mysql_query("update setting set value='$setting' where id='$i'");
			$i++;
		}
		$_SESSION['set_success_msg'] = 'Setting successfully updated.';
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
echo '<div class="list-head">Blog settings</div>' .
'<div class="content"><form action="setting.php?update" method="post">' .
'Blog URL:<br /><input type="text" name="blogurl" value="' . get_setting('blogurl') . '"/><hr />' .
'Blog name:<br /><input type="text" name="blogname" value="' . get_setting('blogname') . '"/><hr />' .
'Blog description:<br /><input type="text" name="blogdescription" value="' . get_setting('blogdescription') . '"/><hr />' .
'Total items per page:<br /><input type="text" size="3" name="list" maxlength="3" value="' . get_setting('list') . '" style="width:auto"/><small> (5-100)</small><hr />' .
'Time zone: <select name="timeshift">';
for ($i = -12; $i < 14; $i++) {
	echo '<option value="' . $i . '"' . ($i == get_setting('timeshift') ? 'selected="selected"' : '') . '>' . ($i > 0 ? ('+' . $i) : $i) . '</option>';
}
echo '</select><br /><small>(' . get_time(time()) . ')</small><hr />';
echo 'Theme:<br /><select name="theme">';
$themedir = opendir('../themes');
while ($theme = readdir($themedir)) {
	echo $theme != '.' && $theme != '..' && !preg_match('/[^a-zA-Z0-9-_]+/', $theme) ? '<option value="' . $theme . '" ' . ($theme == get_setting('theme') ? 'selected="selected"' : '') . '>' . $theme . '</option>' : '';
}
closedir($themedir);
echo '</select><hr />' .
'<input type="checkbox" name="nocomment" value="1" ' . (get_setting('nocomment') == 1 ? 'checked="checked"' : '') . '/> Disable all comments<hr />' .
'<input type="checkbox" name="noblogroll" value="1" ' . (get_setting('noblogroll') == 1 ? 'checked="checked"' : '') . '/> Hide blogroll<hr />' .
'<input type="checkbox" name="nocategory" value="1" ' . (get_setting('nocategory') == 1 ? 'checked="checked"' : '') . '/> Hide category on homepage<hr />' .
'<input type="checkbox" name="norelated" value="1" ' . (get_setting('norelated') == 1 ? 'checked="checked"' : '') . '/> Hide related posts<hr/>' .
'<input type="checkbox" name="norecentcomment" value="1" ' . (get_setting('norecentcomment') == 1 ? 'checked="checked"' : '') . '/> Hide recent comment lists<hr />' .
'<input type="checkbox" name="noprofile" value="1" ' . (get_setting('noprofile') == 1 ? 'checked="checked"' : '') . '/> Hide profile page<br/><br/>' .
'<input type="submit" name ="submit" value=" Save " /></form></div>';

rb('b');
require_once ('../inc/footer.php');
?>
