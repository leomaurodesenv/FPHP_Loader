<?php

/** 
 * Error parser from FPHP_Loader
 * This class get and show error in uses of this package.
 * 
 * @author Leonardo Mauro <leo.mauro.desenv@gmail.com>
 * @link https://github.com/leomaurodesenv/FPHP_Loader/ GitHub
 * @link https://www.phpclasses.org/fphp_loader PHP Classes
 * @license https://opensource.org/licenses/GPL-2.0 GNU Public License (GPL v2)
 * @copyright 2016 Leonardo Mauro
 * @version 2.0.1 17-01-25
 * @package FPHP_Loader
 * @access public
 */

namespace FPHP_Loader;

class ErrorParserLoader {
	
	/** 
	 * Const description.
	 * @var const int	E_EXTENSION			Extension invalid.
	 * @var const int	E_FILE_NOT_EXIST	File not exist.
	 * @var const int	E_DIRECTORY			Directory invalid.
	 * @var const int	E_VAR_TYPE			Value invalid for a determinate var type.
	 */ 
	const E_EXTENSION = 47;
	const E_FILE_NOT_EXIST = 48;
	const E_DIRECTORY = 49;
	const E_VAR_TYPE = 50;
	
	/**
	 * Get error parser (string).
	 * @access public
	 * @param int $error	const of ErrorParserLoader.
	 * @return string
	 */
	public static function parser($error){
		switch($error){
			case self::E_EXTENSION:
				return('extension invalid');
			case self::E_FILE_NOT_EXIST:
				return('file not exist');
			case self::E_DIRECTORY:
				return('directory invalid');
			case self::E_VAR_TYPE:
				return('value invalid');
		}
		return('don\'t have this error in list.'); 
	}
	
	/**
	 * Echo a dump error.
	 * @access public
	 * @param object	$class		Class how called this function.
	 * @param string	$error		Error parser.
	 * @param string	$detail		Detail of dump.
	 * @param bool		$breakline	Set breakline (`<br/>` and `PHP_EOL`).
	 * @return void
	 */
	public static function dump($class, $error, $detail=false, $breakline=true) {
		$out = 'Class '.get_class($class).' Error ('.$error.'): ';
		$out .= self::parser($error);
		if($detail != false) $out .= ' - '.$detail;
		if($breakline) echo($out.'<br/>'.PHP_EOL);
	}
}

?>
