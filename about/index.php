<?php
require_once('../inc/init.php');
if(get_setting('noprofile')){
	header('location:' . get_setting('blogurl'));
}
require_once('../inc/header.php');
	rt('t');
	echo '<div class="content"><h2><img src="' . get_setting('blogurl') . '/images/user.png" alt="About author"/> About Author</h2><br/>' . filter(nl2br(get_admin('about'))) . '</div>';
	rb('b');
require_once('../inc/footer.php');
?>
