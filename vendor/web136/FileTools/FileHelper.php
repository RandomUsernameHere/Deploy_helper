<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 12:03
 */

namespace web136\FileTools;

use web136\Exceptions;


/**
 * Class FileHelper работа с файлами
 * @package web136\FileTools
 */
class FileHelper {

	/**
	 * Проверяет файл на существование. Обертка над стандартной функцией file_exists
	 * @param string $path путь к файлу от корня веб-сервера
	 * @param bool $throwExceptionIfFileNotExists бросать исключение, если файл не найден  
	 * @throws Exceptions\FileNotExistsException
	 * @return bool вщзвращает true, если файл существует false или исключение Exceptions\FileNotExistsException
	 * в зависимости от параметра  $throwExceptionIfFileNotExists, если файл не существует
	 */
	public static function isFileExists($path = '', $throwExceptionIfFileNotExists = false){

		self::checkPathParam($path);

		$result = self::makeAbsoluteFilePath($path);

		if($result){
			return (boolean)$result;
		}
		else{
			
			if($throwExceptionIfFileNotExists){
				throw new Exceptions\FileNotExistsException($path);
			}
			else{
				return false;
			}
		}
			
	}

	/**
	 * Проверяет на то, доступен ли файл для чтения для текущим пользователем.
	 * Обертка над стандартной функцией  is_readable.
	 * @param string $path путь к файлу от корня веб-сервера
	 * @return bool
	 */
	public static function isFileReadable($path = ''){

		self::checkPathParam($path);
		self::isFileExists($path, true);
		$path = self::makeAbsoluteFilePath($path);

		return is_readable($path);
	}

	/**
	 * Проверка на то, доступен ли файл для записи
	 * @param string $path путь к файлу от корня веб-сервера
	 * @return bool
	 */
	public static function isFileWritable($path = ''){

		self::checkPathParam($path);
		self::isFileExists($path, true);
		$path = self::makeAbsoluteFilePath($path);

		return is_writable($path);
	}

	/**
	 * Создает абсолютный путь из относительного
	 * @param string $path путь к файлу от корня веб-сервера
	 * @throws Exceptions\InvalidParametersException
	 * @return string
	 */
	public  static function makeAbsoluteFilePath($path){
		self::checkPathParam($path);
		$path = $_SERVER['DOCUMENT_ROOT'].'/'.ltrim($path, '/');
		return realpath($path);
	}

	/**
	 * Проверяет корректность параметра $path
	 * @throws Exceptions\InvalidParametersException бросает исключение в случае, если параметр не корректен
	 * @param string $path путь к файлу от корня веб-сервера
	 **/
	protected static function checkPathParam($path){
		if(empty($path)){
			throw new Exceptions\InvalidParametersException(array('path' => 'Empty file path.'));
		}
	}
}