<?php
require_once ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
require_once ('../inc/header.php');
$metadescription = isset ($_POST['metadescription']) ? strip_tags($_POST['metadescription']) : '';
$metakeyword = isset ($_POST['metakeyword']) ? strip_tags($_POST['metakeyword']) : '';
if (isset ($_GET['update']) && $_POST['submit']) {
	$metadescription = mysql_real_escape_string(trim(htmlentities($metadescription)));
	$metakeyword = mysql_real_escape_string(trim(htmlentities($metakeyword)));
	mysql_query("update setting set value='$metadescription' where name='metadescription'");
	mysql_query("update setting set value='$metakeyword' where name='metakeyword'");
	show_notif('Meta tag successfully updated');
}
rt('tm');
echo '<div class="list-head">Meta tag</div>' .
'<div class="content"><form action="?update" method="post">' .
'Meta Description:<br/><textarea name="metadescription" rows="5">' . get_setting('metadescription') . '</textarea><hr/>' .
'Meta Keyword:<small> (separated by comma)</small><br/><textarea name="metakeyword" rows="5">' . get_setting('metakeyword') . '</textarea><hr/>' .
'<input type="submit" name="submit" value="Update"/></form></div>';
rb('b');
require_once ('../inc/footer.php');
?>
