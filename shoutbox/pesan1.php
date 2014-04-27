<?
//editing file by http://seupang.Co.Cc http://penceter.co.cc
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
$pesan = str_replace("abiw","<a href=\"http://penceter.co.cc\"><font color=\"red\">abiw</font></a>", $pesan);
$pesan = str_replace("anjing","*", $pesan);
$pesan = str_replace("bego","*", $pesan);
$pesan = str_replace("babi","*", $pesan);
$pesan = str_replace("kunyuk","*", $pesan);
$pesan = str_replace("ngentot","*", $pesan);
$pesan = str_replace("ngewe","*", $pesan);
$pesan = str_replace("itil","*", $pesan);
$pesan = str_replace("tumbung","*", $pesan);
$pesan = str_replace("bangsat","*", $pesan);
$pesan = str_replace("luh","*", $pesan);
$pesan = str_replace("tai","*", $pesan);
$pesan = str_replace("ketek","*", $pesan);
$pesan = str_replace("@","<font color=\"fuchsia\">@</font>", $pesan);
$pesan = str_replace("~","<font color=\"fuchsia\">~</font>", $pesan);
?>
