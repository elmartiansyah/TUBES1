<?
//editing file by http://seupang.Co.Cc http://penceter.co.cc
rt('tm');
echo '<div class="list-nobullet-head"><img src="' . get_setting('blogurl') . '/images/chat.png"/> Shoutbox</div>';
print('<div class="list-nobullet"><form action="/shoutbox/say.php".psid()."" method="post">
<input name="nick" type="text"style="width:42%" ');
if(isset($_SESSION['sgb_name'])) print('value="'.$_SESSION['sgb_name'].'"');
else print('value="nama"onfocus="if(this.value=nama) this,value"" ');
print(' /> <input name="url" type="text" style="width:43%" ');
if(isset($_SESSION['sgb_url'])) print('value="'.$_SESSION['sgb_url'].'"');
else print('value="http://" ');
print(' /><br/><input name="text" value="pesan kamu"onfocus="if(this.value=pesan kamu) this,value"" style="width:45%" />');
if(isset($_GET['n']) && isset($arr[$_GET['n']])){
$_GET['n']=intval($_GET['n']);
$post=unserialize($arr[$_GET['n']]);
print($post['nick'].', ');
}
$angka = str_shuffle('abcdefghijklmnopqrstuvwxyz123456789');
$key=substr($angka,0,5);
echo'<input type="hidden" name="kode" readonly value="'.$key.'">
<input type="hidden" name="hasil" size="3" class="number" maxlength="5" value="'.$key.'">';
include'ikon.php';
print('</div> <div class="list-nobullet"> <input type="submit" value="Kirim!" /></form> <a href="/smile.php"><font color="red"><b>SMILE</a></b></font> &bull; <a href="/bb-code.php"><font color="red"><b>CODE</a></b></font> &bull; <a href="/shoutbox/admin.php"><font color="red"><b><img src="/images/panel.png" alt="panel"/></a></b></font></div>');
rb('b');
?>
