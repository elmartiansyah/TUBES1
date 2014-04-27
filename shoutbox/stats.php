<?php
$pageName ='online';
$PHP_SELF = basename($_SERVER['PHP_SELF']);
require '../system/view/stats_inc.php';
include'../system/view/function.php';
$title ="online";
include("../system/view/header1.php");
echo "<div class=\"row\"><font color=\"red\"><b>&#187;</b></font> <a href=\"/\">Home</a></div>";
echo "<div class=\"row\"><font color=\"red\"><b>&#187;</b></font> <a href=\"/bukutamu\">Guestbook</a></div>";
$data = file($file);
rsort($data);
$p = isset($p) ?intval($p) : 1;
$totalPage = ceil(count($data) / $perPage);
if($p < 1 || $p > $totalPage) $p = 1;
$no = $p * $perPage - $perPage;
for($i=0; $i<$perPage; $i++) {
if(!isset($data[$no])) break;
$line = explode('|~~|', $data[$no]);
echo"<div class=\"row\"><font color=\"#006699\">$line[2]</font><br/><font color=\"#003366\"><i>[$line[1]]</i></font></div>\n<blink> $line[3]</blink><br/>\n";
$no++;
}
if($p > 1) echo "<a href=\"$PHP_SELF?p=" . ($p - 1) . "\">[&lt;]</a> ";
if($totalPage > 1) echo "$p/$totalPage";
if($p < $totalPage) echo " <a href=\"$PHP_SELF?p=" . ($p + 1) . "\">[&gt;]</a></div>";
include("../system/view/footer.php");
die();
?>
