<?php
$db = array( // configure your database here and install the stuff to it using install.php
	'host' => 'localhost',
	'base' => 'upmon',
	'user' => 'root',
	'pass' => '',
);
define('COLLECTED',1); // how often is your cron job set to collect stats, in minutes?
define('BASE','http://upmon.chary.us/');  // base url to the install with ending slash