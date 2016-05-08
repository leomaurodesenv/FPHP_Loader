# FPHP_loader #

Class from package FPHP.  
This class loader files from direct paths, or directory path.  

## Example 
Set extension, loading file and folder  

` require('./class_loader.php');`  
` $ext = array('php', 'exp');`  
` $loader = new FPHP_loader($ext);`  
` $loader->load_file($root.'/1.top.exp');`  
` $loader->load_dir($root.'/dir_example/');`  
