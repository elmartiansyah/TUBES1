<?php
require_once ('../inc/header.php');
$action = isset ($_GET['action']) ? $_GET['action'] : '';
$comment_id = isset ($_GET['comment_id']) ? $_GET['comment_id'] : '';
$res_comment = mysql_fetch_assoc(mysql_query("select * from comment where id='$comment_id'"));
if ($action == 'delete') {
	if (!$res_comment) {
		header('location:' . get_setting('blogurl') . '/admin-panel/comment.php');
	}
	if (isset ($_POST['confirm'])) {
		mysql_query("delete from comment where id='$comment_id'");
		mysql_query("update post set comment='" . (get_post($res_comment['post_id'],'comment') - 1) . "' where id='" . $res_comment['post_id'] . "'");
		$_SESSION['success_notif']='Comment successfully removed';
		header('location:comment.php');
		exit;
	}
	rt('tm');
	echo '<div class="list-head">Delete comment?</div>' .
	'<div class="content"><center>' . substr($res_comment['content'],0,100) . '<br/><br /><form action="comment.php?action=delete&amp;comment_id=' . $comment_id . '" method="post"><input type="submit" value="   Yes   " name="confirm"/> ' .
	'<a href="comment.php">No</a></form></center></div>';
	rb('b');
} else {
	if (!$res_comment) {
		header('location:' . get_setting('blogurl') . '/admin-panel/comment.php');
	}
	$name = isset ($_POST['name']) ? mysql_real_escape_string($_POST['name']) : '';
	$content = isset ($_POST['content']) ? mysql_real_escape_string($_POST['content']) : '';
	$website = isset ($_POST['website']) ? mysql_real_escape_string($_POST['website']) : '';
	$comment_id = isset ($_GET['comment_id']) ? $_GET['comment_id'] : '';

	if (!isset ($_POST['submit'])) {
		$name = $res_comment['name'];
		$content = $res_comment['content'];
		$website = $res_comment['website'];

	} else {
		if (empty ($name) && !$res_comment['adm']) {
			show_warning('Insert name please.');
		}
		if (empty ($content)) {
			show_warning('Insert comment please.');
		}
		if ((!empty ($name) || $res_comment['adm']) && !empty ($content)) {
			mysql_query("update comment set " .
			"name='$name'," .
			"content='$content'," .
			"website='$website' where id='$comment_id'");
			show_notif('Comment successfully edited.');
			$res_comment = mysql_fetch_assoc(mysql_query("select * from comment where id='$comment_id'")) or die (mysql_error());
			$name = $res_comment['name'];
			$content = $res_comment['content'];
			$website = $res_comment['website'];
		}
	}
	rt('tm');
	echo '<div class="list-head">Edit Comment</div>' .
	'<div class="content"><form method="post" action="' . get_setting('blogurl') . '/admin-panel/comment.php?action=edit&amp;comment_id=' . $comment_id . '">' .
	($res_comment['adm'] ? 'Name : ' . get_admin('nick') . '<hr/>' : 'Name:<br /><input type="text" name="name" value="' . $name . '"/><br />') .
	($res_comment['adm'] ? '' : 'Website:<br /><input type="text" name="website" value="' . $website . '"/><br />');

	echo 'Comment:<br /><textarea rows="5" name="content">' . $content . '</textarea><br />' .
	'<table><tr><td><input type="submit" value="Edit Comment" name="submit"/></form></td>' .
	'<td><form action="?action=delete&amp;comment_id=' . $comment_id . '" method="post"><input type="submit" value="Delete"/></form></td>' .
	'</tr></table></div>';
	rb('b');
	rt('t');
	echo '<div class="list-nobullet-top"><a href="comment.php"><img src="' . get_setting('blogurl') . '/images/comments.png"> Manage comment</a></div>';
	rb('b');
}
require_once ('../inc/footer.php');
?>
