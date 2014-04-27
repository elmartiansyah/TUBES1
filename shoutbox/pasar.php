<?php
$moto="$set[waktu]";
$tang =date("j/m/y",time()+($moto*3600));
$jam =date("H:i",time()+($moto*3600*7));
$t=date("Y",time()+($moto*3600));
$h=date("z",time()+($moto*3600));
$jum=(($t-1)*365)
+(int)(($t-1)/4)+$h;
$di=7*(int)($jum/7);
$dino=$jum-$di;
$pas=5*(int)($jum/5);
$pasar=$jum-$pas;
$dino=str_replace("6","Sabtu",$dino);
$dino=str_replace("0","Minggu",$dino);
$dino=str_replace("1","Senin",$dino);
$dino=str_replace("2","Selasa",$dino);
$dino=str_replace("3","Rabu",$dino);
$dino=str_replace("4","Kamis",$dino);
$dino=str_replace("5","Jum'at",$dino);
$pasar=str_replace("4","Legi",$pasar);
$pasar=str_replace("0","Pahing",$pasar);
$pasar=str_replace("1","Pon",$pasar);
$pasar
=str_replace("2","Wage",$pasar);
$pasar=str_replace("3","Kliwon",$pasar);
$dinojowo="$dino $pasar";
$wib="$dino - $tang $jam";
?>
