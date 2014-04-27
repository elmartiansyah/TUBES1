<?php
require'../system/view/function.php';
require('shout.php');
$title="ban user";
include "../system/view/header.php";
if(!isset($_SESSION['sgb_admp'])) die('<div class="list-notif">Kamu tidak dapat mengakses page ini,silahkan login dulu.</div>');
elseif(!isset($_GET['n'])) die('O?@a.</div>');
elseif(isset($_POST['method'])){
$n=intval($_GET['n']);
$arr=file('motto.dat');
$a=unserialize($arr[$n]);
$_POST['method']=intval($_POST['method']);
switch($_POST['method']){
case 0:
$str='0|:|'.$a['br'].' IP:'.$a['ip'];
break;
case 1:
$str='1|:|'.$a['br'];
break;
case 2:
$str='2|:|'.$a['ip'];
break;
case 3:
$str='3|:|'.$a['br'].' IP:'.$a['ip'];break;
case 4:
$str='4|:|'.$a['br'];
break;
case 5:
$str='5|:|'.$a['ip'];
break;
case 6:
$str='6|:|';
break;
}
$f=fopen('./ban.dat','a');
fwrite($f,$str."\n");
fclose($f);
print('A?? A@?e? ?@??c?<hr />');
if($_POST['method']>2 && $_POST['method']<6) print('<small>B?pa???A@? c ????cookies,<br />
cpo?A??? ??p? ???e??pe?7 cy??<br />
Ka???? ?????? ????cookie A?? @A?yA?? ? ?c?</small><hr />');
}else{
rt('t');
echo'<div class="list-nobuleet-top">';
$n=intval($_GET['n']);
print('<form action="ban.php?n='.$n.'&amp;'.SID.'" method="post">
<div class="row">Select banned:<br /><select name="method" title="method">
<option value="0">IP+Browser</option>
<option value="1">Browser</option>
<option value="2">IP</option>
<option value="3">Cookie(IP+Browser)</option>
<option value="4">Cookie(Browser)</option>
<option value="5">Cookie(IP)</option>
<option value="6">Banned All</option>
</select><br />
<input type="submit" value="Ban user" />
</form></div>');
}
print('<div class="row">[<a href="index.php?'.psid().'">Shoutbox</a>]<br />[<a href="indek.php?'.psid().'">Admin</a>]</div></div>');
rb('b');
include "../system/view/footer.php";
?>
