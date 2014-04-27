<?php
require_once ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
$action = isset ($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	case 'new' :
	case 'edit' :
	case 'delete' :
		require_once ('../inc/category-option.php');
		exit;
	default :
		require_once ('../inc/header.php');
		if (isset ($_SESSION['success_notif'])) {
			show_notif($_SESSION['success_notif']);
			unset ($_SESSION['success_notif']);
		}
		rt('t');
		echo '<div class="list-nobullet-top"><a href="?action=new"><img src="' . get_setting('blogurl') . '/images/add.png" /> Add New</a></div>';
		rb('b');

		rt('tm');
		echo '<div class="list-head">Category</div>';
		$npost = mysql_num_rows(mysql_query("select * from category"));
		$page = isset ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;
		$start = get_setting('list') * ($page -1);
		$sql = mysql_query("select * from category limit $start," . get_setting('list'));

		if (mysql_num_rows($sql)) {
			while ($res_category = mysql_fetch_assoc($sql)) {
				echo '<div class="list"><a href="?action=edit&amp;cat_id=' . $res_category['id'] . '">' . $res_category['name'] . '</a></div>';
			}
		}else{
			echo '<div class="list">No category available!</div>';
		}
		if ($npost > get_setting('list'))
				show_paging('?page=', $page, $npost);
		rb('b');
		require_once ('../inc/footer.php');
}
?>
