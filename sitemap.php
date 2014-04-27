<?php
require_once ('inc/init.php');
header('Content-type: text/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
$sql = mysql_query("select * from post where draft='0' order by modtime desc");
while ($res_post = mysql_fetch_assoc($sql)) {
	echo '<url>' .
	'<loc>' . get_post($res_post['id'], 'permalink') . '</loc>' .
	'<lastmod>' . date("r", ($res_post['modtime'])) . '</lastmod>' .
	'</url>';
}
echo '</urlset>';
?>
