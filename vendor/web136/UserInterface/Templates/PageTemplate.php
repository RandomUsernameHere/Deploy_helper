<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 23:43
 */

namespace web136\UserInterface\Templates;


use web136\DebugOutput\CustomDebugger;

class PageTemplate extends  Template{

	public function __construct ($templateFile, $data) {

		$templateFile =  '/pages/templates/pages/default/main.php';

		$data = array(
			'content' => 'This is main template'
		);

		parent::__construct ($templateFile, $data);
	}

}