<?php //editing script oleh http://mymotto.110mb.com
include'../system/view/function.php';
require('shout.php');
$title="hapus pesan";
include'../system/view/header.php';

if(isset($_SESSION['sgb_admp']) && isset($_GET['clear'])){
$f=fopen('./motto.dat','w');
fclose($f);
echo('Message has been deleted.');
}elseif(isset($_SESSION['sgb_admp']) && isset($_GET['n'])){
$n=intval($_GET['n']);
$arr=file('./motto.dat');
unset($arr[$n]);
$f=fopen('./motto.dat','w');
$d=implode('',$arr);
fputs($f,$d);
fclose($f);

rt('t');
echo'<div class="list-nobullet-top">';
echo('Pesan telah di hapus..!!');
}else echo('Login dulu utk mengakses halaman ini!');
print('<br />[<a href="indek.php'.psid().'">Shout</a>]</div>');
rb('b');

include'../system/view/footer.php';

?>
