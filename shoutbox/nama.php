<?
$teks ="$nama";
$hasil ="";
$warna =0;
$turn =0;
while($warna<=strlen($teks)){ $warnahuruf = substr($teks,$warna,1);
$warna++;
if($turn==0){$turn=1;
$hasil .= "<FONT color=\"ff0000\">".$warnahuruf."</FONT>"; }
else
if($turn==1){$turn=2;
$hasil .= "<FONT color=\"ff6200\">".$warnahuruf."</FONT>"; }
else
if($turn==2){$turn=3;
$hasil .= "<FONT color=\"ff8000\">".$warnahuruf."</FONT>"; }
else
if($turn==3){$turn=4;
$hasil .= "<FONT color=\"ffc400\">".$warnahuruf."</FONT>"; }
else
if($turn==4){$turn=5;
$hasil .= "<FONT color=\"adcc00\">".$warnahuruf."</FONT>"; }
else
if($turn==5){$turn=6;
$hasil .= "<FONT color=\"5fcc00\">".$warnahuruf."</FONT>"; }
else
if($turn==6){$turn=7;
$hasil .= "<FONT color=\"11cc00\">".$warnahuruf."</FONT>"; }
else
if($turn==7){$turn=8;
$hasil .= "<FONT color=\"5fcc00\">".$warnahuruf."</FONT>"; }
else
if($turn==8){$turn=9;
$hasil .= "<FONT color=\"adcc00\">".$warnahuruf."</FONT>"; }
else
if($turn==9){$turn=10;
$hasil .= "<FONT color=\"ffc400\">".$warnahuruf."</FONT>"; }
else
if($turn==10){$turn=0;
$hasil .= "<FONT color=\"ff6200\">".$warnahuruf."</FONT>"; } }
$aran=$hasil;
$datakonco=@file("../bukutamu/teman.dat");
$total=count($datakonco);
for($x=0;$x<$total;$x++)
{$konco=explode("|",$datakonco[$x]);
if(trim($nama=="$konco[0]")){ $aran="<a href=\"$konco[1]\"><b>$hasil</b></a>";}}$datakonco=@file("bukutamu/teman.dat");
$total=count($datakonco);
for($x=0;$x<$total;$x++)
{$konco=explode("|",$datakonco[$x]);
if(trim($nama=="$konco[0]")){ $aran="<a href=\"$konco[1]\"><b>$hasil</b></a>";}}?>
