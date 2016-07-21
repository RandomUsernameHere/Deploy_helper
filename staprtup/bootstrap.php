<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 14:23
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//Подключаем автозагрузку
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';



try {
	//Стартуем ядро
	\web136\core\RBDH::getInstance('/config/general.php');

} catch (\web136\Exceptions\FileNotExistsException $e) {
	\web136\DebugOutput\CustomDebugger::debugPrintVar($e -> getMessage());
} catch (\web136\Exceptions\InvalidParametersException $e) {
	\web136\DebugOutput\CustomDebugger::debugPrintVar($e -> getMessage());
} catch (\Exception $e) {
	\web136\DebugOutput\CustomDebugger::debugPrintVar($e -> getMessage());
	$e->getTrace();
}