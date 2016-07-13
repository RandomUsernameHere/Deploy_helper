<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 13.07.16
 * Time: 10:40
 */

namespace web136\DebugOutput;


/**
 * Class CustomDebugger  поставляет обертки для функций вывода переменных
 * @package web136\DebugOutput
 */
class CustomDebugger {
	/**
	 * Выводит переменную $var в обертке из <pre>. Для вывода используется функция print_r()
	 * @param mixed $var  проверяемая переменная
	 * @param string $label подпись к выводу
	 */
	public static function debugPrintVar($var = null, $label=''){
		 echo '<pre style="white-space: pre">';
		 if(!empty($label)){
			 echo '<div>';
			 echo $label;
			 echo '</div>';
		 }
		 print_r($var);
		 echo '</pre>';
	 }

	/**
	 * Выводит переменную $var в обертке из <pre>. Для вывода используется функция var_dump()
	 * @param mixed $var  проверяемая переменная
	 * @param string $label подпись к выводу
	 */
	public static function printVarDump($var = null, $label=''){
		echo '<pre style="white-space: pre">';
		if(!empty($label)){
			echo '<div>';
			echo $label;
			echo '</div>';
		}
		var_dump($var);
		echo '</pre>';
	}
}