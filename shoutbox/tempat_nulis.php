<?php //editing scrip dari http://mymotto.110mb.com
require'../system/view/function.php';
require('shout.php');
$perf = new perf;
$c=intval(@$_GET['c']);
if(!isset($_SESSION['sgb_admp']))
ob_start();
$title = "tempat nulis";
include'../system/view/header.php';
echo'<div class="row"><center>Silahkan di corat-coret bro.</center></div>';
print('<div class="row">
<form action="say.php'.psid().'" method="post">
Nama:<br />
<input type="text" name="nick" maxlength="50" size="12" ');
if(isset($_SESSION['sgb_name'])) print('value="'.$_SESSION['sgb_name'].'"');
print(' /><br />
Pesan:<br />
<textarea name="text" rows="3" cols="15">');
if(isset($_GET['n']) && isset($arr[$_GET['n']])){
$_GET['n']=intval($_GET['n']);
$post=unserialize($arr[$_GET['n']]);
print($post['nick'].', ');
}
print('</textarea>');echo'
<input type="hidden" name="url" value="http://" size="12">';
if($CONF['captcha']) print('

<img src="img.php'.psid().'" alt="code" />
<input type="text" name="code" maxlength="10" size="7" />');
$key = rand(00,99);
echo'<br/>* Signup Kode: <font color="red">'.$key.'</font>';
echo'<input type="hidden" name="kode" readonly value="'.$key.'">
<br/><input type="text"     name="hasil" size="8" class="number" maxlength="5">';

print('
<input type="submit" value="Shout!" /><br />
</form>
</div>');
include'../system/view/footer.php';
?>
