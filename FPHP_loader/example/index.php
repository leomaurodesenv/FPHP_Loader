<?php

/* Set header to example */
header('Content-Type: text/plain');
/* Include class FPHP_loader from the file */
require('../dist/class_loader.php');


/** 
* Example: Set extension, loading file and 'path'
*/

$ext = array('php', 'exp');
$root = realpath(__DIR__);

$loader = new FPHP_loader($ext);
$loader->load_file($root.'/1.top.php2');
/* $loader->load_file($root.'/1.top.php'); <- Correct*/
$loader->load_dir($root.'/dir_example/');

?>