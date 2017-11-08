<?php
//$command = "youtube-dl --extract-audio --audio-format mp3 --audio-quality 0 {$_POST['url']} > /dev/null 2>&1 &";
$dir = realpath(dirname(__FILE__));
$dir = realpath($dir."/..");
$tmp_dir = "{$dir}/tmp";
$dest_dir = "{$dir}/downloads";
$lock_file = "{$tmp_dir}/lock";

clearstatcache();
if(!is_file($lock_file) && isset($argv[1]))
{
	chdir($tmp_dir);
	// create LOCK file
	file_put_contents($lock_file, '');
	// download to tmp folder
	$command = "youtube-dl --no-mtime --extract-audio --audio-format mp3 --audio-quality 0 {$argv[1]}";
	shell_exec($command);
	// move to destiny dir
	$command = "mv {$tmp_dir}/*.mp3 {$dest_dir}";
	shell_exec($command);
	// remove LOCK file
	unlink($lock_file);
}
