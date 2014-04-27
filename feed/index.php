<?php
require_once ('../inc/init.php');
header('content-type: application/xml');
$res_lastbuild=mysql_fetch_assoc(mysql_query("select modtime from post order by modtime desc"));
echo '<?xml version="1.0" encoding="utf-8"?>' .
'<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/"><channel>' .
'<title>' . get_setting('blogname') . '</title>' .
'<link>' . get_setting('blogurl') . '</link>' .
'<description>' . get_setting('blogdescription') . '</description>' .
'<lastBuildDate>' . date("r", $res_lastbuild['modtime']) . '</lastBuildDate>' .
'<language>en</language>';

$sql = mysql_query("select * from post where draft='0' order by createtime desc limit 10");
while ($res_rss = mysql_fetch_assoc($sql)) {
	$len = strlen($content);
	echo '<item><title>' . htmlentities(get_post($res_rss['id'], 'title')) . '</title>' .
	'<link>' . get_post($res_rss['id'], 'permalink') . '</link>' .
	'<description>' . htmlentities(nl2br(get_post($res_rss['id'], 'content'))) . '</description>' .
	'<pubDate>' . date("r", $res_rss['modtime']) . '</pubDate></item>';
}
echo '</channel></rss>';
?>
