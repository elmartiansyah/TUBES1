<?php
require_once('inc/init.php');
require_once('inc/header.php');
	rt('tm');
	echo '<div class="list-head">Smiley</div><div class="content"><table>'.
	'<tr><td>' . smiley(':)') . '</td><td>-&nbsp;<b>:)</b></td></tr>'.
	'<tr><td>' . smiley(':D') . '</td><td>-&nbsp;<b>:D</b></td></tr>'.
	'<tr><td>' . smiley(':P') . '</td><td>-&nbsp;<b>:P</b></td></tr>'.
	'<tr><td>' . smiley('B)') . '</td><td>-&nbsp;<b>B)</b></td></tr>'.
	'<tr><td>' . smiley(';)') . '</td><td>-&nbsp;<b>;)</b></td></tr>'.
	'<tr><td>' . smiley(':$') . '</td><td>-&nbsp;<b>:$</b></td></tr>'.
	'<tr><td>' . smiley(':O') . '</td><td>-&nbsp;<b>:O</b></td></tr>'.
	'<tr><td>' . smiley(':?') . '</td><td>-&nbsp;<b>:?</b></td></tr>'.
	'<tr><td>' . smiley(':(') . '</td><td>-&nbsp;<b>:(</b></td></tr>'.
	'<tr><td>' . smiley(":'(") . '</td><td>-&nbsp;<b>:\'(</b></td></tr>'.
	'<tr><td>' . smiley(':@') . '</td><td>-&nbsp;<b>:@</b></td></tr>'.
	'</table></div>';
	rb('b');
require_once('inc/footer.php');
?>