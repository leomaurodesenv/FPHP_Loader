<?php

// Include ClassLoader
require('/fphp/loader/ClassLoader.php');
use \FPHP_Loader\ClassLoader as ClassLoader;

// Define root `./php/` of classes files 
$root = str_replace('\\', DIRECTORY_SEPARATOR, realpath(dirname(__FILE__))).DIRECTORY_SEPARATOR;

// Register ClassLoader
$loader = new ClassLoader($root);
$loader->add_prefix('Villain', 'example\\');
$loader->add_prefix('FPHP_Loader', 'fphp\\loader\\');
$loader->register();

?>