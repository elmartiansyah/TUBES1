<?php
if(isset($_GET['img'])){
Header('Content-Type: image/gif');
echo(base64_decode(
'R0lGODlhMgAyAJEAAAAAAP8AAP///
wAAACH/C05FVFNDQVBFMi4wAwEAAAA
h+QQFDwADACwAAAAAMgAyAAACM4SPq
cvtD6OctNqLs968+w+G4kiW5omm6sq
27gvH8kzX9o3n+s73/g8MCofEovGIT
ConBQAh+QQFDwADACwAAAAAMgAyAAA
CM5SPqcvtD6OctNqLs968+w+G4kiW5
omm6sq27gvH8kzX9o3n+s73/g8MCof
EovGITConBQAh+QQFDwADACwAAAAAM
gAyAAACM4yPqcvtD6OctNqLs968+w+
G4kiW5omm6sq27gvH8kzX9o3n+s73/
g8MCofEovGITConBQA7'));
}
Header('Content-Type: application/xhtml+xml;charset=utf-8');
Header('Cache-Control: no-cache, must-revalidate');
print('<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
<title>Banned</title>
<style type="text/css">
body{background: url(banned.php?img) #000; color: #0f0;}
</style>
</head>
<body>
<div><h2>Maaf, anda telah di banned</h2></div>
</body>
</html>');
?>