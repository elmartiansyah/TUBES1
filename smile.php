<?php
@$pas=$_GET['pas'];
@$n=$_GET['n'];
$pageName ='Smiles';
$PHP_SELF = basename($_SERVER['PHP_SELF']);
ini_set("display_errors",0);

include('inc/init.php');
include('inc/functions.php');
$title=" Smile";
include'inc/header.php';
// require('shout/shoutbox.php');
rt('tm');
echo'<div class="list-head"> List smile</div>';
echo'<div class="menu">';
require('shoutbox/smiles.php');
$cnt=count($sstr);
for($c=0;$c<7;$c++){
if($c+$n>$cnt-1) break;
echo'<div class="menu">';
print $simg[$c+$n].' '.$sstr[$c+$n].'</div>
';
}
print '</div>';
$n=$n+$c;
if($n<$cnt){
print '<div class="menu">&gt;<a href="smile.php?n='.$n;
if($pas) print '&amp;pas='.$pas;
print '"> Next</a></div>';
}
rb('b');
include"inc/footer.php";
?>
