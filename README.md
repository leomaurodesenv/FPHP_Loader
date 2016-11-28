# FPHP_Loader #

Links:      
[API Documentation](http://doc.leonardomauro.com/fphp/) and [PHP Classes](http://www.phpclasses.org/fphp_loader)
   
Class from package FPHP.   
This class loader files from direct paths, or folder path.   
The class supports multiple file name extensions to check and defaults to _.php_ .   
The script files can be loaded with either include or require.   
   
## Example  
Set extension, loading file and folder   
   
```php
require('./class_loader.php');   
$ext = array('php', 'exp');   
$loader = new FPHP_loader($ext);   
$loader->load_file($root.'/1.top.exp');   
$loader->load_dir($root.'/dir_example/');   
```

## Also look ~  	
* [License GPL v2][gpl]
* Create by Leonardo Mauro ([leo.mauro.desenv@gmail.com][email])
* Git: [leomaurodesenv][git]
* Site: [Portfolio][leomauro]
   
[gpl]: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
[email]: leo.mauro.desenv@gmail.com
[git]: https://github.com/leomaurodesenv/
[leomauro]: http://leonardomauro.com/portfolio/