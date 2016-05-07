<?php

/** 
* Class FPHP_loader
* This class loader files from direct paths, or directory path.
* 
* @author Leonardo Mauro <leo.mauro.desenv@gmail.com>
* @link http://leonardomauro.com/portfolio/	Portfolio of Leonardo Mauro
* @version 1.2
* @copyright © 2016 Leonardo Mauro
* @license https://opensource.org/licenses/GPL-2.0 GNU Public License (GPL v2)
* @package FPHP
* @access public
*/ 

class FPHP_loader{
	
	/** 
	* Variables description.
	* @var array(string) $extensions	Set files extensions allowed.
	* @var bool $require				Set function require (= true) or include (= false).
	* @var bool $once					Set function once (= true) or not.
	* @var bool $one_error				Set to stop execution after dump first error.
	*/ 
	private $extensions;
	private $require, $once;
	private $one_error;
    
	/**
	* Construct of class FPHP_loader
	*/
    public function __construct($ext=false, $req=true, $onc=true, $error=false){
		if($ext==false || !is_array($ext)) $data = array('php');
		$this->extensions = $ext;
		$this->require = (bool) $req;
		$this->once = (bool) $onc;
		
		$this->one_error = (bool) $error;
	}
	
	/**
	* Include allow files from the path ($dir)
	* @access public
	* @param string $dir	String of path.
	*/
	public function load_dir($dir){
		if(is_dir($dir)){
			$files = scandir($dir);
			foreach($files as $k2 => $v2){
				$this->inload_dir($dir.$v2);
			}
		}
		else $this->dump_error('directory invalid', $dir);
	}
	
	/**
	* Include one file from the path ($path)
	* @access public
	* @param string $path	String of file path.
	*/
	public function load_file($path){
		$file = pathinfo($path);
		if(file_exists($path)){
			if(isset($file['extension']) && in_array($file['extension'], $this->extensions))
				$this->inload_file($path);
			else $this->dump_error('extension', $path);
		}
		else $this->dump_error('file not exists', $path);
	}

	/**
	* Valid file of directory (FPHP_loader::load_dir)
	* @param string $path	String of file path.
	*/
	private function inload_dir($path){
		$file = pathinfo($path);
		if(isset($file['extension']) && in_array($file['extension'], $this->extensions))
			$this->inload_file($path);
	}
	
	/**
	* Load file from the path ($path)
	* @param string $path	String of file path.
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
	* Dump internal errors ($path)
	* @uses FPHP_loader::$one_error	Stop the execution of program after first error.
	* @param string $str			String error.
	* @param string $detail			String detail error.
	*/
	private function dump_error($str, $detail=false){
		$print_c = 'Class FPHP_loader Error: ';
		if($detail != false) $print_c .= '%s - '.$detail.PHP_EOL;
		else $print_c .= '%s'.PHP_EOL;
		printf($print_c, $str);
		
		if($this->one_error) exit;
	}
}

?>