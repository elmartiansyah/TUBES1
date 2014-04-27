<?php
require_once ('inc/init.php');
$home = true;
if ((isset ($_GET['post']) && !empty ($_GET['post'])) || (isset ($_GET['p']) && !empty ($_GET['p']))) {
if(isset ($_GET['post']) && !empty ($_GET['post']))
$sql = mysql_query("select * from post where draft='0' and permalink='" . $_GET['post'] . "'");
if(isset ($_GET['p']) && !empty ($_GET['p']))
$sql = mysql_query("select * from post where draft='0' and id='" . $_GET['p'] . "'");

if ($res_post = mysql_fetch_assoc($sql)) {
$title=$res_post['title'];
require_once ('inc/header.php');
rt('tm');
echo '<div class="list-head"><a href="' . get_post($res_post['id'], 'permalink') . '"><h1>' . get_post($res_post['id'], 'title') . '</h1></a></div>';
echo '<div class="content">';
if (!isset ($_GET['commentpage'])) {
echo '<p>' . smiley(nl2br(get_post($res_post['id'], 'content'))) . '</p><hr />';
if (!isset($_SESSION['com_new']) && !$isadmin)
mysql_query("update post set view='" . ($res_post['view'] + 1) . "' where id='" . $res_post['id'] . "'");
$rater_id=$res_post['id'];
$rater_item_name=$res_post['id'];
require_once('rater.php');
echo '<hr/>';
}

echo '<img src="' . get_setting('blogurl') . '/images/user.png" alt="Author"/> ' .
get_post($res_post['id'], 'author') . ' (' . get_post($res_post['id'], 'createtime') . ')<br />' .
'<img src="' . get_setting('blogurl') . '/images/category.png" alt="Category"/> <a href="' . get_post($res_post['id'], 'categoryurl') . '">' . get_post($res_post['id'], 'category') . '</a>';

if ($isadmin)
echo '<br/><a href="admin-panel/post.php?action=edit&amp;post_id=' . $res_post['id'] . '">[Edit article]</a>';
echo '</div>';
rb('b');

{
rt('t');
echo '<div class="list-nobullet-top">';
require_once ('share.php');
echo '</div>';
rb('b');
}

if (!get_setting('norelated'))
get_post($res_post['id'], 'related');
if (!get_post($res_post['id'], 'nocomment') && !get_setting('nocomment')) {
$commentpage = isset ($_GET['commentpage']) ? $_GET['commentpage'] : 1;
get_comment($res_post['id'], $commentpage);
get_comment_form($res_post['id'], $isadmin);
}
} else {
$_SESSION['notfound'] = 'Page not found';
header('location:' . get_setting('blogurl'));
}
} else
if (isset ($_REQUEST['s']) && !empty ($_REQUEST['s'])) {
$str = trim($_REQUEST['s']);

$sql = mysql_query("select * from `post` where `content` like '%" . mysql_real_escape_string($str) . "%'");
$npost = mysql_num_rows($sql);
$page = isset ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;
$start = get_setting('list') * ($page -1);
$sql = mysql_query("select * from `post` where `content` like '%" . mysql_real_escape_string($str) . "%' limit $start," . get_setting('list'));
if (mysql_num_rows($sql)) {
require_once ('inc/header.php');
rt('tm');
echo '<div class="list-head">Search: ' . $str . '</div>';
while ($res_search = mysql_fetch_assoc($sql)) {

echo '<div class="list"><a href="' . get_post($res_search['id'], 'permalink') . '"><b>' . $res_search['title'] . '</b></a><hr />' .
substr($res_search['content'], 0, 100) . '.... </div>';
}
if ($npost > get_setting('list'))
show_paging(get_setting('blogurl') . '?s=' . $str . '&page=', $page, $npost);
rb('b');
} else {
$_SESSION['notfound'] = 'Search no result.';
header('location:' . get_setting('blogurl'));
}

} else {
require_once ('inc/header.php');

if (isset ($_SESSION['notfound'])) {
show_warning($_SESSION['notfound']);
unset ($_SESSION['notfound']);
}

rt('t');
echo '<div class="content"><center>Space Ads</center>';
echo '</div>';
rb('b');
                                                     

include'shoutbox/shoutbox.php';

$npost = mysql_num_rows(mysql_query("select * from post where draft='0'"));
$page = isset ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;
$start = get_setting('list') * ($page -1);

$sql = mysql_query("select * from post where draft='0' order by createtime desc limit $start," . get_setting('list'));
$i = 0;

//mulai

rt('tm');
echo '<div class="list-nobullet-head"><img src="' . get_setting('blogurl') . '/images/new.png"/> New Article</div>';
if (mysql_num_rows($sql)) {
while ($res_post = mysql_fetch_assoc($sql)) {
echo '<div class="list"><a href="' . get_post($res_post['id'], 'permalink') . '">' . get_post($res_post['id'], 'title') . '</a><br/>
'.substr($res_post['content'], 0, 100).'...<a href="' . get_post($res_post['id'], 'permalink') . '"> [read more]</a><hr><div align="right">[View : '.get_post($res_post['id'], 'view').'] [Comment : '.get_post($res_post['id'], 'comment').']</div></div>';


$i++;
}


if ($npost > get_setting('list'))
show_paging(get_setting('blogurl') . '/p/', $page, $npost);


rb('b');

} else {

echo '<div class="list-top">No article available</div>';

rb('b');

}
if (!get_setting('nocategory'))
show_category();
if (!get_setting('noblogroll'))
show_blogroll();
}



require_once ('inc/footer.php');
?>

