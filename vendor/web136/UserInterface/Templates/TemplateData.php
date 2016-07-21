<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 23:14
 */

namespace web136\UserInterface\Templates;


use web136\DebugOutput\CustomDebugger;

class TemplateData implements \ArrayAccess, \Iterator {
	
	protected $data = array();

	public function __construct ($data = null) {
		if(!empty($data)){
			$this->addDataByArray($data);
		}
	}

	public function addData($value, $index = false){
		if($index){
			$this->data[$index] = $value;
		}
		else{
			$this->data[] = $value;
		}
	}

	public function removeData($index){
		unset($this->data[$index]);
	}

	public function updateData($index, $value){

		if(array_key_exists($index, $this->data)){
			$this->data[$index] = $value;
			return true;
		}
		else{
			return false;
		}

	}

	public function addDataByArray($data){

		if(is_array($data)){
			$this->data = array_merge($this->data, $data);
			return true;
		}
		else{
			return false;
		}
	}

	//реализация интерфейса \ArrayAccess

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet ($offset, $value) {
		if (is_null ($offset)) {
			$this->data[] = $value;
		} else {
			$this->data[$offset] = $value;
		}
	}

	/**
	 * @param mixed $offset
	 * @return bool
	 */
	public function offsetExists ($offset) {
		return isset($this->data[$offset]);
	}

	/**
	 * @param mixed $offset
	 */
	public function offsetUnset ($offset) {
		unset($this->data[$offset]);
	}

	/**
	 * @param mixed $offset
	 * @return mixed|null
	 */
	public function offsetGet ($offset) {
		return isset($this->data[$offset]) ? $this->data[$offset] : null;
	}

	//Реализация интерфейса \Iterator (чтобы foreach работал)

	public function current () {
		return current ($this->data);
	}

	public function next () {
		return next ($this->data);
	}

	public function rewind () {
		return reset ($this->data);
	}

	public function valid () {
		return key ($this->data) !== null;
	}

	public function key () {
		return key ($this->data);
	}
}