<?php
require_once('global.php');
output_progress_bar(
	300,                  // width
	15,                   // height 
	2,                    // shift for RGB
	array(30,75,120),     // beginning foreground color
	array(244,244,244),   // background color
	array(200,200,200),   // border color
	intval($_GET['t']),   // total size of bar
	intval($_GET['u'])    // filled size of bar
);
?>