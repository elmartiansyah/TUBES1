<?php
error_reporting(0);
session_start();
//info waktu
$jam = gmdate("D, d-m-Y" , time() +3600*7);
$jam = str_replace("Mon","Senin",$jam);
$jam = str_replace("Tue","Selasa",$jam);
$jam = str_replace("Wed","Rabu",$jam);
$jam = str_replace("Thu","Kamis",$jam);
$jam = str_replace("Fri","Jum'at",$jam);
$jam = str_replace("Sat","Sabtu",$jam);
$jam = str_replace("Sun","Minggu",$jam);
$TimeZone="+7";
$New_Time = time() + ($TimeZone * 60 * 60);
$_time=gmdate("H:i",$New_Time);

//info browsers
if($_SERVER["REMOTE_ADDR"]){$ip=$_SERVER["REMOTE_ADDR"];
$proxy="no";
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);}
else{$ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
$proxy="yes";
$hostname = gethostbyaddr($_SERVER['HTTP_X_FORWARDED_FOR']);}
$browser = explode("(",$_SERVER["HTTP_USER_AGENT"]);
$browser = $browser[0];
ob_start();
header("Content-type: text/html; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified:".gmdate("D, d M Y H:i:s")."GMT");
header("Pragma: must-revalidate");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>
<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\">
<head><title>$title</title><link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS feed\" href=\"$set[rss]\">
<meta name=\"description\" content=\"$set[description]\" />
<meta name=\"author\" content=\"Perfcms Shout\" />
<meta name=\"keywords\" content=\"$set[description]\" />
<link rel=\"shortcut icon\" href=\"/favicon.ico\"><link rel=\"stylesheet\" href=\"$set[css]\" type=\"text/css\"></style></head><body>";
echo'<div class="main">
<div class="logo"><img height="45px" width="150" src="/template/icons/logo.png" alt="logo" /></div></div>';
echo'<center><div class="news"><a href="/index.php">Home</a>';
echo' | <a href="/shoutbox">Shout</a>';
echo' | <a href="/bukutamu">Guest</a>';
echo' | <a href="/news">News</a>';
echo'</center></div>';
?>
