<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 13.07.16
 * Time: 11:00
 */

namespace web136\Config;

/**
 * Class ConfigFromArrayRead класс, позволяющий создать объект конфигурации из любого массива
 * @package web136\Config
 */
class ConfigFromArray extends  AbstractConfig{
	/** Устанавливает значения параметров конфигурации путем подключения файла.
	 * @param $array array|bool Массив, представляемый в виде конфигурации
	 * @throws \Exception Выбрасывается в случае если передаваемое значение  не массив
	 */
	public function setConfigArray($array = false){
		if(!is_array($array)){
			throw new \Exception('There is array need. '.gettype($array).' given');
		}
		$this->configArray = $array;
	}

	/**
	 * @param $array array Массив, представляемый в виде конфигурации
	 */
	public function __construct($array) {
		//IDE ругается, если не использовать конструктор родителя
		if(false){
			parent::__construct();
		}

		$this->configFile  = null;

		$this->setConfigArray($array);
	}
}


