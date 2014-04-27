<?php
require_once ('../inc/init.php');
if(get_setting('norecentcomment')){
	header('location:' . get_setting('blogurl'));
}

if (isset ($_GET['action']) && $_GET['action'] == 'post') {
	$post_id = isset ($_POST['post_id']) ? mysql_real_escape_string(strip_tags($_POST['post_id'])) : '';
	if (!get_post($post_id, 'id')) {
		header('location:' . get_setting('blogurl') . '?404');
		exit;
	}

	$name = isset ($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
	$website = isset ($_POST['website']) ? trim(strip_tags($_POST['website'])) : '';
	$content = isset ($_POST['content']) ? trim(strip_tags($_POST['content'])) : '';

	$_SESSION['com_name'] = $name;
	$_SESSION['com_website'] = $website;
	$_SESSION['com_content'] = $content;
	if (isset ($_SESSION['com_err_msg']))
		unset ($_SESSION['com_err_msg']);


	if (!(isset ($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === trim($_POST['captcha'])) && !$isadmin)
		$_SESSION['com_err_msg'] = 'Security code incorrect';

	if (empty ($content))
		$_SESSION['com_err_msg'] = 'Insert comment please';

	if (empty ($name) && !$isadmin)
		$_SESSION['com_err_msg'] = 'Insert name please';

	if (isset ($_SESSION['com_err_msg'])) {
		require_once ('../inc/header.php');
		get_comment_form($post_id);
		require_once ('../inc/footer.php');
		exit;
	}
	unset ($_SESSION['captcha_keystring']);

	if ($website != '')
		$website = str_replace('http://', '', $website);
	$name= $isadmin ? '' : $name;
	$website= $isadmin ? '' : $website;
	$adm= $isadmin ? 1 : 0;
	$read= $isadmin ? 1 : 0;
	mysql_query("insert into comment set " .
	"post_id='" . $post_id . "'," .
	"name='" . substr(mysql_real_escape_string($name), 0, 40) . "'," .
	"website='" . mysql_real_escape_string($website) . "'," .
	"content='" . substr(mysql_real_escape_string($content), 0, 500) . "'," .
	"adm='$adm'," .
	"isread='$read'," .
	"time='" . time() . "'");
	mysql_query("update post set comment='" . (get_post($post_id,'comment') + 1) . "' where id='" . $post_id . "'");
	unset ($_SESSION['com_content']);
	$_SESSION['com_new'] = '1';
	header('location:' . get_post($post_id, 'permalink') . '#commentlist');
	exit;
}
if (get_setting('norecentcomment'))
	header('location:' . get_setting('blogurl'));

require_once ('../inc/header.php');
$page = isset ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;
get_comment('', $page);
require_once ('../inc/footer.php');
?>
