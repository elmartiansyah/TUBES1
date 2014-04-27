<?php
require_once ('../inc/init.php');
require_once ('../inc/header.php');
if ($isadmin) {
	if (isset ($_GET['readcomment'])) {
		$sql = mysql_query("select * from comment where isread='0' and adm='0' group by post_id");
		if (mysql_num_rows($sql)) {
			rt('tm');
			echo '<div class="list-head">Recent comments</div>';
			while ($res_comment = mysql_fetch_assoc($sql)) {
				$ncomment = mysql_num_rows(mysql_query("select * from comment where isread='0' and adm='0' and post_id='" . $res_comment['post_id'] . "'"));
				echo '<div class="list"><a href="' . get_post($res_comment['post_id'], 'permalink') . '#commentlist" target="_blank"> ' . get_post($res_comment['post_id'], 'title') . ' (' . $ncomment . ')</a></div>';
			}
			mysql_query("update comment set isread='1' where isread='0'");
			rb('b');
		} else {
			header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
		}
	} else {
		if (isset ($_SESSION['success_install'])) {
			$notif = $_SESSION['success_install'] . (file_exists('../install.php') ? ', dont forget to delete file "install.php"' : '');
			show_notif($notif);
			unset ($_SESSION['success_install']);
			$notif='';
		}
		rt('tm');
		echo '<div class="list-head"><b>Admin panel</b></div>';
		echo '<div class="list-nobullet"><a href="post.php"><img src="' . get_setting('blogurl') . '/images/post.png" /> Manage article</a></div>' .
		'<div class="list-nobullet"><a href="category.php"><img src="' . get_setting('blogurl') . '/images/category.png" /> Manage category</a></div>' .
		'<div class="list-nobullet"><a href="comment.php"><img src="' . get_setting('blogurl') . '/images/comments.png" /> Manage comment</a></div>' .
		'<div class="list-nobullet"><a href="blogroll.php"><img src="' . get_setting('blogurl') . '/images/blogroll.png" /> Manage blogroll</a></div>' .
		'<div class="list-nobullet"><a href="filemanager.php"><img src="' . get_setting('blogurl') . '/images/folder.png" /> File manager</a></div>' .
		'<div class="list-nobullet"><a href="profile.php"><img src="' . get_setting('blogurl') . '/images/user.png" /> Manage profile</a></div>' .
		'<div class="list-nobullet"><a href="password.php"><img src="' . get_setting('blogurl') . '/images/pass.png" /> Change password</a></div>' .
		'<div class="list-nobullet"><a href="setting.php"><img src="' . get_setting('blogurl') . '/images/setting.png" /> Blog setting</a></div>' .
		'<div class="list-nobullet"><a href="metatag.php"><img src="' . get_setting('blogurl') . '/images/metatag.png" /> Meta tag setting</a></div>' .
		'<div class="list-nobullet"><a href="chart.php"><img src="' . get_setting('blogurl') . '/images/chart.png" /> Statistics</a></div>';
		rb('b');
	}
} else {
	if (isset ($err))
		show_warning($err);
	rt('tm');
	echo '<div class="list-head"><b>Admin Panel</b></div>';
	echo '<div class="content"><form action="?login" method="post">' .
	'<table style="width:100%;">' .
	'<tr><td style="width:16px;"><img src="' . get_setting('blogurl') . '/images/user.png"/></td>' .
	'<td><input type="text" name="username" value="" maxlength="20"/></td></tr>' .
	'<tr><td><img src="' . get_setting('blogurl') . '/images/pass.png"/></td>' .
	'<td><input type="password" name="password" maxlength="20"/></td></tr>' .
	'<tr><td></td><td><input type="submit" name="submit" value="  Login  "/></td></tr></table></form></div>';
	rb('b');
}

require_once ('../inc/footer.php');
?>
