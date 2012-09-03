<?php
require('global.php');
echo 'starting sanity checks...' . CRLF;
if (php_sapi_name()!='cli') {
	echo 'not running in correct environment, shutting down...' . CRLF;
	die();
}
$count = 0;
foreach ($sanitycheck as $check) {
	if (!isup($check,80)) {
		$count++;
		echo $check . 'inaccessible...' . CRLF;
	}
}
if ($count>1) {
	die('sanity check failed. may not have internet access...' . CRLF);
}
echo 'loading server list into memory...' . CRLF;
$servers = $conn->query('SELECT * FROM `servers` ORDER BY server,port') or die('unable to load servers...' . CRLF);
echo 'loaded, processing now...' . CRLF;
while ($server = $servers->fetch_assoc()) {
	echo $server['server'] . ':' . $server['port'] . ' is here. is it up? ';
	$up = isup($server['server'],$server['port']);
	if (!$up) {
		echo 'no. ';
	} else {
		echo 'yes. ';
	}
	$r = mt_rand(100,999);
	$query = 'UPDATE servers SET checks=checks+1, good=good+' . intval($up) . ', current=' . intval($up) . ' WHERE id="' . $server['id'] . '" LIMIT 1;';
	$result = $conn->query($query) or die('3');
	//echo $query;
	echo 'updated.';
	echo CRLF;
}
echo 'looks good from here, man!' . CRLF;