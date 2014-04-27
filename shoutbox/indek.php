<?php //editing scrip dari http://mymotto.110mb.com
//editing file by http://seupang.Co.Cc http://penceter.co.cc
include'../system/view/function.php';
require('shout.php');
$perf = new perf;
$c=intval(@$_GET['c']);
if(!isset($_SESSION['sgb_admp']))
include('bcheck.php');
ob_start();
$title = "Panel shoutbox";
include'../system/view/header.php';
if(isset($_SESSION['sgb_admp'])){
rt('t');
echo'<div class="list-nobullet-top">
Keterangan utk: D-B-E<br />
D: Delete pesan<br/>
B: Banned user<br />
E: Edit nama, pesan, dan admin jawab pesan<br />
</div>';
rb('b');
}
if(isset($_SESSION['sgb_err'])){
print('<div class="row"><center>'.$_SESSION['sgb_err']); unset($_SESSION['sgb_err']);
echo'</center></div>';
}
// Fungsi user online, yg config nya ada di folder shout.php
$onl = new online;
$onl->add();
include ('tulis.php');
//menyimpan data pesan
// Membuka data gb
$arr=file('motto.dat');
$cnt=count($arr);
for($i=0;$i<$CONF['ns'];$i++){
if($c==$cnt) break;
$post=unserialize($arr[$c]);
// Hasil post pesan
$nama = $post['nick'];
$nama=strtolower($nama);
$jam = $post['time'];
$pesan = $post['text'];
$avatar = $post['avatar'];
include('pesan.php');
$browser = strtok($post['br'],' ');
$ip = $post['ip'];
$browser = str_replace('Nokia','NOK ',$browser);$browser = str_replace('SonyEricsson','SE ',$browser);
$browser = str_replace('Siemens','SIE ',$browser);
$browser = str_replace('Motorola','MOT ',$browser);
$browser = str_replace('/',' ',$browser);
$browser = str_replace('Opera','Op',$browser);
$browser = str_replace('Mozilla','Moz',$browser);
$hape = $post['hape'];
$hape = strtok($hape,'/');
$hape = str_replace('/',' ',$hape);
$hape = str_replace('Opera','Op',$hape);
$hape = str_replace('Mozilla','Moz',$hape);
$hape = str_replace('Nokia','NOK ',$hape);
$hape = str_replace('SE','SE ',$hape);
$hape = str_replace('Siemens','SIE ',$hape);
$hape = str_replace('Motorola','MOT ',$hape);
$versi = $post['br'];
$versi = explode(' ',$versi);
$versi = $versi[3];
$versi = str_replace("Mini","OpMin",$versi);
$versi = str_replace("/"," ",$versi);
$url = $post['url'];
$url = str_replace("\r\n","",$url);
$email = $post['email'];
$email = str_replace("\r\n","",$email);
rt('tm');
print'<div class="list-nobullet-head"><center>'.$jam.'</center></div>';
// Jika sessi admin login, maka akan muncul data utk Delete, Banned dan Edit postingan pengunjung sbb:
if(isset($_SESSION['sgb_admp'])) print('<div class="list-nobullet"><center><small> [<a href="'.get_setting('blogurl').'/shoutbox/del.php?n='.$c.'&amp;'.SID.'"> D </a>-<a href="'.get_setting('blogurl').'/shoutbox/ban.php?n='.$c.'&amp;'.SID.'"> B </a>-<a href="'.get_setting('blogurl').'/shoutbox/edit.php?n='.$c.'&amp;'.SID.'"> E </a>]</small></center></div>');
include('nama.php');
if(ereg("png", trim($avatar))){
$ikon='<img src="'.get_setting('blogurl').'/'.$avatar.'" alt="">';
}
if (trim($post[url])<>"" and trim($post[url])<>"http://") {
if (ereg("^", trim($post[url])))
echo'<div class="menu"><span class="off">'.$ikon.'</span><b><a href="'.$url.'">'.$aran.'</a></b> &raquo; ';
}
else echo' <div class="menu"><span class="off">'.$ikon.'</span><b>'.$aran.'</b> &raquo; ';
echo'<font color="#8888ff">'.$pesan.'</font></div>';
// Jika admin menjawab, yg tertampil sbb:
if(isset($post['answ']))
print'<div class="list-nobullet"><font color="#ff0000"><b>RE : </font></b>';
echo'<font color="#ef00ff">'.$post['answ'].'</font>';
// Menampilkan data ISP (Internet Service Provider)
if(isset($_SESSION['sgb_admp'])) {
echo'<div class="list-nobullet">';
echo'Kartu: ';
include('provider.php');
echo'<br />UA: '.$browser.'<br />';
if(trim($versi)){
echo'Ver: '.$versi.'<br />';
}
if(trim($hape)){
echo'Mobile: '.$hape.'<br />';
}
// Jika nama admin melakukan posting, IP nya di umpetin :p atau bsa di modif yg laen. Hehe..
if($nama == '<b><font color="red">n</font><font color="lime">e</font><font color="white">o</font><font color="fuchsia">&trade;</font></b>')
{
print'IP: xxx.xxx.xxx.xxx<br />';
}else{
print'IP: '.$ip.'<br />';

}

}

echo'</div>';

rb('b');

$c++;
}
rt('t');
echo'<div class="content"><center>';
if($c>$CONF['ns']){
print('[<a href="?c='.($c-$CONF['ns']-$i).''.SID.'">&#171;</a>]|');
}else{
print'[&#171;]|';
}
echo $cnt;
if($c<$cnt){
print('|[<a href="?c='.$c.''.SID.'">&#187;</a>]<br />');
}else{
print'|[&#187;]<br />';
}
echo'</center></div>';
rb('b');
include'../system/view/footer.php';
?>
