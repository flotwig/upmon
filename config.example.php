<?php
$db = array( // configure your database here and install the stuff to it using install.php
	'host' => 'localhost',
	'base' => 'upmon',
	'user' => 'root',
	'pass' => '',
);
$specials = array( // array of port numbers => special processing files for when you wanna check more than just up/down
	// 25565 => 'specials/minecraft.php', MineCraft
);
define('COLLECTED',1); // how often is your cron job set to collect stats, in minutes?
define('BASE','http://upmon.chary.us/');  // base url to the install with ending slash