<?php
/** 
 * This class can load one or more PHP scripts|files from a directory.
 * 
 * It can take a given directory and loads all scripts in that directory that have a given file name extension. <br>
 * The class supports multiple file name extensions to check and defaults to .php . <br>
 * The script files can be loaded with either include(_once) or require(_once).
 * 
 * @author Leonardo Mauro <leo.mauro.desenv@gmail.com>
 * @link https://github.com/leomaurodesenv/FPHP_loader/ GitHub
 * @link https://opensource.org/licenses/GPL-2.0 GNU Public License (GPL v2)
 * @version 1.2.2 16-05-17
 * @copyright 2016 Leonardo Mauro
 * @license GPL v2
 * @package FPHP
 * @access public
 */ 

class FPHP_Loader{
	
	/** @var array $extensions Extensions allowed. */ 
	private $extensions;
	/** @var bool $require Define require|include function. */
	private $require;
	/** @var bool $once Define $require(_once). */
	private $once;
	/** @var bool $one_error Define stop execution after dump first error. */
	private $one_error;

	
	/**
	 * Construct of class FPHP_Loader
	 * @access public
	 * @param array|bool 	$ext 	Set files extensions allowed
	 * @param bool 			$req 	Set require|include
	 * @param bool 			$onc 	Set require|include(once)
	 * @param bool 			$error 	Set to stop execution after dump error
	 * @return self
	 */
    public function __construct($ext=false, $req=true, $onc=true, $error=false){
		if($ext==false || !is_array($ext)) $data = array('php');
		$this->extensions = $ext;
		$this->require = (bool) $req;
		$this->once = (bool) $onc;	
		$this->one_error = (bool) $error;
	}

	/**
	 * Include files from the path (folder).
	 * @access public
	 * @param string $dir String of path
	 * @return void
	 */
	public function load_dir($dir){
		if(is_dir($dir)){
			$files = scandir($dir);
			foreach($files as $k2 => $v2){
				self::inload_dir($dir.$v2);
			}
		}
		else self::dump_error('directory invalid', $dir);
	}

	/**
	 * Include one file from the path.
	 * @access public
	 * @uses FPHP_Loader::$extensions
	 * @param string $path String of file path
	 * @return void
	 */
	public function load_file($path){
		$file = pathinfo($path);
		if(file_exists($path)){
			if(isset($file['extension']) && in_array($file['extension'], $this->extensions))
				self::inload_file($path);
			else self::dump_error('extension', $path);
		}
		else self::dump_error('file not exists', $path);
	}

	/**
	 * Valid file of directory (FPHP_Loader::load_dir).
	 * @access private
	 * @uses FPHP_Loader::$extensions
	 * @param string $path	String of file path
	 * @return void
	 */
	private function inload_dir($path){
		$file = pathinfo($path);
		if(isset($file['extension']) && in_array($file['extension'], $this->extensions))
			self::inload_file($path);
	}
	
	/**
	 * Load file from the path ($path).
	 * @access private
	 * @uses FPHP_Loader::$require
	 * @uses FPHP_Loader::$once
	 * @param string $path	String of file path
	 * @return void
	 */
	private function inload_file($path){
		if($this->require){
			if($this->once) require_once($path);
			else require($path);
		}
		else{
			if($this->once) include_once($path);
			else include($path);
		}
	}

	/**
	 * Dump internal errors.
	 * @access private
	 * @uses FPHP_Loader::$one_error
	 * @param string $str				String error
	 * @param string $detail			String detail error
	 * @return void
	 */
	private function dump_error($str, $detail=false){
		$print_c = 'Class FPHP_Loader Error: ';
		if($detail != false) $print_c .= '%s - '.$detail.PHP_EOL;
		else $print_c .= '%s'.PHP_EOL;
		printf($print_c, $str);
		
		if($this->one_error) exit;
	}
}

?>
