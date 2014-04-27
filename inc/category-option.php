<?php
require_once ('../inc/header.php');
$action = isset ($_GET['action']) ? $_GET['action'] : '';
$cat_id = isset ($_GET['cat_id']) ? $_GET['cat_id'] : '';

if ($action == 'delete') {
	$sql = mysql_query("select * from category where id='$cat_id'");
	if (!($res_category = mysql_fetch_assoc($sql)) || $cat_id == 1) {
		header('location:category.php');
	}
	if (isset ($_POST['confirm'])) {
		mysql_query("delete from category where id='$cat_id'");
		mysql_query("update post set category='1' where cat_id='$cat_id'");
		$_SESSION['success_notif'] = 'Category successfully removed';
		header('location:category.php');
		exit;
	}
	rt('tm');
	echo '<div class="list-head">Delete category?</div>' .
	'<div class="content"><center>' . $res_category['name'] . '<br/><br />' .
	'<form action="?action=delete&amp;cat_id=' . $cat_id . '" method="post">' .
	'<input type="submit" value="   Yes   " name="confirm"/> <a href="category.php">No</a></form></center></div>';
	rb('b');

} else {
	$name = isset ($_POST['name']) ? mysql_real_escape_string($_POST['name']) : '';
	$url = isset ($_POST['url']) ? mysql_real_escape_string($_POST['url']) : '';
	$url = create_permalink($url);

	if ($action == 'new') {
		if (isset ($_POST['submit'])) {
			if (empty ($name))
				show_warning('Insert category name please');
			$url = create_permalink($url);
			if (empty ($url))
				$url = create_permalink($name);

			$check = mysql_num_rows(mysql_query("select * from category where name='" . mysql_real_escape_string($name) . "'"));
			$check = $check;
			if ($check)
				show_warning('Category \'' . $name . '\' already available');
			$check2 = mysql_num_rows(mysql_query("select * from category where url='" . mysql_real_escape_string($url) . "'"));
			$check2 = $check2;
			if ($check2)
				show_warning('Category URL \'' . $url . '\' already available');

			if (!empty ($name) && !empty ($url) && !$check && !$check2) {
				mysql_query("insert into category set " .
				"name='$name', url='$url'");
				$cat_id = mysql_insert_id();
				show_notif('Category successfully created.');
				$res_category = mysql_fetch_assoc(mysql_query("select * from category where id='$cat_id'"));

				$action = 'edit';
				$name = $res_category['name'];
				$url = $res_category['url'];
			}
		}
	} else
		if ($action == 'edit') {
			$sql = mysql_query("select * from category where id='$cat_id'");
			if (!$res_category = mysql_fetch_assoc($sql)) {
				header('location:category.php');
			}
			if (!isset ($_POST['submit'])) {
				$name = $res_category['name'];
				$url = $res_category['url'];
			} else {
				$name = isset ($_POST['name']) ? $_POST['name'] : '';
				$url = isset ($_POST['url']) ? $_POST['url'] : '';
				$url = create_permalink($url);
				if (empty ($url))
					$url = create_permalink($name);
				if (empty ($name))
					show_warning('Insert category name please.');
				$check = mysql_num_rows(mysql_query("select * from category where name='" . mysql_real_escape_string($name) . "'"));
				$check = $check && $res_category['name'] != $name;
				if ($check)
					show_warning('Category \'' . $name . '\' already available');
				$check2 = mysql_num_rows(mysql_query("select * from category where url='" . mysql_real_escape_string($url) . "'"));
				$check2 = $check2 && $res_category['url'] != $url;
				if ($check2)
					show_warning('Category URL \'' . $url . '\' already available');

				if (!empty ($name) && !empty ($url) && !$check && !$check2) {
					mysql_query("update category set " .
					"name='" . mysql_real_escape_string($name) . "'," .
					"url='$url' where id='$cat_id'");
					show_notif('Category successfully updated.');

					$res_category = mysql_fetch_assoc(mysql_query("select * from category where id='$cat_id'"));
					$name = $res_category['name'];
					$url = $res_category['url'];
				}
			}
		}
	rt('tm');
	echo '<div class="list-head">' . ($action == 'new' ? 'Create category' : 'Edit category') . '</div>' .
	'<div class="content"><form method="post" action="?action=' . ($action == 'edit' ? 'edit&amp;cat_id=' . $cat_id : 'new') . '">' .
	'Category name:<br /><input type="text" name="name" value="' . $name . '"/><hr />' .
	'URL Category:<br /><input type="text" name="url" value="' . $url . '"/><br />' .
	'<small>(leave it empty for automatic generate)</small><hr />';

	echo '<table>' .
	'<tr><td><input type="submit" value="' . ($action == 'new' ? 'Create' : 'Update') . '" name="submit"/></form></td>' .
	 (($action == 'edit' && $cat_id != 1) ? '<td><form action="?action=delete&amp;cat_id=' . $cat_id . '" method="post">' .
	'<input type="submit" value="Delete"/></form></td>' : '') . '</tr></table></div>';
	rb('b');

	rt('t');
	if ($action == 'edit')
		echo '<div class="list-nobullet-top"><a href="?action=new"><img src="' . get_setting('blogurl') . '/images/add.png"> Add new</a></div><hr/>';
	echo '<div class="list-nobullet-top"><a href="category.php"><img src="' . get_setting('blogurl') . '/images/category.png"> Manage category</a></div>';
	rb('b');
}
require_once ('../inc/footer.php');
?>
