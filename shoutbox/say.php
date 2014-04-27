<?php
//editing file by http://seupang.Co.Cc http://penceter.co.cc
require('../system/view/function.php');
require('shout.php');
if(!isset($_SESSION['sgb_admp'])) include('bcheck.php');
$arr=file('motto.dat');
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL){
$mulih=$_SERVER['HTTP_REFERER'];
} elseif (ereg("&pass=", $_SERVER['HTTP_REFERER'])){
$mulih='/';
} else { $mulih='/';
}
if(isset($_POST['nick']) && isset($_POST['text'])){
function shit_happened($shit='Unknown error'){
$_SESSION['sgb_err']=$shit;
Header('Location: index.php'.psid());
exit;
}
$data['nick']=safe_var($_POST['nick']);
$data['text']=safe_var($_POST['text'],true);
include'pasar.php';
$data['time']=$wib;
$data['br']=safe_var($_SERVER['HTTP_USER_AGENT']);
$data['hape']=safe_var($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']);
$data['ip']=safe_var($_SERVER['REMOTE_ADDR']);
$tr=@$_POST['tr'];
$data['url']=safe_var($_POST['url']);
$data['email']=safe_var($_POST['email']);
$data['hasil']=safe_var($_POST['hasil']);
$data['avatar']=safe_var($_POST['avatar']);
if(!isset($_SESSION['sgb_name']) or $_SESSION['sgb_name']!=$data['nick']) $_SESSION['sgb_name']=$data['nick'];
if($CONF['captcha'] && (!isset($_POST['code']) || $_POST['code']!=$_SESSION['sgb_code'])) shit_happened('Sign up kode salah!');
if(!isset($_SESSION['sgb_url']) or $_SESSION['sgb_url']!=$data['url']) $_SESSION['sgb_url']=$data['url'];
if(empty($data['nick']) || empty($data['text'])) shit_happened('Hayo!! Nama atau Pesan kudu di isi!');
if(trim($data['nick']) == '' || trim($data['nick']) == 'nama' || trim($data['nick']) == 'NAMA' || trim($data['nick']) == 'nAma' || trim($data['nick']) == 'NaMa' || trim($data['nick']) == 'NaMA' || trim($data['nick']) == 'Admin' ||
trim($data['nick']) == 'admin' ||
trim($data['nick']) == 'AdMiN' ||
trim($data['nick']) == 'ADMIN' ||
trim($data['nick']) == 'robot' ||
trim($data['nick']) == 'Robot' ||
trim($data['nick']) == 'RoBoT' ||
trim($data['nick']) == 'ROBOT' ||
trim($data['nick']) == 'xanax' ||
trim($data['nick']) == 'Xanax' ||
trim($data['nick']) == 'XANAX' ||
trim($data['nick']) == 'valium' ||
trim($data['nick']) == 'Valium' ||
trim($data['nick']) == 'VALIUM' ||
trim($data['nick']) == 'accutane' ||
trim($data['nick']) == 'Accutane' ||
trim($data['nick']) == 'ACCUTANE' ||
trim($data['nick']) == 'tramadol' ||
trim($data['nick']) == 'Tramadol' ||
trim($data['nick']) == 'TRAMADOL' ||
trim($data['nick']) == 'ambien' ||
trim($data['nick']) == 'phentermine' ||
trim($data['nick']) == '' )
shit_happened('harap pergunakan nama lain');
if(trim($data['text']) == '' ||
trim($data['text']) == 'pesan kamu' || trim($data['text']) == '' )
shit_happened('harap ulangi dengan pesan lain brakakak......!');
if(strlen($data['nick'])>10) shit_happened('Nama gak blh lebih dari 10 karakter.');
if(strlen($data['nick'])<3) shit_happened('Nama gak blh kurang dari 3 karakter.');
if(!preg_match("/^[a-zA-Z]*$/", $data['nick'])) shit_happened('Waduh, tak jitak Lhoh. Nama pake hurup aja! Jangan pake spasi ato yg laen, Oke! :p Silahkan <a href="tempat_nulis.php">tulis ulang</a>');
if(strlen($data['url'])>30) shit_happened('kepanjangan nulis url nya maks 30 karakter');
if(strlen($data['text'])<2) shit_happened('Pesen nya gak blh kurang dari 2 karakter sayangg! Ckakak..');
if(strlen($data['text'])>$set[shout])
shit_happened('Sabar2, pesan gak blh lbh dari '.$set[shout].' karakter ('.round(strlen($data['text'])/1024,1).'kb > 3,5kb)');
if(empty($data['hasil'])) shit_happened('Wew, Sign up kode  kok masih kosong?');
if($_POST['kode']!=$_POST['hasil']) shit_happened('Nulisnya yg bener duonk! Sign up kode salah tuwh!');
if(empty($data['avatar'])) shit_happened('Icon belum ada yang dipilih');
$cnt=count($arr);
if($cnt>0){
$post=unserialize($arr[0]);
if($data['text']==$post['text'])shit_happened('Wew, mau ngeplud yak?');
}
require('./smiles.php');
$data['text']=str_replace($sstr,$simg,$data['text']);
if($cnt>$CONF['np']) unset($arr[$cnt-1]);$f=fopen('./motto.dat','w');
fputs($f,serialize($data)."\n".implode('',$arr));
fclose($f);
header('Location: '.$mulih.''.psid());
}else{
ob_start();
if($CONF['captcha']){
# CAPTCHA string length
$length = mt_rand(5,6);
# symbols used to draw CAPTCHA
$allowed_sym = '23456789abcdeghkmnpqsuvxyz'; #alphabet without similar symbols (o=0, 1=l, i=j, t=f)
while(true){
$keystr='';
for($i=0;$i<$length;$i++){
$keystr.=$allowed_sym{mt_rand(0,strlen($allowed_sym)-1)};
}
if(!preg_match('/cp|cb|ck|c6|c9|rn|rm|mm|co|do|cl|db|qp|qb|dp/', $keystr)) break;
}
$_SESSION['sgb_code']=$keystr;
}
$title = "kesalahan";
include "../system/view/header1.php";
if(isset($_SESSION['sgb_err'])){
print('<div class="row"><center>'.$_SESSION['sgb_err']); unset($_SESSION['sgb_err']);
echo'</center></div>';
}else print'<div class="row"><center>Silahkan <a href="index.php?"> kembali</a></center></div>';
include'../system/view/footer.php';
ob_end_flush();
}
?>
