<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 10:57
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/staprtup/bootstrap.php';

use \web136\DebugOutput\CustomDebugger;
use \web136\core\RBDH;

try {

	echo RBDH::getInstance()->getResponse()->render();

} catch (\web136\Exceptions\FileNotExistsException $e) {
	CustomDebugger::debugPrintVar($e -> getMessage());
} catch (\web136\Exceptions\InvalidParametersException $e) {
	CustomDebugger::debugPrintVar($e -> getMessage());
} catch (\Exception $e) {
	CustomDebugger::debugPrintVar($e -> getMessage());
}


