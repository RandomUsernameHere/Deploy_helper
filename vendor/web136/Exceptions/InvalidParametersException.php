<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 13:12
 */

namespace web136\Exceptions;


class InvalidParametersException extends \Exception{

	protected $paramsWidthError = array();

	public function getParamsWidthError(){
		return $this->paramsWidthError;
	}

	protected function setParamsWidthError($paramsWidthError){
		if(!empty($paramsWidthError) && is_array($paramsWidthError)){
			$this->paramsWidthError = $paramsWidthError;
		}
	}

	public function __construct ($paramsWidthError, $message = '', $code = 0, \Exception $previous = null) {

		$this->setParamsWidthError($paramsWidthError);

		parent::__construct ($message, $code, $previous);
	}
}