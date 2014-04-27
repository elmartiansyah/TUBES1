<?php
require ('../inc/init.php');
if (!$isadmin) {
	header('location:' . get_setting('blogurl') . '/admin-panel/index.php');
	exit;
}
require ('../inc/header.php');
$filter = array (
	'/^[^a-zA-Z0-9]+/',
	'/[^a-zA-Z0-9]+$/',
	'/(\.\.\/)+/',
	'/\/+$/'
);
$getdir = isset ($_GET['dir']) ? $_GET['dir'] : '';
$getdir = urldecode($getdir);
$getdir = preg_replace($filter, '', $getdir);
$file = isset ($_GET['file']) ? $_GET['file'] : '';
$file = urldecode($file);
$file = preg_replace($filter, '', $file);

$arr = explode('/', $getdir);
$cdir = count($arr);
$curdir = $arr[$cdir -1];
$arr[$cdir -1] = null;
$backdir = implode('/', $arr);
$backdir = preg_replace('/[^a-zA-Z0-9]+$/', '', $backdir);
$action = isset ($_GET['action']) ? $_GET['action'] : '';

$dirname = isset ($_POST['dirname']) ? $_POST['dirname'] : '';
$dirname = trim(preg_replace('/([^A-Za-z0-9_]+)/', ' ', $dirname));
$dirname = mb_strtolower(str_replace(' ', '-', $dirname));
if (is_dir('../uploads/' . $getdir)) {
	switch ($action) {
		case 'upload' :
			if (isset ($_POST['submit'])) {
				$name = basename($_FILES['upfile']['name']);
				$name = trim(preg_replace('/([^A-Za-z0-9_\.]+)/', ' ', $name));
				$name = mb_strtolower(str_replace(' ', '-', $name));
				$err = '';
				if ($name == '.htaccess' || $name == 'php.ini')
					$err = 'You may NOT upload .htaccess and php.ini files';
				if ($_FILES['upfile']['error'])
					$err = 'File not uploaded';
				if (!$name)
					$err = 'File name is invalid';
				if (file_exists('../uploads/' . $getdir . '/' . $name))
					$err = 'File "' . $name . '" is already available!';
				if (!$err) {
					if (move_uploaded_file($_FILES['upfile']['tmp_name'], '../uploads/' . $getdir . '/' . $name)){
						chmod('../uploads/' . $getdir . '/' . $name, 0777);
						show_notif('File "' . $name . '" successfully uploaded');
					}else{
						show_warning('File failed to upload');
					}
				} else {
					show_warning($err);
				}
			}
			break;
		case 'rmdir' :
			if (isset ($_POST['submit']) && $getdir) {
				if (rmdir('../uploads/' . $getdir)) {
					$getdir = $backdir;
					show_notif('Folder "' . $curdir . '" successfully removed');
				} else {
					show_warning('Folder can not be removed, make sure it\'s already empty.');
				}

			} else {
				rt('t');
				echo '<div class="content"><center> Delete folder "' . $curdir . '" ?<br/><br/><form action="?dir=' . urlencode($getdir) . '&action=rmdir" method="POST">' .
				'<input type="submit" value=" Yes " name="submit" /> <a href="?dir=' . $getdir . '">No</a></form></center></div>';
				rb('b');
				require ('../inc/footer.php');
				exit;
			}
			break;
		case 'mkdir' :
			if (isset ($_POST['submit']) && $dirname) {
				if (file_exists('../uploads/' . $getdir . '/' . $dirname)) {
					show_warning('Folder "' . $dirname . '" sudah ada');
				} else {
					if (mkdir('../uploads/' . $getdir . '/' . $dirname)){
						chmod('../uploads/' . $getdir . '/' . $dirname, 0777);
						show_notif('Folder "' . $dirname . '" berhasil dibuat');
					}else{
						show_warning('Failed to make folder');
					}
				}
			} else {
				rt('tm');
				echo '<div class="list-head">Create new folder</div>';
				echo '<div class="list-nobullet"><form action="?dir=' . urlencode($getdir) . '&action=mkdir" method="POST">' .
				'<table style="width:100%;">' .
				'<tr><td><input name="dirname" type="text" style="width:100%;"/></td>' .
				'<td style="width:30px;"><input type="submit" value="Create" name="submit" /></td></tr></table></form></div>';
				rb('b');
				rt('t');
				echo '<div class="list-top"><a href="?' . ($getdir ? 'dir=' . urlencode($getdir) : '') . '">Back</a></div>';
				rb('b');
				require ('../inc/footer.php');
				exit;
			}
			break;
		case 'rendir' :
			if (isset ($_POST['submit']) && $dirname) {
				if (rename('../uploads/' . $getdir, '../uploads/' . $backdir . '/' . $dirname)) {
					$getdir = $backdir . '/' . $dirname;
					show_notif('Folder successfully renamed to "' . $dirname . '"');
				}
			} else {
				rt('tm');
				echo '<div class="list-head">Rename folder</div>';
				echo '<div class="list-nobullet"><form action="?dir=' . urlencode($getdir) . '&action=rendir" method="POST">' .
				'<table style="width:100%;">' .
				'<tr><td><input name="dirname" type="text" style="width:100%;" value="' . $curdir . '"/></td>' .
				'<td style="width:30px;"><input type="submit" value="Change" name="submit" /></td></tr></table></form></div>';
				rb('b');
				rt('t');
				echo '<div class="list-top"><a href="?' . ($getdir ? 'dir=' . urlencode($getdir) : '') . '">Back</a></div>';
				rb('b');
				require ('../inc/footer.php');
				exit;
			}
			break;
		case 'detail' :
			if (is_file('../uploads/' . $getdir . '/' . $file)) {
				rt('t');
				echo '<div class="content">NFile name: <b>' . $file . '</b><hr/>' .
				'Size: <b>' . round(filesize('../uploads/' . $getdir . '/' . $file) / 1024, 3) . ' kb</b><hr/>';
				echo 'File address:<br/><input type="text" value="' . get_setting('blogurl') . '/uploads/' . ($getdir ? $getdir . '/' : '') . $file . '"><hr/>' .
				'<a href="' . get_setting('blogurl') . '/uploads/' . ($getdir ? $getdir . '/' : '') . $file . '"><b>Download</b></a><hr/>' .
						'<img src="' . get_setting('blogurl') . '/images/back.png" /> <a href="?dir=' . urlencode($getdir) . '">Back</a></div>';
				rb('b');
				rt('t');
				echo '<div class="list-top"><a href="?action=delfile&dir=' . urlencode(($getdir ? $getdir : '')) . '&file=' . urlencode($file) . '">Delete file</a></div>';
				echo '<div class="list"><a href="?action=renfile&dir=' . urlencode(($getdir ? $getdir : '')) . '&file=' . urlencode($file) . '">Rename</a></div>';
				rb('b');
				require ('../inc/footer.php');
				exit;
			} else {
				show_warning('File "' . $file . '" not found');
			}

			break;
		case 'delfile' :
			if (is_file('../uploads/' . $getdir . '/' . $file)) {
				if (isset ($_POST['submit'])) {

					if (unlink('../uploads/' . $getdir . '/' . $file)) {
						show_notif('File "' . $file . '" successfully removed');
					} else {
						show_warning('File "' . $file . '" can not be removed.');
					}

				} else {
					rt('t');
					echo '<div class="content"><center> Delete file "' . $file . '" ?<br/><br/><form action="?action=delfile&dir=' . urlencode($getdir) . '&file=' . urlencode($file) . '" method="POST">' .
					'<input type="submit" value=" Yes " name="submit" /> <a href="?action=detail&dir=' . $getdir . '&file=' . $file . '">No</a></form></center></div>';
					rb('b');
					require ('../inc/footer.php');
					exit;
				}
			} else {
				show_warning('File "' . $file . '" not available.');
			}
			break;
		case 'renfile' :
			if (is_file('../uploads/' . $getdir . '/' . $file)) {
				$filename = isset ($_POST['filename']) ? $_POST['filename'] : '';
				$filename = trim(preg_replace('/([^A-Za-z0-9_\.]+)/', ' ', $filename));
				$filename = mb_strtolower(str_replace(' ', '-', $filename));
				if (isset ($_POST['submit']) && $filename) {
					if (rename('../uploads/' . $getdir . '/' . $file, '../uploads/' . $getdir . '/' . $filename)) {
						show_notif('File successfully renamed to "' . $filename . '"');
					}
				} else {
					rt('tm');
					echo '<div class="list-head">Rename file</div>';
					echo '<div class="list-nobullet"><form action="?action=renfile&dir=' . urlencode($getdir) . '&file=' . $file . '" method="POST">' .
					'<table style="width:100%;">' .
					'<tr><td><input name="filename" type="text" style="width:100%;" value="' . $file . '"/></td>' .
					'<td style="width:30px;"><input type="submit" value="Change" name="submit" /></td></tr></table></form></div>';
					rb('b');
					rt('t');
					echo '<div class="list-top"><a href="?' . ($getdir ? 'dir=' . urlencode($getdir) : '') . '">Back</a></div>';
					rb('b');
					require ('../inc/footer.php');
					exit;
				}
			}
			break;
	}
} else {
	show_warning('Directory not found');
	$getdir = '';
}
rt('tm');
echo '<div class="list-head">File Manager</div>';

