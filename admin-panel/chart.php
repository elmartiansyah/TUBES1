<?php
require_once ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
require_once ('../inc/header.php');
$chart = isset ($_GET['chart']) ? $_GET['chart'] : '';
$page = isset ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;
if ($chart != 'comment') {
	$npost = mysql_num_rows(mysql_query("select * from post where view > 0"));
	$start = get_setting('list') * ($page -1);
	$sql = mysql_query("select * from post where view > 0 order by view desc limit $start," . get_setting('list'));
	rt('tm');
	echo '<div class="list-head">Most views</div>';
	if (mysql_num_rows($sql)) {
		while ($post = mysql_fetch_assoc($sql)) {
			echo '<div class="list"><a href="' . get_post($post['id'], 'permalink') . '">' . get_post($post['id'], 'title') . ' (' . $post['view'] . ')</a></div>';
		}
	} else {
		echo '<div class="list">No result available!</div>';
	}
	if ($npost > get_setting('list'))
		show_paging('?chart=view&page=', $page, $npost);
	rb('b');
	if ($chart == 'view') {
		rt('t');
		echo '<div class="list-nobullet-top"><a href="chart.php"><img src="' . get_setting('blogurl') . '/images/chart.png" /> All Statistics</a></div>';
		rb('b');
	}
}
if ($chart != 'view') {
	$npost = mysql_num_rows(mysql_query("select * from post where comment > 0"));
	$start = get_setting('list') * ($page -1);
	$sql = mysql_query("select * from post where comment > 0 order by view desc limit $start," . get_setting('list'));
	rt('tm');
	echo '<div class="list-head">Most comments</div>';
	if (mysql_num_rows($sql)) {
		while ($post = mysql_fetch_assoc($sql)) {
			echo '<div class="list"><a href="' . get_post($post['id'], 'permalink') . '">' . get_post($post['id'], 'title') . ' (' . $post['comment'] . ')</a></div>';
		}
	} else {
		echo '<div class="list">No result available!</div>';
	}
	if ($npost > get_setting('list'))
		show_paging('?chart=comment&page=', $page, $npost);
	rb('b');
	if ($chart == 'comment') {
		rt('t');
		echo '<div class="list-nobullet-top"><a href="chart.php"><img src="' . get_setting('blogurl') . '/images/chart.png" /> All Statistics</a></div>';
		rb('b');
	}
}
require_once ('../inc/footer.php');
?>
