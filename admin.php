<?
include('system/view/function.php');
$adminpass = $set[pasword];
if (isset($_GET['pass'])){
$pass = $_GET['pass'];
}else{
$pass = '';
}
$title="Admin panel";
include('inc/header.php');
$a = $_GET['a'];
switch($a){
case "login":
echo '<div class="menu">
<center>';
$m = $_GET['m'];
switch($m){
case "panel":
$auth = $_POST['auth'];
if (empty($auth)){
echo 'Gak Bisa Masuk weeewww.. ? <img src="http://chodot.yn.lt/img/pentung.gif" alt="pentung"/><br/>
&raquo; <a href="admin.php">Kembali</a><br/>';
}
else if ($auth !== $adminpass){
echo 'Password salah !! <img src="http://chodot.yn.lt/img/pentung.gif" alt="pentung"/><br/>
&raquo; <a href="admin.php?a=login">Kembali</a><br/>';
} else {
echo 'Login sukses !! <img src="http://chodot.yn.lt/img/sip.gif" alt="sip"/><br/>
&raquo; <a href="admin.php?pass='.$adminpass.'">Ke depan</a><br/>';
}
break;
default:
echo '<form action="admin.php?a=login&amp;m=panel" method="post">
Masukkan Password :<br/>
<input type="password" name="auth" value=""><br/>
<input type="submit" value="Login">
</div></form>';
break;
}
echo '</center>
</div>';
break;
//Edit data
case "edit":
echo '<div class="error">';
if ($pass !== $adminpass){
echo 'Khusus admin';
} else {
$file = 'system/view/function.php';
$e = $_GET['e'];
switch($e){
case "simpan":
$buka = fopen($file, 'w');
$konten='<?
$set[pasword]='.'"'."$_REQUEST[satu]".'";
$set[buku]='.'"'."$_REQUEST[dua]".'";
$set[shout]='.'"'."$_REQUEST[tiga]".'";
$set[css]='.'"'."$_REQUEST[empat]".'";
$set[waktu]='.'"'."$_REQUEST[lima]".'";
$set[visitor]='.'"'."$_REQUEST[enam]".'";
$set[judul]='.'"'."$_REQUEST[tujuh]".'";
$set[footer]='.'"'."$_REQUEST[delapan]".'";
$set[description]='.'"'."$_REQUEST[sembilan]".'";
$set[rss]='.'"'."$_REQUEST[sepuluh]".'";
?>';
fwrite($buka, $konten);
fclose($buka);
echo 'Data situs telah di edit !!.<img src="http://chodot.yn.lt/img/sip.gif" alt="sip"/><br/>
Jangan lupa dgn data yg baru.<br/>
&raquo; <a href="admin.php?pass='.$set[pasword].'">Kembali</a><br/>';
break;
default:
echo '<form action="admin.php?a=edit&amp;e=simpan&amp;pass='.$pass.'" method="post"><font color="red"><b>CATATAN</b></font> Hati hati dalam menambahkan code html atau simbol,bisa menyebabkan wap menjadi blank,kalau itu terjadi kembalikan data ke awal dengan cara mengedit file system/view/function.php, via ftp <br/>
1). Admin pasword :<br/>
<input type="text" name="satu" size="12" value="'.$set[pasword].'"><br/>
2). Batas pesan di bukutamu :<br/>
<input type="text" name="dua" size="12" value="'.$set[buku].'"><br/>
3). Batas pesan di shoutbox :<br/>
<input type="text" name="tiga" size="12" value="'.$set[shout].'"><br/>
4). Style css :<br/>
<input type="text" name="empat" size="12" value="'.$set[css].'"><br/>
5). Zona waktu :<br/>
<input type="text" name="lima" size="12" value="'.$set[waktu].'"><br/>
6). Sapaan buat pengunjung :<br/>
<input type="text" name="enam" size="12" value="'.$set[visitor].'"><br/>
7). Judul wapsite / title :<br/>
<input type="text" name="tujuh" size="12" value="'.$set[judul].'"><br/>
8). Footer / copyright :<br/>
<input type="text" name="delapan" size="12" value="'.$set[footer].'"><br/>
9). Description / keterangan :<br/>
<input type="text" name="sembilan" size="12" value="'.$set[description].'"><br/>
10). Rss feed :<br/>
<input type="text" name="sepuluh" size="12" value="'.$set[rss].'"><br/>
<input type="submit" value="Simpan"><br/>
</form>';
break;
} }
echo '</div>';
break;
//Edit profile
case "profile":
echo '<div class="menu">';
if ($pass !== $adminpass){
echo 'Khusus admin';
} else {
$file = 'system/view/function_profile.php';
$e = $_GET['e'];
switch($e){
case "simpan":
$buka = fopen($file, 'w');
$konten='<?
$set[foto]='.'"'."$_REQUEST[satu]".'";
$set[nama]='.'"'."$_REQUEST[dua]".'";
$set[nick]='.'"'."$_REQUEST[tiga]".'";
$set[alamat]='.'"'."$_REQUEST[empat]".'";
$set[fb]='.'"'."$_REQUEST[lima]".'";
$set[twitter]='.'"'."$_REQUEST[enam]".'";
$set[tulisan]='.'"'."$_REQUEST[tujuh]".'";
$set[moto]='.'"'."$_REQUEST[delapan]".'";
$set[kerjaan]='.'"'."$_REQUEST[sembilan]".'";
$set[email]='.'"'."$_REQUEST[sepuluh]".'";
$set[telpon]='.'"'."$_REQUEST[sebelas]".'";
?>';
fwrite($buka, $konten);
fclose($buka);
echo 'Data profile telah di edit !!.<img src="http://chodot.yn.lt/img/sip.gif" alt="sip"/><br/>
Jangan lupa dgn data yg baru.<br/>
&raquo; <a href="admin.php?pass='.$set[pasword].'">Kembali</a><br/>';
break;
default:
require ('system/view/function_profile.php');
echo '<form action="admin.php?a=profile&amp;e=simpan&amp;pass='.$pass.'" method="post"><font color="red"><b>CATATAN</b></font> Kalau ngeblank itu terjadi kembalikan data ke awal dengan cara mengedit file system/view/function_profile.php, via ftp <br/>
1). Foto profile :<br/>
<input type="text" name="satu" size="12" value="'.$set[foto].'"><br/>
2). Nama asli :<br/>
<input type="text" name="dua" size="12" value="'.$set[nama].'"><br/>
3). Nama panggilan :<br/>
<input type="text" name="tiga" size="12" value="'.$set[nick].'"><br/>
4). Alamat rumah :<br/>
<input type="text" name="empat" size="12" value="'.$set[alamat].'"><br/>
5). Alamat facebook :<br/>
<input type="text" name="lima" size="12" value="'.$set[fb].'"><br/>
6). Alamat twitter :<br/>
<input type="text" name="enam" size="12" value="'.$set[twitter].'"><br/>
7). Catatan kamu :<br/>
<input type="text" name="tujuh" size="12" value="'.$set[tulisan].'"><br/>
8). Moto hidup :<br/>
<input type="text" name="delapan" size="12" value="'.$set[moto].'">
<br/>
9). Propesi :<br/>
<input type="text" name="sembilan" size="12" value="'.$set[kerjaan].'">
<br/>
10). Email :<br/>
<input type="text" name="sepuluh" size="12" value="'.$set[email].'"><br/>
11). Telpon :<br/>
<input type="text" name="sebelas" size="12" value="'.$set[telpon].'"><br/>
<input type="submit" value="Simpan"><br/>
</form>';
break;
} }
echo '</div>';
break;
default:
echo '<div class="main">';
if ($pass == $adminpass) {
echo '&raquo; <a href="/teman/teman.php?pass='.$pass.'">Tambah teman di index</a><br/>
&raquo; <a href="/teman/teman.php?a=list&amp;pass='.$pass.'">List teman di index</a><br/>
&raquo; <a href="/bukutamu/teman.php?a=list&amp;pass='.$pass.'">List teman di bukutamu</a><br/>
&raquo; <a href="/bukutamu/teman.php?pass='.$pass.'">Tambah teman di bukutamu</a><br/>
&raquo; <a href="admin.php?a=edit&amp;pass='.$pass.'">Edit data situs</a><br/>
&raquo; <a href="/user/panel/">Edit data profile</a><br/>
&raquo; <a href="/news">Panel Status</a><br/>
&raquo; <a href="/shoutbox/admin.php?p='.$pass.'">Panel Shoutbox</a><br>
&raquo; <a href="admin.php?">Keluar</a><br>';
}else{
echo '<div class="menu">silahkan klik <a href="admin.php?a=login">Login</a> untuk mengakses penuh halaman ini';
}
echo '</div>';
break;
//Penutup
}
include('inc/footer.php');
?>
                                                               
     
         
