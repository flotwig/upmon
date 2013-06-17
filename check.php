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
echo 'loading specials...'.CRLF;
foreach($specials as $port=>$special){
	echo 'loading ',$special,' to process port ',$port,'... ';
	(include_once($special)) or print('file does not exist, soldiering on'.CRLF);
}
echo 'loading server list into memory...' . CRLF;
$servers = $conn->query('SELECT * FROM `servers` ORDER BY server,port') or die('unable to load servers...' . CRLF);
echo 'loaded, processing now...' . CRLF;
while ($server = $servers->fetch()) {
	echo $server['server'] . ':' . $server['port'] . ' is here. is it up? ';
	if(function_exists('special_'.$server['port'])){
		echo 'special found, using. ';
		$spData=call_user_func('special_'.$port,$server['server'],$server['port']);
		$query='UPDATE servers SET checks=checks+1, good=good+'.intval($spData['up']).', current='.intval($spData['up']);
		foreach($spData as $spKey=>$spDatum){
			if($spKey!=='up'){ // already processed
				$query.=', `'.$spKey.'`='.$conn->quote($spDatum);
			}
		}
		$query.=' WHERE id="' . $server['id'] . '" LIMIT 1;';
	}else{
		$up = isup($server['server'],$server['port']);
		if (!$up) {
			echo 'no. ';
		} else {
			echo 'yes. ';
		}
		$query = 'UPDATE servers SET checks=checks+1, good=good+' . intval($up) . ', current=' . intval($up) . ' WHERE id="' . $server['id'] . '" LIMIT 1;';
	}
	$result = $conn->query($query) or print_r($conn->errorInfo());;
	echo 'updated.';
	echo CRLF;
}
echo 'looks good from here, man!' . CRLF;