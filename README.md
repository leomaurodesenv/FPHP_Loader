# FPHP_Loader #

Links:      
[PHP Classes](http://www.phpclasses.org/fphp_loader) and [Github](https://github.com/leomaurodesenv/FPHP_Loader/)
   
Class from package FPHP.   

**New**: The autoload was based on [PSR](http://www.phptherightway.com/) standards to import the classes.   
Split the main class `FPHP_Loader` in two: `ClassLoader` and `FileLoader`.   

**Fixed**: Error parser.   
   
___
   
This class loader files from direct paths, or folder path.   
The class supports multiple file name extensions to check and defaults to *.php* .   
The script files can be loaded with either include or require.   
   
___
   
```
/php/
  |__ autoload.php
  |__ /fphp/
  |     |__ /loader/
  |            |__ ClassLoader.php
  |            |__ FileLoader.php
  |            |__ ErrorParserLoader.php
  |__ /example/

/example/
  |__ index.file.loader.php [e.g. FileLoader]
  |__ index.class.loader.php [e.g. ClassLoader]

```
   
* autoload.php: Config and active the class autoload [use ClassLoader];   
* ClassLoader.php: Loader of classes (*php*);   
* FileLoader.php: Loader of files (any type);  
* ErrorParserLoader.php: Error parser of *FileLoader*;  
   
___
   
## Example Autoload   
Require autoload and call the classes   
   
```php
require('./php/autoload.php');
use \Example\SuperHero as IronMan;

IronMan::says();
```
   
## Example FileLoader   
Require autoload and call the classes   
   
```php
require('./php/autoload.php');
use \FPHP_Loader\FileLoader;

$ext = ['html', 'htm'];
$loader = new FileLoader();
$loader->add_extensions($ext);
$loader->load_file('header.php');
$loader->load_dir('content/');
```
   
___
   
   
## Also look ~  	
* [License GPL v2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
* Create by Leonardo Mauro (leo.mauro.desenv@gmail.com)
* Git: [leomaurodesenv](https://github.com/leomaurodesenv/)
* Site: [Portfolio](http://leonardomauro.com/portfolio/)
