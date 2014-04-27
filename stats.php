<?php
require_once ('inc/init.php');
require_once ('inc/stats_inc.php');
$title ="Online";
include_once ('inc/header.php');

$data = file($file);
rsort($data);
$p = isset($p) ?intval($p) : 1;
$totalPage = ceil(count($data) / $perPage);
if($p < 1 || $p > $totalPage) $p = 1;
$no = $p * $perPage - $perPage;
for($i=0; $i<$perPage; $i++) {
if(!isset($data[$no])) break;
$line = explode('|~~|', $data[$no]);
rt('t');
echo"<div class=\"content\"><font color=\"#006699\">$line[2]</font><br/><font color=\"#003366\"><i>[$line[1]]</i></font> <font color=\"#000000\"> $line[3]</font></div>\n";
rb('b');
$no++;
}
if($p > 1) echo "<a href=\"$PHP_SELF?p=" . ($p - 1) . "\">[&lt;]</a> ";
if($totalPage > 1) echo "$p/$totalPage";
if($p < $totalPage) echo " <a href=\"$PHP_SELF?p=" . ($p + 1) . "\">[&gt;]</a></div>";
include_once ('inc/footer.php');
die();
?>
