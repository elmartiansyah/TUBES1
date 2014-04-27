<?php //editing script oleh http://mymotto.110mb.com
include'../system/view/function.php';
require('shout.php');
$title="edit pesan";
include'../system/view/header.php';
$n=intval(@$_GET['n']);
if(!isset($_SESSION['sgb_admp'])) die('Login dulu, atau sessi telah expired.<hr /></div>');
require('./smiles.php');
$arr=file('./motto.dat');
$post=unserialize($arr[$n]);
if(isset($_POST['nick']) && isset($_POST['text'])){
$nick=safe_var($_POST['nick']);
$text=safe_var($_POST['text'],true);
if(empty($nick) || empty($text)) die('Wew, <i>Nama atau pesan kok kosong?</i></div>');
if(isset($_POST['answ'])){
if(!empty($_POST['answ'])) $post['answ']=safe_var($_POST['answ']);
elseif(isset($post['answ'])) unset($post['answ']);
}
$text=str_replace($sstr,$simg,$text);
$pesan = preg_replace("#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#is", "\\1<a href=\"\\2\">\\2</a>", $pesan); $pesan = preg_replace("#(^|[\n ])((www|wap)\.[^ \"\t\n\r<]*)#is", "\\1<a href=\"http://\\2\">\\2</a>", $pesan);
$pesan=preg_replace("#\[b\](.*?)\[/b\]#","<b>\\1</b>",$pesan);
$pesan=preg_replace("#\[marq\](.*?)\[/marq\]#","<marquee>\\1</marquee>",$pesan);
$pesan=preg_replace("#\[marq\](.*?)\[/marq\]#","<marquee>\\1</marquee>",$pesan);
$pesan=preg_replace("#\[big\](.*?)\[/big\]#","<span style='font-size:large;'>\\1</span>",$pesan);
$pesan=preg_replace("#\[das\](.*?)\[/das\]#","<span style='border:1px dashed;'>\\1</span>",$pesan);
$pesan=preg_replace("#\[in\](.*?)\[/in\]#","<input type='text' value='\\1'/>",$pesan);
$pesan=preg_replace("#\[kode\](.*?)\[/kode\]#",htmlentities("\\1"),$pesan);
$pesan=preg_replace("#\[u\](.*?)\[/u\]#", "<u>\\1</u>", $pesan);
$pesan=preg_replace("#\[i\](.*?)\[/i\]#", "<i>\\1</i>",$pesan);
$pesan=preg_replace("#\[blink\](.*?)\[/blink\]#","<blink>\\1</blink>",$pesan);
$pesan=str_replace("[br/]","<br/>", $pesan);
$pesan=preg_replace("#\[color=(.*?)\](.*?)\[/color\]#","<font color=\\1>\\2</font>",$pesan);
$pesan=preg_replace("#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#","\\1<a href=\"\\2\">\\2</a>", $pesan);
$pesan=preg_replace("#\[url=(.*?)\](.*?)\[/url\]#","<a href=\"\\1\">\\2</a>", $pesan);
$post['nick']=$nick;
$post['text']=$text;
$arr[$n]=serialize($post)."\n";
$f=fopen('./motto.dat','w');
fputs($f,implode('',$arr));
fclose($f);
rt('t');
echo('<div class="list-nobullet-top">Pesan telah terkirim...!!<hr />');
}else{
require('./smiles.php');
$post['text']=str_replace($simg,$sstr,$post['text']);
if(!isset($post['answ'])) $post['answ']=null;
rt('t');
echo('<form action="edit.php?n='.$n.'&amp;'.SID.'" method="post"><div>
<div class="list-nobullet-top">* Nama utk di edit:<br/>
<input type="text" name="nick" value="'.$post['nick'].'" maxlength="20" size="8" /><br />
<div class="list1">* Pesan utk di edit:</div>
<textarea name="text" rows="3" cols="20">'.strip_tags($post['text']).'</textarea><br />
Admin posting:<br />
<input type="text" name="answ" value="'.$post['answ'].'" /><br />
<input type="submit" value="Send!"/>
</div></form>');
}
print('<div class="row">&raquo; [<a href="indek.php'.psid().'"> Shout </a>]</div></div>');
rb('b');
include'../system/view/footer.php';
?>
