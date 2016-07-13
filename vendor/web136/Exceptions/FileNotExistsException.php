<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 12:56
 */

namespace web136\Exceptions;


class FileNotExistsException extends \Exception{
	public function __construct ($filePath, $message = '', $code = 0, \Exception $previous = null) {
		$message =  "$filePath is not exists. ";
		parent::__construct ($message, $code, $previous);
	}
}