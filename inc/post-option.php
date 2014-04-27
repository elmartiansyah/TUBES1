<?php
require_once ('../inc/header.php');
$action = isset ($_GET['action']) ? $_GET['action'] : '';
$post_id = isset ($_GET['post_id']) ? $_GET['post_id'] : '';
$post_id = get_post($post_id, 'id');

if ($action == 'delete') {
	if (!get_post($post_id, 'id')) {
		header('location:post.php');
	}
	if (isset ($_POST['confirm'])) {
		mysql_query("delete from post where id='$post_id'");
		mysql_query("delete from comment where post_id='$post_id'");
		$_SESSION['success_notif']='Article successfully removed.';
		header('location:post.php');
		exit;
	}
	rt('tm');
	echo '<div class="list-head">Delete post?</div>' .
	'<div class="content"><center>' . get_post($post_id, 'title') . '<br/><br />' .
	'<form action="?action=delete&post_id=' . $post_id . '" method="post">' .
	'<input type="submit" value="   Yes   " name="confirm"/> <a href="post.php">No</a>' .
	'</form></center></div>';
	rb('b');

} else {
	$title = isset ($_POST['title']) ? mysql_real_escape_string($_POST['title']) : '';
	$content = isset ($_POST['content']) ? mysql_real_escape_string($_POST['content']) : '';
	$category = isset ($_POST['category']) ? mysql_real_escape_string($_POST['category']) : '1';
	$nocomment = isset ($_POST['nocomment']) ? mysql_real_escape_string($_POST['nocomment']) : '0';
	$draft = isset ($_POST['draft']) ? $_POST['draft'] : '0';
	if ($action == 'new') {
		if (isset ($_POST['submit'])) {
			if (empty ($title)) {
				show_warning('Insert title please');
			}
			if (empty ($content)) {
				show_warning('Insert post content please');
			}
			$res_author = mysql_fetch_assoc(mysql_query("select id from user where username='$username'"));
			if (!empty ($title) && !empty ($content)) {
				mysql_query("insert into post set " .
				"title='$title'," .
				"content='$content'," .
				"permalink='" . create_permalink($title) . "'," .
				"author='" . $res_author['id'] . "'," .
				"createtime='" . time() . "'," .
				"modtime='" . time() . "'," .
				"category='$category'," .
				"draft='$draft'," .
				"nocomment='$nocomment'");
				$post_id = mysql_insert_id();

				show_notif('Post successfully created. ' .
				 ($draft == 1 ? '(Saved as draft)' : '<a href="' .
				get_post($post_id, 'permalink') . '">See post</a>'));

				$action = 'edit';
				$title = get_post($post_id, 'title');
				$content = get_post($post_id, 'content');
			}
		}
	} else
		if ($action == 'edit') {
			if (!get_post($post_id, 'id')) {
				header('location:post.php');
			}
			if (!isset ($_POST['submit'])) {
				$title = get_post($post_id, 'title');
				$content = get_post($post_id, 'content');
				$category = get_post($post_id, 'category');
				$nocomment = get_post($post_id, 'nocomment');
				$draft = get_post($post_id, 'draft');
			} else {
				if (empty ($title)) {
					show_warning('Inser title please');
				}
				if (empty ($content)) {
					show_warning('Insert post content please');
				}
				if (!empty ($title) && !empty ($content)) {
					mysql_query("update post set " .
					"title='$title'," .
					"content='$content'," .
					"category='$category'," .
					"modtime='" . time() . "'," .
					"nocomment='$nocomment'," .
					"draft='$draft' where id='$post_id'");

					show_notif('Post successfully updated. ' .
					 ($draft == 1 ? '(Saved as draft)' : '<a href="' .
					get_post($post_id, 'permalink') . '">See post</a>'));

					$title = get_post($post_id, 'title');
					$content = get_post($post_id, 'content');
					$category = get_post($post_id, 'category');
					$nocomment = get_post($post_id, 'nocomment');
					$draft = get_post($post_id, 'draft');
				}
			}
		}
	rt('tm');
	echo '<div class="list-head">' . ($action == 'new' ? 'New post' : 'Edit post') . '</div><div class="content">' .
	'<form method="post" action="?action=' . ($action == 'edit' ? 'edit&amp;post_id=' . $post_id : 'new') . '">' .
	'Title:<br /><input type="text" name="title" value="' . $title . '"/><hr />';
	$sql = mysql_query("select * from category");
	echo 'Category:<br /><select name="category">';
	while ($res_category = mysql_fetch_assoc($sql)) {
		echo '<option value="' . $res_category['id'] . '"' . ($category == $res_category['name'] ? ' selected="selected"' : '') . '>' . $res_category['name'] . '</option>';
	}
	echo '</select> <a href="category.php">Manage category</a><hr />' .
	'Post content:<br /><textarea rows="10" name="content">' . $content . '</textarea><hr />' .
	'<input type="checkbox" name="nocomment" value="1"' . ($nocomment == 1 ? ' checked="checked"' : '') . '/> Disable comment<hr />' .
	'<input type="checkbox" name="draft" value="1"' . ($draft == 1 ? ' checked="checked"' : '') . '/> Save as draft<hr/>' .
	'<table><tr><td><input type="submit" value="' . ($action == 'new' ? 'Create' : 'Update') . '" name="submit"/></form></td>' .
	 ($action == 'edit' ? '<td><form action="?action=delete&amp;post_id=' . get_post($post_id, 'id') . '" method="post">' .
	'<input type="submit" value="Delete"/></form></td>' : '') . '</tr></table></div>';
	rb('b');
	rt('t');
	if ($action == 'edit')
		echo '<div class="list-nobullet-top"><a href="?action=new"><img src="' . get_setting('blogurl') . '/images/add.png"> Write new</a></div><hr/>';
	echo '<div class="list-nobullet-top"><a href="post.php"><img src="' . get_setting('blogurl') . '/images/post.png"> Manage article</a></div>';
	rb('b');
}
require_once ('../inc/footer.php');
?>
