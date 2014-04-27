<?php
/*
####
Di edit lagi oleh:mottolover

Home: http://mymotto.110mb.com
##########
*/
include'../system/view/function.php';
require('shout.php');
$title="admin area";
include'../system/view/header.php';


if(isset($_GET['p'])){
if($_GET['p']==$CONF['admp']){
$_SESSION['sgb_admp']=true;
rt('t');
print('<div class="liast-nobullet-top"><center>Login success!<br /><small>Click</small><br />[<a href="indek.php'.psid().'">Here</a>]</center>');
echo'</div>';
rb('b');
}else {rt('t');
print('<div class="list-nobullet-top"><center>Password salah!<br />[<a href="admin.php'.psid().'">Ulangi</a>]</center></div>');

rb('b');

}
}else 
{rt('t');
print('<div class="list-nobullet-top"><center>
<form action="admin.php'.psid().'" method="get">
Enter Password:<br />
<input type="password" name="p" size="12" /><br />
<input type="submit" value="OK" />
</form>
</center>');
echo'</div>';
rb('b');

}
include'../system/view/footer.php';
?>
