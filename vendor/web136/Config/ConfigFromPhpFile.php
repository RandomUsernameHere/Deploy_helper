<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 13.07.16
 * Time: 11:02
 */

namespace web136\Config;


use web136\Exceptions\InvalidParametersException;
use web136\FileTools;


class AbstractConfigFromPhpFile extends AbstractConfigFromFile{
	
	public function setConfigArray ($param = false) {
		/**@noinspection PhpIncludeInspection*/
		$this->configArray = include($this->configFile['real_path']);
		
		if(!is_array($this->configArray)){
			$this->configArray = null;

			throw new InvalidParametersException(
				array('ConfigFile'=>'В передаваемом файле конфигурация представлена в неправильном формате')
			);
		}
	}

	/**
	 * ConfigRead constructor.
	 * @param string $path Путь к файлу конфигурации
	 * @throws \Exception В случае если файл не доступен для чтения
	 */
	public function __construct ($path) { 		
		parent::__construct($path);		
	}
}