$dir = opendir('../uploads/' . $getdir);
if ($getdir)
	echo '<div class="list-nobullet"><img src="' . get_setting('blogurl') . '/images/back.png" /> <a href="?dir=' . urlencode($backdir ? $backdir : '') . '">Back</a></div>';
while ($each = readdir($dir)) {
	if (is_dir('../uploads/' . $getdir . '/' . $each)) {
		if ($each != '.' && $each != '..')
			echo '<div class="list-nobullet"><img src="' . get_setting('blogurl') . '/images/folder.png" /> <a href="?dir=' . urlencode(($getdir ? $getdir . '/' : '') . $each) . '">' . $each . '</a></div>';
	}
}
closedir($dir);
$dir = opendir('../uploads/' . $getdir);
while ($each = readdir($dir)) {
	if (!is_dir('../uploads/' . $getdir . '/' . $each))
		if ($each != '.htaccess')
			echo '<div class="list"><a href="?action=detail&dir=' . urlencode(($getdir ? $getdir : '')) . '&file=' . urlencode($each) . '">' . $each . '</a></div>';
}
closedir($dir);
rb('b');

rt('t');
echo '<div class="content"><form enctype="multipart/form-data" action="?dir=' . urlencode($getdir) . '&action=upload" method="POST">' .
'<table style="width:100%;">' .
'<tr><td><input name="upfile" type="file" style="width:100%;"/></td>' .
'<td style="width:30px;"><input type="submit" value="Upload" name="submit" /></td></tr></table></form></div>';
rb('b');

rt('t');
echo '<div class="list-top"><a href="?' . ($getdir ? 'dir=' . urlencode($getdir) . '&' : '') . 'action=mkdir">Create folder</a></div>';
if ($getdir) {
	echo '<div class="list"><a href="?' . ($getdir ? 'dir=' . urlencode($getdir) . '&' : '') . 'action=rmdir">Delete folder</a></div>';
	echo '<div class="list"><a href="?' . ($getdir ? 'dir=' . urlencode($getdir) . '&' : '') . 'action=rendir">Rename folder</a></div>';
}
rb('b');
require ('../inc/footer.php');
?>
