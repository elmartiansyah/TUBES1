<?php
require_once ('../inc/header.php');
$action = isset ($_GET['action']) ? $_GET['action'] : '';
$blogroll_id = isset ($_GET['blogroll_id']) ? $_GET['blogroll_id'] : '';

if ($action == 'delete') {
	$sql = mysql_query("select * from blogroll where id='$blogroll_id'");
	if (!($res_blogroll = mysql_fetch_assoc($sql))) {
		header('location:blogroll.php');
	}
	if (isset ($_POST['confirm'])) {
		mysql_query("delete from blogroll where id='$blogroll_id'");
		$_SESSION['success_notif']='Blogroll successfully removed';
		header('location:blogroll.php');
		exit;
	}
	rt('tm');
	echo '<div class="list-head">Delete blogroll?</div>' .
	'<div class="content"><center>' . $res_blogroll['name'] . '<br/><br />' .
	'<form action="?action=delete&amp;blogroll_id=' . $blogroll_id . '" method="post">' .
	'<input type="submit" value="   Yes   " name="confirm"/> <a href="blogroll.php">No</a></form></center></div>';
	rb('b');

} else {
	$name = isset ($_POST['name']) ? $_POST['name'] : '';
	$url = isset ($_POST['url']) ? $_POST['url'] : '';

	if ($action == 'new') {
		if (isset ($_POST['submit'])) {
			if ($url != '')
				$url = str_replace('http://', '', $url);
			if (empty ($name))
				show_warning('Insert name please');
			if (empty ($name))
				show_warning('Insert URL please');
			$check = mysql_num_rows(mysql_query("select * from blogroll where name='" . mysql_real_escape_string(trim($name)) . "'"));
			$check = $check;
			if ($check)
				show_warning('Name \'' . $name . '\' already available');
			$check2 = mysql_num_rows(mysql_query("select * from blogroll where url='" . mysql_real_escape_string(trim($url)) . "'"));
			$check2 = $check2;
			if ($check2)
				show_warning('URL \'' . $url . '\' already available');

			if (!empty ($name) && !empty ($url) && !$check && !$check2) {
				mysql_query("insert into blogroll set " .
				"name='" . trim($name) . "', url='" . trim($url) . "'");
				$blogroll_id = mysql_insert_id();
				show_notif('Blogroll successfully added.');
				$res_blogroll = mysql_fetch_assoc(mysql_query("select * from blogroll where id='$blogroll_id'"));

				$action = 'edit';
				$name = $res_blogroll['name'];
				$url = $res_blogroll['url'];
			}
		}
	} else
		if ($action == 'edit') {
			$sql = mysql_query("select * from blogroll where id='$blogroll_id'");
			if (!$res_blogroll = mysql_fetch_assoc($sql)) {
				header('location:blogroll.php');
			}
			if (!isset ($_POST['submit'])) {
				$name = $res_blogroll['name'];
				$url = $res_blogroll['url'];
			} else {
				$name = isset ($_POST['name']) ? $_POST['name'] : '';
				$url = isset ($_POST['url']) ? $_POST['url'] : '';
				if ($url != '')
				$url = str_replace('http://', '', $url);
				if (empty ($url))
					show_warning('Insert URL please.');
				if (empty ($name))
					show_warning('Insert name please.');
				$check = mysql_num_rows(mysql_query("select * from blogroll where name='" . mysql_real_escape_string(trim($name)) . "'"));
				$check = $check && $res_blogroll['name'] != $name;
				if ($check)
					show_warning('Name \'' . $name . '\' already available');
				$check2 = mysql_num_rows(mysql_query("select * from blogroll where url='" . mysql_real_escape_string(trim($url)) . "'"));
				$check2 = $check2 && $res_blogroll['url'] != $url;
				if ($check2)
					show_warning('URL \'' . $url . '\' already available');

				if (!empty ($name) && !empty ($url) && !$check && !$check2) {
					mysql_query("update blogroll set " .
					"name='" . mysql_real_escape_string(trim($name)) . "'," .
					"url='" . trim($url) . "' where id='$blogroll_id'");
					show_notif('Blogroll successfully updated.');

					$res_blogroll = mysql_fetch_assoc(mysql_query("select * from blogroll where id='$blogroll_id'"));
					$name = $res_blogroll['name'];
					$url = $res_blogroll['url'];
				}
			}
		}
	rt('tm');
	echo '<div class="list-head">' . ($action == 'new' ? 'Add New' : 'Edit blogroll') . '</div>' .
	'<div class="content"><form method="post" action="?action=' . ($action == 'edit' ? 'edit&amp;blogroll_id=' . $blogroll_id : 'new') . '">' .
	'Name:<br /><input type="text" name="name" value="' . $name . '"/><hr />' .
	'URL:<br /><input type="text" name="url" value="' . $url . '"/><br /><table>' .
	'<tr><td><input type="submit" value="' . ($action == 'new' ? 'Add' : 'Update') . '" name="submit"/></form></td>' .
	 (($action == 'edit') ? '<td><form action="?action=delete&amp;blogroll_id=' . $blogroll_id . '" method="post">' .
	'<input type="submit" value="Delete"/></form></td>' : '') . '</tr></table></div>';
	rb('b');
	rt('t');
		if ($action == 'edit')
		echo '<div class="list-nobullet-top"><a href="?action=new"><img src="' . get_setting('blogurl') . '/images/add.png"> Add new</a></div><hr/>';
	echo '<div class="list-nobullet-top"><a href="blogroll.php"><img src="' . get_setting('blogurl') . '/images/blogroll.png"> Manage blogroll</a></div>';
	rb('b');
}
require_once ('../inc/footer.php');
?>
