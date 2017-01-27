<?php

/** 
 * This class can load php classes using namespace.
 * 
 * It can load a file with a given namespace (access by `use \namespace\{class}`). <br/>
 * The class supports include multiple prefixes for a namespace. <br>
 * The script files is loaded with require function.
 * 
 * @author Leonardo Mauro <leo.mauro.desenv@gmail.com>
 * @link https://github.com/leomaurodesenv/FPHP_Loader/ GitHub
 * @link http://www.phpclasses.org/fphp_loader PHP Classes
 * @license https://opensource.org/licenses/GPL-2.0 GNU Public License (GPL v2)
 * @copyright 2016 Leonardo Mauro
 * @version 2.0.1 17-01-25
 * @package FPHP_Loader
 * @access public
 */ 

namespace FPHP_Loader;

class ClassLoader {
	
	/** 
	 * Variables description.
	 * @var array $root			Direct path of root.
	 * @var array $extension	Extension of classes.
	 * @var array $prefixes		Prefixes fixes. 
	 */
	private $root;
	private $extension;
	private $prefixes;
	
	/**
	 * Construct of class ClassLoader.
	 * @access public
	 * @param string 		$root 	Set a root path for all loads.
	 * @param array|bool 	$ext 	Set files extension.
	 * @return self
	 */
    public function __construct($root='', $ext=false) {
		if(!is_string($ext)) $ext = 'php';
		$this->root = $root;
		$this->extension = $ext;
		$this->prefixes = [];
	}
	
	/**
     * Register loader with SPL autoloader stack.
	 * @access public
     * @return void
     */
    public function register() {
        spl_autoload_register([$this, 'load']);
    }
	
	/**
	 * Add a new allowed extension. 
	 * @access public
	 * @param array 	$ext 	Set files extension.
	 * @return void
	 */
	public function set_extension($ext) {
		if(!is_string($ext)) return;
		$this->extension = $ext;
	}
	
	/**
	 * Add a new prefix to a namespace.
	 * @access public
	 * @param string 	$namespace 	Namespace.
	 * @param string 	$pref	 	Prefix to namespace.
	 * @return void
	 */
	public function add_prefix($namespace, $pref) {
		$this->prefixes[$namespace] = $pref;
	}
	
	/**
	 * Include a class.
	 * @access public
	 * @param string 	$class 	\namespace\{class}.
	 * @return void
	 */
	public function load($class) {
		$class = ltrim($class, '\\');
		$path  = '';
		$namespace = '';
		if($last_pos = strrpos($class, '\\')){
			$namespace = substr($class, 0, $last_pos);
			$class = substr($class, $last_pos + 1);
			$paths = self::get_paths($namespace);
			self::load_class($paths, $class);
		}
	}
	
	/**
	 * Get paths of a determinate namespace.
	 * @access private
	 * @param string 	$namespace	namespace.
	 * @return array
	 */
	private function get_paths($namespace) {
		$paths = [];
		foreach($this->prefixes as $name => $path){
			if($namespace == $name) $paths[] = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($path));
		}
		$npath = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($namespace)).DIRECTORY_SEPARATOR;
		$paths[] = $npath;
		return $paths;
	}
	
	/**
	 * Load the class.
	 * @access private
	 * @param array 	$paths		Possible Paths of class file.
	 * @param string 	$class		Class name.
	 * @return string
	 */
	private function load_class($paths, $class) {
		foreach($paths as $path){
			$file = $this->root.$path.$class.'.'.$this->extension;
			if(self::require_file($file))
				return $file;
		}
	}
	
	/**
	 * Load the class file.
	 * @access private
	 * @param string 	$file		Class file path.
	 * @return bool
	 */
	private function require_file($file) {
		if(file_exists($file)){ require($file); return true; }
		return false;
	}

}

?>
