<?php
include_once('config.php');
define('CRLF',"\r\n");
define('VERSION','Uptime Monitor v0.1b');
header('X-Powered-By: ' . VERSION);
header('Server: ' . VERSION);
$conn=new PDO('mysql:dbname='.$db['base'].';host='.$db['server'],$db['user'],$db['pass']) or die('1');
unset($db);
$sanitycheck=array('reddit.com','whitehouse.gov','google.com','microsoft.com','wikipedia.org');
function isup($server,$port) {
	if ($port==80||$port==2222||$port==2083) {
		$up = @file_get_contents('http://' . $server . ':' . $port);
		if (!$up) {
			$up = @file_get_contents('http://' . $server . ':' . $port);
		}
	} else {
		$up =  @fsockopen($server, $port, $errno, $errstr, 2);
		if (!$up) {
			$up =  @fsockopen($server, $port, $errno, $errstr, 2);
		}
	}
	if (!$up) {
		unset($up);
		return false;
	} else {
		unset($up);
		return true;
	}
}
function output_progress_bar($w,$h,$s,$f,$b,$q,$t,$u) {
	if ($u>$t) { $u = $t; } // don't waste memory in overflow scenarios
	$p = $u/$t; 
	$z = $w*$p;
	if ($w>1000||$h>1000) { $w=0;$h=0; } // skiddie prevention
	$canvas = imagecreatetruecolor($w, $h);
	$background = imagecolorallocate($canvas, $b[0], $b[1], $b[2]);
	imagefill($canvas, 0, 0, $background);
	imagerectangle($canvas, 45, 60, 120, 100, $white);
	$i=0;
	while ($i++<$h) {
		$naxt[$i] = imagecolorallocate($canvas, $f[0]-($s*$i), $f[1]-($s*$i), $f[2]-($s*$i));
		imageline($canvas, 0, $i, $z, $i, $naxt[$i]);
	}
	unset($naxt);
	$border = imagecolorallocate($canvas, $q[0], $q[1], $q[2]);
	imagerectangle($canvas, 0, 0, $w-1, $h-1, $border);
	header('Content-Type: image/png');
	$ret = imagepng($canvas);
	imagedestroy($canvas);
	return $ret;
}