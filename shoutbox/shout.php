<?php
// Main setting
// Password admin:
$CONF['admp'] = '12345';
//nama title: 
$judul=gmdate("H:i:s",time()+3600*7);
$block='band.dat';
// Url shout:
$CONF['url'] = 'http://mymotto.110mb.com';
// Message per page:
$CONF['ns'] = 10;
// Time out:
$CONF['np'] = 8000;
// Verification code when add message, if want to make it, set true.:
$CONF['captcha'] = false;
// Text on header:
$CONF['zag'] = '';
// Script name
if(substr($_SERVER['SCRIPT_NAME'],-7)=='ini.php') exit('upzz.. Hehe..');

// Function micro time page
class perf {
var $start;
function perf(){
list($usec,$sec)=explode(' ',microtime());
$this->start=((float)$usec+(float)$sec);
}
function show(){
list($usec,$sec)=explode(' ',microtime());
return (string)round((float)$usec+(float)$sec-$this->start,5).' second';
}
}

// Start to online detected
class online {
var $count;
var $arr;
var $indata;
var $path='./online.dat'; // place data online
function online(){
$this->indata[0]=strtok($_SERVER['HTTP_USER_AGENT'],' ');
$this->indata[1]=$_SERVER['REMOTE_ADDR'];
$this->indata[2]=time();
$this->arr=file($this->path);
$this->cnt=count($this->arr);
$t=time() - 300; // Reset time online
for($i=0;$i<$this->cnt;$i++){
$a=unserialize($this->arr[$i]);
if($a[2] < $t){
unset($this->arr[$i]);
$this->cnt--;
}
}
}
function add(){
foreach($this->arr as $key=>$val){
$a=unserialize($val);
if($a[0]==$this->indata[0] && $a[1]==$this->indata[1]){
unset($this->arr[$key]);
$this->cnt--;
break;
}
}
$f=fopen($this->path,'w');
fputs($f,serialize($this->indata)."\n".implode('',$this->arr));
fclose($f);
$this->cnt++;
}
}

// Function for SID
function psid(){
return (SID) ? ('?'.SID/shoutbox) : null;
}

// Function
function safe_var($str,$brl=false){
$str=trim(stripslashes(htmlspecialchars($str)));
if($brl) $str=nl2br($str);
$str=strtr($str,array("\r"=>' ',"\n"=>' '));
return $str;
}

// User agent and ip address detected
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $_SERVER['REMOTE_ADDR']=$_SERVER['HTTP_X_FORWARDED_FOR'];

session_start();
?>
