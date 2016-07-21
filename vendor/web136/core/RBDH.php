<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 14:22
 */

namespace web136\core;


use web136\Config\ConfigFromArray;
use web136\Config\ConfigFromPhpFile;
use web136\DebugOutput\CustomDebugger;
use web136\Exceptions\InvalidParametersException;
use web136\FileTools\FileHelper;
use web136\UserInterface\Router\Route;
use web136\UserInterface\Templates\Response;

class RBDH {

	protected $Config = null;

	protected $Response = null;

	protected $Route = null;

	protected $aliases = array();

	protected function __construct ($config) {

		$this->checkConfig ($config);

		if (is_array ($config)) {
			$this->Config = new ConfigFromArray($config);
		} else {
			$this->Config = new ConfigFromPhpFile($config);
		}

		foreach ($this->Config['directories'] as $directory){
			$this->setAlias($directory['alias'], $directory['path']);
		}

		//Предупреждение о несуществующем ключе возможно
		if(empty($_GET['route'])){
			$_GET['route'] = '';
		}

		$this->Route = new Route($_GET['route'], $this->Config);

		$this->Response = Response::getInstance();

	}

	protected function __clone () {
	}

	protected static $instance = null;

	/**
	 * @param array|string $config
	 * @return RBDH
	 */
	public static function getInstance ($config = null) {
		if (!self::$instance) {
			self::$instance = new RBDH($config);
		}

		return self::$instance;
	}

	protected function checkConfig ($config) {

		if (empty($config)) {
			throw new InvalidParametersException(array('config' => "Param is required to be not empty"));
		}

		if (!is_array ($config) && gettype ($config) != 'string') {
			throw new InvalidParametersException(array('config' => "Need array or string. There are " . gettype ($config) . " given"));
		}

		if (!is_array ($config) && !FileHelper::isFileExists ($config)) {
			throw new InvalidParametersException(array('config' => "Config file is not exists"));
		}

	}

	/**
	 * @return null|ConfigFromPhpFile
	 */
	public function getConfig () {
		return $this->Config;
	}

	/**
	 * @return mixed|null
	 */
	public function getResponse () {
		return $this->Response;
	}

	public function setAlias($alias, $path){
		if(!empty($alias) && !empty($path)){
			$this->aliases[$alias] = $path;
			return true;
		}
		else{
			return false;
		}
	}

	public function parseAliases($path){
		preg_match_all('#\@.*\@#', $path, $result ,PREG_SET_ORDER);

		if(!empty($result[0][0]) && array_key_exists($result[0][0], $this->aliases)){

			$path = preg_replace("#{$result[0][0]}#", rtrim($this->aliases[$result[0][0]], '/'), $path);
			return $this->parseAliases($path);

		}
		else{

			return $path;

		}
	}
}