<?
//editing file by http://seupang.Co.Cc http://penceter.co.cc
ini_set("display_errors",0);

include('inc/init.php');
include('inc/functions.php');
$title=" Bb code";
include'inc/header.php';
//include 'shout/shoutbox.php';
rt('t');
echo "<div class='list-nobullet-top'>";echo "<div class='top'>gaya tulisan</div>
<div class='menu'><input type='text' value='[b]Teks anda[/b]'/><br/><strong>Huruf tebal</strong><br />
<input type='text'
value='[youtube]in code[/youtube]' /><span style='border:1px dashed;'>muncul youtube</span><br/>
<input type='text' value='[i]Teks anda[/i]' /><br/><em>Huruf miring</em><br />
<input type='text'
value='[das]Teks anda[/das]' /><br/><span style='border:1px dashed;'>muncul kotak</span><br />
<input type='text' value='[marq]Teks anda[/marq]' /><br/><marquee>teks bergerak</marquee>
<input type='text' value='[in]Teks anda[/in]' /><br/>Input teks<br/>
<input type='text' value='[big]Teks anda[/big]' /><br/><big>teks besar</big><br/>
<input type='text' value='[blink]Teks anda[/blink]' /><br/><blink>teks berkedip</blink><br />
<input type='text' value='[url=http://url anda]nama url[/url]' /><br/><b>url situs</b><br /><input type='text' value='[color=red]Teks anda[/color]' /><br/>red bisa diganti dengan warna lain,dalam bahasa inggris<br/>
<input type='text' value='[u]Teks anda[/u]' /><br/><u>teks bergaris bawah</u></div>";
echo'</div>';
rb('b');
include 'inc/footer.php';
?>
