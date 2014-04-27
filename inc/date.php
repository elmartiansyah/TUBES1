<?php

$timezone="7";
$jam=gmdate("H:i",time()+3600*($timezone));
$d=gmdate("d",time()+3600*($timezone));
$m=gmdate("M",time()+3600*($timezone));
$y=gmdate("Y",time()+3600*($timezone));

$n=gmdate("D",time()+3600*($timezone)); {
$loct =date("d M Y || g:ia",time()+(7*3600));
$t=date("Y",time()+3600);
$h=date("z",time()+3600);
$jum=(($t-1)*365)
+(int)(($t-1)/4)+$h;
$di=7*(int)($jum/7);
$dino=$jum-$di;
$pas=5*(int)($jum/5);
$pasar=$jum-$pas;
$dino=str_replace("6","Sat,",$dino);
$dino=str_replace("0","Sun,",$dino);
$dino=str_replace("1","Mon,",$dino);
$dino=str_replace("2","Tue,",$dino);
$dino=str_replace("3","Wed,",$dino);
$dino=str_replace("4","Thu,",$dino);
$dino=str_replace("5","Fri,",$dino);
$pasar=str_replace("4","Legi",$pasar);
$pasar=str_replace("0","Paeng",$pasar);
$pasar=str_replace("1","Pon",$pasar);
$pasar=str_replace("2","Wage",$pasar);
$pasar=str_replace("3","Kliwon",$pasar);
$hp="$dino $pasar";
}

function ch_rus($mes) {
return $mes;
}

$m=ch_rus($m);
$n=ch_rus($n);
echo "".$dino."
".$d." ".$m." ".$y." - ".$jam." WIB<br />";

?>