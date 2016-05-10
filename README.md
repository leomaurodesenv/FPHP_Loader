# FPHP_loader #
   
Class from package FPHP.   
This class loader files from direct paths, or folder path.   
The class supports multiple file name extensions to check and defaults to _.php_ .   
The script files can be loaded with either include or require.   
   
## Example  
Set extension, loading file and folder   
   
```
require('./class_loader.php');   
$ext = array('php', 'exp');   
$loader = new FPHP_loader($ext);   
$loader->load_file($root.'/1.top.exp');   
$loader->load_dir($root.'/dir_example/');   
```
