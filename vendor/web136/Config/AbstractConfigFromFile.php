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


abstract class AbstractConfigFromFile extends AbstractConfig{
	/**
	 * ConfigRead constructor.
	 * @param string $path Путь к файлу конфигурации
	 * @throws \Exception В случае если файл не доступен для чтения
	 */
	public function __construct ($path) {
		$this->configFile = new  FileTools\File($path);

		if(!$this->configFile['is_readable']){
			throw new \Exception("There are not readable config file {$this->configFile['path']}");
		}

		$this->setConfigArray();
	}
}