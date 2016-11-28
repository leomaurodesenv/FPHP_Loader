<?php

/** 
* Error parser from FPHP_Loader
* This class get and show error in uses of classes
* 
* @author Leonardo Mauro <leo.mauro.desenv@gmail.com>
* @link http://leonardomauro.com/portfolio/	Portfolio of Leonardo Mauro
* @license https://opensource.org/licenses/GPL-2.0 GNU Public License (GPL v2)
* @copyright © 2016 Leonardo Mauro
* @version 1.1.0 16-11-28
* @package FPHP_Loader
* @access public
*/ 

class E_FPHP_Loader{
	
	/** 
	* Const description.
	* @var const int	E_EXTENSION			Extension invalid.
	* @var const int	E_FILE_NOT_EXIST	File not exist.
	* @var const int	E_DIRECTORY			Directory invalid.
	*/ 
	const E_EXTENSION = 47;
	const E_FILE_NOT_EXIST = 48;
	const E_DIRECTORY = 49;
	
	/**
	* Get error parser (string).
	* @access public
	* @param int $error	const of E_FPHP_Loader.
	* @return string
	*/
	public static function parser($error){
		switch($error){
			case self::E_EXTENSION:
				return 'extension invalid';
			case self::E_FILE_NOT_EXIST:
				return 'file not exist';	
			case self::E_DIRECTORY:
				return 'directory invalid';
		}
		return "don't have this error in list."; 
	}
	
}

?>
