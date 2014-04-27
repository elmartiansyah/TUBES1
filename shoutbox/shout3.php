<?php
// Main setting
//untuk memanggil data file di folder lain,ganti data dgn memanggil penuh area folder di akhiri dgn slash ke kanan dan tanpa nama file
$set_lokasi='./shoutbox/';
// Jumlah pesan per page:
$CONF['ns'] = 5;// Data untuk mendetexsi musuh agar tidak dapat mengakses page kamu yg di instal shout ini
$block=''.$set_lokasi.'band.dat';
//script di bawah ini jangan di edit
$data_shout= ''.$set_lokasi.'motto.dat';
//link pesan
$link_pesan=''.$set_lokasi.'pesan.php';

// Function
function safe_var($str,$brl=false){
$str=trim(stripslashes(htmlspecialchars($str)));
if($brl) $str=nl2br($str);
$str=strtr($str,array("\r"=>' ',"\n"=>' '));
return $str;
}
// User agent and ip address detected
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $_SERVER['REMOTE_ADDR']=$_SERVER['HTTP_X_FORWARDED_FOR'];
session_start();
?>
