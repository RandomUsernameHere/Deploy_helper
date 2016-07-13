<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 11:17
 */

namespace web136\Config;


abstract class AbstractConfig implements \ArrayAccess, \Iterator {
	protected $configFile = false;

	/** Собственно файл конфигурации
	 * @var string
	 */
	protected $configFileName;

	/** массив значений параметров конфигурации
	 * @var array
	 */
	protected $configArray;

	/** Возвращает массив значений параметров конфигурации
	 * @return array
	 */
	public function getConfigArray () {
		return $this->configArray;
	}

	/** Устанавливает значения параметров конфигурации путем подключения файла. Файл конфигурации должен содержать
	 * return array(
	 * 'ключ' => 'значение'
	 * );
	 * @param mixed $param
	 */
	abstract public function setConfigArray ($param = false);

	public function __construct () {


	}

	//реализация интерфейса \ArrayAccess

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet ($offset, $value) {
		if (is_null ($offset)) {
			$this->configArray[] = $value;
		} else {
			$this->configArray[$offset] = $value;
		}
	}

	/**
	 * @param mixed $offset
	 * @return bool
	 */
	public function offsetExists ($offset) {
		return isset($this->configArray[$offset]);
	}

	/**
	 * @param mixed $offset
	 */
	public function offsetUnset ($offset) {
		unset($this->configArray[$offset]);
	}

	/**
	 * @param mixed $offset
	 * @return mixed|null
	 */
	public function offsetGet ($offset) {
		return isset($this->configArray[$offset]) ? $this->configArray[$offset] : null;
	}

	//Реализация интерфейса \Iterator (чтобы foreach работал)

	public function current () {
		return current ($this->configArray);
	}

	public function next () {
		return next ($this->configArray);
	}

	public function rewind () {
		return reset ($this->configArray);
	}

	public function valid () {
		return key ($this->configArray) !== null;
	}

	public function key () {
		return key ($this->configArray);
	}
}