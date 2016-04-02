<?php
	require_once 'includes/initialize.php';

	echo get_current_user() , '<br />';
	echo '__FILE__ = ' , __FILE__ , '<br />';
	echo '__DIR__ = ' , __DIR__ , '<br />';
	echo 'dirname() = ', dirname(__FILE__), '<br />';
	echo is_dir('..') ? 'is_dir(..) yes <br />' : 'is_dir(..) no <br />';
	echo 'dirname(..) = ', dirname('..'), '<br />';

	$owner_id = fileowner(__FILE__);
	echo $owner_id , '<br />';

	$owner_array = posix_getpwuid($owner_id);
	echo $owner_array['name'] , '<br />';

	//chown(__FILE__, 'www-data');
	echo decoct(fileperms(__FILE__)), '<br />';
	chmod(__FILE__, 0777);
	echo decoct(fileperms(__FILE__)), '<br />';

	echo is_readable(__FILE__) ? 'yes' : 'no';
	echo '<br />';
	echo is_writable(__FILE__) ? 'yes' : 'no';
	echo '<br />';
	// var_dump(ini_get('safe_mode'));
	// ini_set('safe_mode', 'true');
	// var_dump(ini_get('safe_mode'));
	//********************************************************************************************
	$file_name = 'sample.txt';
	if ($file = fopen($file_name, 'w+')) {
		$size = fwrite($file, "Hello World\nThis is for the first time I am writing something into the file\nMore lines to test\nLet me add a few more lines");
		fwrite($file, "another time you cheek, my fingerprint");
		echo $size, ' bytes written into the file';
		//fclose($file);
	} else {
		echo 'Could not open the file';
	}
	fclose($file);
	// File needs to be closed before deleting
	//unlink($file_name); 			// Deletes the file

	// if ($size = file_put_contents($file_name, "Hello All")) {
	// 	echo $size, ' bytes written into the file';
	// }

	// $pos = ftell($file);
	// echo '<br />', $pos;
	// fseek($file, $pos-14);
	// fwrite($file, "MY FINGERPRINT");

	// rewind($file);
	// fwrite($file, "in the beginning");
	if ($file = fopen($file_name, 'r')) {
		$content = fread($file, filesize($file_name));
	}
	fclose($file);
	echo '<br />', nl2br($content);

	$content = "";
	if ($file = fopen($file_name, 'r')) {
		while (!feof($file)) {
			$content .= "\n1";
			$content .= fgets($file);
		}
	}
	fclose($file);
	echo '<br />', nl2br($content);

	//**************************************FILEINFO******************************************************
	// echo '<br />', 'filesize = ' . filesize($file_name) . '<br />';
	// echo 'filemtime = ' . strftime("%d %m %Y %H:%M:%S", filemtime($file_name)) . '<br />';
	// echo 'filectime = ' . strftime("%d %m %Y %H:%M:%S", filectime($file_name)) . '<br />';
	// echo 'fileatime = ' . strftime("%d %m %Y %H:%M:%S", fileatime($file_name)) . '<br />';

	// touch($file_name);
	// echo '<br />';
	// echo 'filemtime = ' . strftime("%d %m %Y %H:%M:%S", filemtime($file_name)) . '<br />';
	// echo 'filectime = ' . strftime("%d %m %Y %H:%M:%S", filectime($file_name)) . '<br />';
	// echo 'fileatime = ' . strftime("%d %m %Y %H:%M:%S", fileatime($file_name)) . '<br />';

	pp(pathinfo(__FILE__));

	//****************************************DIRECTORY****************************************************
	echo '<hr />';
	echo getcwd(), '<br />';

	if (!file_exists('new')) {
		mkdir('new', 0777);
	}

	if (!file_exists('new/new1/new2/')) {
		mkdir('new/new1/new2', 0777, true);
	}
	chdir('new');
	echo getcwd(), '<br />';

	rmdir('new/new1/new2/');
	chdir('..');
	echo getcwd(), '<br />';
	rmdir('new/new1');
	rmdir('new');
	//****************************************DIRECTORY Content****************************************************
	$dir_name = '.';
	if (is_dir($dir_name)) {
		$dir_handle = opendir($dir_name);
		while ($file_name = readdir($dir_handle)) {
			echo 'filename = ' , $file_name , '<br />';
		}
		closedir($dir_handle);
	}

	$sub_dir_array = scandir($dir_name);
	foreach ($sub_dir_array as $value) {
		echo $value, '<br />';
	}

	if (!file_exists('abc/xyz/test.php')) {
		mkdir('abc/xyz/test.php', 0777, true);
	}


?>