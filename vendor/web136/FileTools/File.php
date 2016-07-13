<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 15:26
 */

namespace web136\FileTools;


class File implements \ArrayAccess, \Iterator{

	protected $file = array();

	public function __construct ($path) {
		//Бросает исключение в случае отсутствия файла
		FileHelper::isFileExists($path, true);

		$this->file = pathinfo($path);
		$this->file['path'] = $path;
		$this->file['real_path'] = FileHelper::makeAbsoluteFilePath($path);
		$this->file['is_readable'] = FileHelper::isFileReadable($path);
		$this->file['is_writable'] = FileHelper::isFileWritable($path);
	}

	/**
	 * @return array|mixed
	 */
	public function getFile () {
		return $this->file;
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->file[] = $value;
		} else {
			$this->file[$offset] = $value;
		}
	}

	/**
	 * @param mixed $offset
	 * @return bool
	 */
	public function offsetExists($offset) {
		return isset($this->file[$offset]);
	}

	/**
	 * @param mixed $offset
	 */
	public function offsetUnset($offset) {
		unset($this->file[$offset]);
	}

	/**
	 * @param mixed $offset
	 * @return mixed|null
	 */
	public function offsetGet($offset) {
		return isset($this->file[$offset]) ? $this->file[$offset] : null;
	}

	//Реализация интерфейса \Iterator (чтобы foreach работал)

	public function current() {
		return current($this->file);
	}

	public function next() {
		return next($this->file);
	}

	public function rewind() {
		return reset($this->file);
	}

	public function valid() {
		return key($this->file) !== null;
	}

	public function key() {
		return key($this->file);
	}
}