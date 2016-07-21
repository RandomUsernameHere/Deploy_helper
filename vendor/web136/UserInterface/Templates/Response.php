<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 13:34
 */

namespace web136\UserInterface\Templates;


use web136\core\RBDH;
use web136\DebugOutput\CustomDebugger;

class Response {

	protected $pageTemplate = null;

	protected function __construct(){
		//CustomDebugger::debugPrintVar(RBDH::getInstance());
		$this->pageTemplate = new PageTemplate(false, false);
	}

	protected function __clone(){}

	public static $instance;

	/**
	 * @return mixed
	 */
	public static function getInstance () {

		if (!self::$instance) {
			self::$instance = new Response();
		}

		return self::$instance;
	}

	public function render(){
		return $this->pageTemplate->render();
	}

}