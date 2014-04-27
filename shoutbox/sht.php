<?php //editing scrip dari http://mymotto.110mb.com
//di edit lagi oleh http://seupang.Co.Cc
$c=intval(@$_GET['c']);
if(!isset($_SESSION['sgb_admp']))
ob_start();
// Membuka data gb
$arr=file(''.$data_shout.'');
$cnt=count($arr);
for($i=0;$i<$CONF['ns'];$i++){
if($c==$cnt) break;
$post=unserialize($arr[$c]);
// Hasil post pesan
$nama = $post['nick'];
$nama=strtolower($nama);
$jam = $post['time'];
$pesan = $post['text'];
include'pesan.php';
$browser = strtok($post['br'],' '); $ip = $post['ip'];
$browser = str_replace('Nokia','NOK ',$browser);
$browser = str_replace('SonyEricsson','SE ',$browser);
$browser = str_replace('Siemens','SIE ',$browser);
$browser = str_replace('Motorola','MOT ',$browser);
$browser = str_replace('BlackBerry','BB ',$browser);
$browser = str_replace('/',' ',$browser);
$browser = str_replace('Opera','Op',$browser);
$browser = str_replace('Mozilla','Moz',$browser);
$hape = $post['hape'];
$hape = strtok($hape,'/');
$hape = str_replace('/',' ',$hape);
$hape = str_replace('Mozilla','Moz',$hape);
$hape = str_replace('Nokia','NOK ',$hape);
$hape = str_replace('SonyEricsson','SE ',$hape);
$hape = str_replace('Siemens','SIE ',$hape);
$hape = str_replace('Motorola','MOT ',$hape);
$hape = str_replace('BlackBerry','BB ',$hape);
$avatar = $post['avatar'];
if(ereg("png", trim($avatar))){
$ikon='<img src="'.$avatar.'" alt="">';
}
$url = $post['url'];
$url = str_replace("\r\n","",$url);
if(isset($_SESSION['sgb_admp']))
include''.$link_pesan.'';
include'nama.php';
{
rt('tm');
echo '<div class="list-nobullet-head"><center><b>'.$jam.'</b></center></div><div class="list-nobullet"><table width="100%"><tr><td width="5%">';
if (trim($post[url])<>"" and trim($post[url])<>"http://") {
if (ereg("^", trim($post[url])))
echo'<div class="paging"><img src="'.get_setting('blogurl').'/'.$avatar.'" width="35" height="35" alt="*"/></div></td><td width="95%"></div><div class="paging"><b>Nama : <font color="blue"><span style="text-shadow:black 0.10em 0.10em 0.10em" valign="_top"><a href="'.$url.'" target="_blank">'.$aran.'</a></span>&trade;</font></b><br/><b>Kartu :</b> ';
}
else echo'<div class="paging"><img src="'.get_setting('blogurl').'/'.$avatar.'" width="35" height="35" alt="*"/></div></td><td width="95%"><div class="paging"><b>Nama : <font color="blue"><span style="text-shadow:black 0.10em 0.10em 0.10em" valign="_top">'.$aran.'</span>&trade;</font></b><br/><b>Kartu : ';
include'provider.php';
print'</b></div></td></table>';
echo '<div class="list-nobullet"><b><font color="red">Pesan : </font></b>'.$pesan.'';
echo'</div>';
echo '<div class="list-nobullet"> Melalui : '.$versi.' '.$hape.'</span><br/> IP : '.$ip.'</a><br/> Share : <a href="http://m.facebook.com/
sharer.php?u=http://
pojokeblog.tk/">Facebook</a> | <a href="http://twitter.com/share?url=http://pojokeblog.tk/">Twitter</a>';

if (trim($post[url])<>"" and trim($post[url])<>"http://") { if (ereg("^", trim($post[url]))) echo'<br/> Situs : <a href="'.$url.'" target="_blank">'.$url.'</a>'; 
}

if(isset($post['answ']))
print'<div style="background-color : #e3e5e3;
border-style : dotted;
color: red;
border-width : 1px;
border-color : #b8c1b7;
border-color : #b8c1b7;
padding : 1px;
padding-left : 3px;
background-repeat : repeat-y;
font-size : 11px;">';
echo'<font color="#ef00ff">'.$post['answ'].'</font>';

echo'</div></div>';
rb('b');

}

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
?>
