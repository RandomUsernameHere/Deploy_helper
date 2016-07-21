<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 19:05
 */

namespace web136\UserInterface\Router;


use web136\core\RBDH;
use web136\DebugOutput\CustomDebugger;
use web136\FileTools\File;
use web136\FileTools\FileHelper;

class Route {

	protected $route = null;

	protected $default_route = 'site/index';

	protected $routeControllerClassName = null;

	protected $routeControllerMethodName = null;

	protected $controller = null;

	protected $Config;

	public function __construct ($route = '', $config) {

		$this->Config = $config;

		$this->setDefaultRoute($config['default_route']);

		$this->setRoute ($route);

		$this->parseRoute($this->getRoute());

		$this->setController();

	}

	protected function setRoute ($route = '') {
		if (!empty($route)) {
			$route = trim ($route, ' /');

			$routeArray = explode ('/', $route, 3);

			if (count ($routeArray) > 2) {
				$routeArray = array_slice ($routeArray, 0, 2);
			} elseif (count ($routeArray) == 1) {
				$routeArray[1] = 'index';
			}

			$this->route = trim (implode ('/', $routeArray), '/');
		} else {
			$this->route = $this->getDefaultRoute();
		}
	}

	protected function parseRoute ($route) {
		$routeArray = explode ('/', $route);

		$this->routeControllerClassName = $routeArray[0];
		$this->routeControllerMethodName = $routeArray[1];
	}

	protected function setController(){

		$controllerFile = new File($this->getControllerDir() .  $this->getRouteControllerClassName() . '.php');

		include_once ($controllerFile['real_path']);

		$this->controller = new $this->routeControllerClassName();

	}

	public function getControllerDir(){

		$path = rtrim(preg_replace(
			'#@.*@#', '', $this->Config['directories']['controllersDir']['path']) , '/'
		);

		return $path . '/';
	}

	public function getRoute () {
		return $this->route;
	}

	public function getDefaultRoute(){
		return $this->Config['default_route'];
	}

	public function setDefaultRoute($default_route = ''){
		if(empty((string)$default_route)){
			$default_route = 'site/index';
		}

		$this->Config['default_route'] = $default_route;
	}

	/**
	 * @return null
	 */
	public function getRouteControllerClassName () {
		return $this->routeControllerClassName;
	}

	/**
	 * @return null
	 */
	public function getRouteControllerMethodName () {
		return $this->routeControllerMethodName;
	}
}