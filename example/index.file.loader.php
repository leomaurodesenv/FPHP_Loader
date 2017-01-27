<?php

/* Add the autoload */
require('../dist/php/autoload.php');

/* Call the class `FileLoader` */
use \FPHP_Loader\FileLoader;

/** 
* Example: Set extension, loading file and 'path'
*/
$ext = ['html', 'htm'];
$f_loader = new FileLoader();
$f_loader->add_extensions($ext);
$f_loader->load_file('dir_example/wrong_extension.txt');
$f_loader->load_file('1.top.php');
$f_loader->load_dir('dir_example/'); /* Don't include files with wrong extensions */

?>