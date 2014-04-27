<?php //editing script oleh http://mymotto.110mb.com
require('../system/view/function.php');
require('./shout.php');
$title="banlist";
require('../system/view/header1.php');
if(!isset($_SESSION['sgb_admp'])){ header('Location: index.php'.psid()); exit; }
$bf=file('./ban.dat');
if(isset($_GET['n'])){
$n=intval($_GET['n']);
unset($bf[$n]);
$f=fopen('./ban.dat','w');
$d=implode('',$bf);
fputs($f,$d);
fclose($f);
Header('Location: banlist.php'.psid());
exit;
}
if(empty($bf[0])) die('Daftar user yg di banned kosong.<hr />[<a href="index.php'.psid().'">Back</a>]</div>');
print('<div class="row"><i>(Method :: Delet)</i><hr />');
$cnt=count($bf);
for($i=0;$i<$cnt;$i++){
$a=explode('|:|',$bf[$i]);
print('[<a href="banlist.php?n='.$i.'&amp;'.SID.'">X</a>] ');
switch($a[0]){
case 0:
print('IP+Br');
break;
case 1:
print('Br');
break;
case 2:
print('IP');
break;
case 3:
print('C. ip+br');
break;
case 4:
print('C. br');
break;
case 5:
print('C. ip');
break;
case 6:
print('Total Ban');
break;
}
print(' :: '.$a[1].'<hr />');
}
echo('[<a href="index.php?'.psid().'">Shout</a>]</div>');
require('../system/view/footer.php');
?>
