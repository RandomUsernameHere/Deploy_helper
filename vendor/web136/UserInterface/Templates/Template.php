<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 13:32
 */

namespace web136\UserInterface\Templates;


use web136\DebugOutput\CustomDebugger;
use web136\FileTools\File;
use web136\UserInterface\Router\Route;

class Template {

	protected $data = array();

	protected $file = '';

	public function __construct ($templateFile, $data) {
		$this->data = new TemplateData($data);
		$this->file = new File($templateFile);
	}

	public function render () {
		ob_start ();
		ob_implicit_flush (false);
		$data = $this->data;
		require ($this->file['real_path']);

		return ob_get_clean ();
	}

	public function renderController($controller){
		$Route = new Route($controller);

		$className = $Route->getRouteControllerClassName();
		$methodName = $Route->getRouteControllerMethodName();


	}
}