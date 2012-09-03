<?php
require('global.php'); 
$queries = file_get_contents('tables.sql') or print('Could not read queries file (tables.sql). ');
$queries = explode(';',$queries,2);
foreach ($queries as $query) {
	$conn->query($query) or print('An error occured while inserting a table. ');
}
echo 'If no errors appeared, you\'re done here. Add your servers, set up your cron, and have fun!';