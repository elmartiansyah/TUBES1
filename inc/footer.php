<?php
if($isadmin){
rt('t');
echo '<div class="list-nobullet-top"><a href="' . get_setting('blogurl') . '/admin-panel"><img src="' . get_setting('blogurl') . '/images/panel.png" /> Admin panel</a></div>' .
'<div class="list-nobullet"><a href="?logout"><img src="' . get_setting('blogurl') . '/images/logout.png" /> Logout</a></div>';
rb('b');
}
{
rt('t');
echo '<div class="content">';
include ('count.php');
echo '</div>';
rb('b');
}


echo '</div><div class="header"><center>&copy; 2012 - ' . date('Y') . ' <a href="http://waptok.asia">Waptok.[asia]</a><br/>Powered by <a href="http://wapkul.tk">WAPKUL</a><br />';
list($msec, $sec)=explode(chr(3), microtime());
echo'Speed : '.round(($sec+$msec)-$conf['headtime'],3).' / sec';
$gzib_contents = ob_get_contents();
$gzib_file = strlen($gzib_contents);
$gzib_file_out = strlen(gzcompress($gzib_contents, 9));
echo' - Gzip : '.round(100 - (100 / ($gzib_file / $gzib_file_out)), 1).'%';
echo'</div>';
echo '</body></html>';
?>
