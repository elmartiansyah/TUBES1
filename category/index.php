<?php
require_once ('../inc/init.php');
require_once ('../inc/header.php');
if (isset ($_GET['category']) && !empty ($_GET['category'])) {
	$str = trim($_GET['category']);
	$category = mysql_fetch_assoc(mysql_query("select * from category where url='" . mysql_real_escape_string($str) . "'"));
	if (!$category['id']) {
		$_SESSION['notfound'] = 'Category \'' . $str . '\' not available';
		header('location:' . get_setting('blogurl'));
	}

	$npost = mysql_num_rows(mysql_query("select * from post where category='" . $category['id'] . "'"));
	$page = isset ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;
	$start = get_setting('list') * ($page -1);
	$sql = mysql_query("select * from post where category='" . $category['id'] . "' order by createtime desc limit $start," . get_setting('list'));
	$i = 0;
	rt('tm');
	echo '<div class="list-head"> Category \'' . filter($category['name']) . '\'</div>';
	if (mysql_num_rows($sql)) {
		while ($res_post = mysql_fetch_assoc($sql)) {
			echo '<div class="list"><a href="' . get_post($res_post['id'], 'permalink') . '">' . get_post($res_post['id'], 'title') . '</a></div>';
			$i++;
		}
		if ($npost > get_setting('list'))
			show_paging(get_setting('blogurl') . '/category/' . $str . '/p', $page, $npost);

	} else {
		echo '<div class="list">No article available</div>';
	}
	echo '<div class="list"><a href="' . get_setting('blogurl') . '/category"> << All category</a></div>';
	rb('b');
} else {
	show_category();
}
require_once ('../inc/footer.php');
?>
