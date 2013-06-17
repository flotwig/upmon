<?php
function special_25565($server,$port){
	$ping=pingMCServer($server,$port);
	if(!$ping) return array('up'=>false);
	return array(
		'up'	=>true,
		'desc'	=>formatMCMessage(htmlentities($ping[2])),
	);
}
// https://gist.github.com/flotwig/5795159
function pingMCServer($server,$port=25565,$timeout=2){
	$socket=socket_create(AF_INET,SOCK_STREAM,getprotobyname('tcp')); // set up socket holder
	$success=socket_connect($socket,$server,$port); // connect to minecraft server on port 25565
	if(!$success) return false;
	socket_send($socket,chr(254).chr(1),2,null); // send 0xFE 01 -- tells the server we want pinglist info
	socket_recv($socket,$buf,3,null); // first 3 bytes indicate the len of the reply. not necessary but i'm not one for hacky socket read loops
	$buf=substr($buf,1,2); // always pads it with 0xFF to indicate an EOF message
	$len=unpack('n',$buf); // gives us 1/2 the length of the reply
	socket_recv($socket,$buf,$len[1]*2,null); // read $len*2 bytes and hang u[
	$data=explode(chr(0).chr(0),$buf); // explode on nul-dubs
	array_shift($data); // remove separator char
	return $data; // boom sucka
}
function formatMCMessage($message){
	$colorMap=array('0'=>'000','1'=>'00a','2'=>'0a0','3'=>'0aa','4'=>'a00','5'=>'a0a','6'=>'fa0',
					'7'=>'aaa','8'=>'555','9'=>'55f','a'=>'5f5','b'=>'5ff','c'=>'f55','d'=>'f5f',
					'e'=>'ff5','f'=>'fff');
	$in=mb_split('\xA7\x00',$message); // fuck unicode
	$out='';
	foreach($in as $chunk){
		if(isset($colorMap[$chunk[0]])){
			$out.='<span style="color:#'.$colorMap[$chunk[0]].';">'.mb_substr($chunk,1).'</span>';
		}else{
			$out.=mb_substr($chunk,1);
		}
	}
	return str_replace(0x00,'',$out);
}