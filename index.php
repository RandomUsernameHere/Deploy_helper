<?php

/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 10:57
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

echo 'Test OK';

try {
	$testObject =  new \web136\FileTools\File('/index.php');
	\web136\DebugOutput\CustomDebugger::debugPrintVar($testObject);
} catch (\web136\Exceptions\FileNotExistsException $e) {
	\web136\DebugOutput\CustomDebugger::debugPrintVar($e -> getMessage());
} catch (\web136\Exceptions\InvalidParametersException $e) {
	\web136\DebugOutput\CustomDebugger::debugPrintVar($e -> getMessage());
} catch (\Exception $e) {
	\web136\DebugOutput\CustomDebugger::debugPrintVar($e -> getMessage());
}


