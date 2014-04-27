<?php
require_once ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
$action = isset ($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	case 'edit' :
	case 'delete' :
		require_once ('../inc/comment-option.php');
		exit;
	default :
		require_once ('../inc/header.php');
		if (isset ($_SESSION['success_notif'])) {
			show_notif($_SESSION['success_notif']);
			unset ($_SESSION['success_notif']);
		}
		rt('tm');
		echo '<div class="list-head">Manage Comments</div>';
		$npost = mysql_num_rows(mysql_query("select * from comment"));
		$page = isset ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;
		$start = get_setting('list') * ($page -1);
		$sql = mysql_query("select * from comment order by time desc limit $start," . get_setting('list'));

		if (mysql_num_rows($sql)) {
			while ($res_comment = mysql_fetch_assoc($sql)) {
				$content = substr(strip_tags($res_comment['content']), 0, 40);
				echo '<div class="list"><a href="?action=edit&amp;comment_id=' . $res_comment['id'] . '"><b>' . ($res_comment['adm'] ? get_admin('nick') : $res_comment['name']) . '</b>: </a> ' . $content . '</div>';
			}
		} else {
			echo '<div class="list">No comment available!</div>';
		}
		if ($npost > get_setting('list'))
			show_paging('?page=', $page, $npost);
		rb('b');
		require_once ('../inc/footer.php');
}
?>
