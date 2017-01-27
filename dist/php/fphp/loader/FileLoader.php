<?php

/** 
 * This class can load one or more files from a directory.
 * 
 * It can take a given directory and loads all scripts in that directory that have a given file name extension. <br>
 * The class supports multiple file name extensions to check and defaults to `php`. <br>
 * The script files can be loaded with either include(_once) or require(_once).
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
use \FPHP_Loader\ErrorParserLoader as Error;

class FileLoader {
	
	/** 
	 * Variables description.
	 * @var array $extensions	Extensions allowed.
	 * @var bool $require		Define require|include function.
	 * @var bool $once			Define $require(_once).
	 */
	private $extensions;
	private $requiref;
	private $once;
	
	/**
	 * Construct of class FileLoader.
	 * @access public
	 * @param bool	$req	Set require|include.
	 * @param bool	$onc	Set require|include(once).
	 * @return self
	 */
    public function __construct($req=true, $onc=false) {
		$this->extensions = ['php'];
		$this->requiref = (bool) $req;
		$this->once = (bool) $onc;	
	}
	
	/**
	 * Add extension.
	 * @access public
	 * @param string 	$ext 	Set a new extension allowed.
	 * @return void
	 */
	public function add_extension($ext) {
		if(is_string($ext)) $this->extensions[] = $ext;
		else Error::dump($this, Error::E_VAR_TYPE, 'add_extension: is not string');
	}
	
	/**
	 * Add mutiples extensions.
	 * @access public
	 * @param string 	$exts 	Set new extensions allowed.
	 * @return void
	 */
	public function add_extensions($exts) {
		if(is_array($exts))
			foreach($exts as $ext) self::add_extension($ext);
		else Error::dump($this, Error::E_VAR_TYPE, 'add_extensions: is not array');
	}
	
	/**
	 * Include files from the path (folder).
	 * @access public
	 * @param string	$dir	Folder path.
	 * @return void
	 */
	public function load_dir($dir) {
		if(is_dir($dir)){
			$files = scandir($dir);
			foreach($files as $file) self::check_dir($dir.$file);
		}
		else Error::dump($this, Error::E_DIRECTORY, $dir);
	}

	/**
	 * Check files of directory to load.
	 * @access private
	 * @param string	$path	File path.
	 * @return void
	 */
	private function check_dir($path) {
		$file = pathinfo($path);
		if(self::check_extension($file['extension'])) self::include_file($path);
	}
	
	/**
	 * Include one file from the path.
	 * @access public
	 * @param string	$path	File path.
	 * @return void
	 */
	public function load_file($path) {
		$file = pathinfo($path);
		if(file_exists($path)){
			if(self::check_extension($file['extension'])) self::include_file($path);
			else Error::dump($this, Error::E_EXTENSION, $path);
		}
		else Error::dump($this, Error::E_FILE_NOT_EXIST, $path);
	}
	
	/**
	 * Load file from the path ($path).
	 * @access private
	 * @uses FileLoader::$requiref
	 * @uses FileLoader::$once
	 * @param string	$path	File path.
	 * @return void
	 */
	private function include_file($path) {
		if($this->requiref){
			if($this->once) require_once($path);
			else require($path);
		}
		else{
			if($this->once) include_once($path);
			else include($path);
		}
	}
	
	/**
	 * Check file extension.
	 * @access private
	 * @uses FileLoader::$extensions
	 * @param string	$ext	Extension.
	 * @return void
	 */
	private function check_extension($ext) {
		return(isset($ext) && in_array($ext, $this->extensions));
	}

}

?>
