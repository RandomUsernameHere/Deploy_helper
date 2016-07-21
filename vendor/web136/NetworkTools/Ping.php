<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 12:04
 */

namespace web136\NetworkTools;

use web136\DebugOutput\CustomDebugger;

class Ping {
	public static function ping ($host = '') {
		$execResult = array();
		$methodResult = array('STATUS' => null, 'STATUS_DESCRIPTION' => 'Status not initialized', 'FULL_CONSOLE_OUTPUT' => '');

		exec ("ping {$host} -c 3 -n 2>&1", $execResult, $execResult['command_terminate_status']);

		if ($execResult['command_terminate_status'] == 2) {

			$methodResult['STATUS'] = 'ERROR';
			$methodResult['STATUS_DESCRIPTION'] = 'Command terminated width error code 2';
			$methodResult['FULL_CONSOLE_OUTPUT'] =  self::createFullConsoleOutput($execResult);
		}
		elseif ($execResult['command_terminate_status'] == 0 || $execResult['command_terminate_status'] == 1) {

			$lostPercentage = self::findLossPercentage (self::createFullConsoleOutput($execResult));

			if($lostPercentage !== false){
				$lostPercentage = (int)$lostPercentage;
			}

			if($lostPercentage === 100){
				$methodResult['STATUS'] = 'ERROR';
				$methodResult['STATUS_DESCRIPTION'] = '100% packet loss';
				$methodResult['FULL_CONSOLE_OUTPUT'] =  self::createFullConsoleOutput($execResult);
			}
			elseif ($lostPercentage < 100 && $lostPercentage >0){
				$methodResult['STATUS'] = 'WARNING';
				$methodResult['STATUS_DESCRIPTION'] = "{$lostPercentage}% packet loss";
				$methodResult['FULL_CONSOLE_OUTPUT'] =  self::createFullConsoleOutput($execResult);
			}
			elseif($lostPercentage === 0){
				$methodResult['STATUS'] = 'SUCCESS';
				$methodResult['STATUS_DESCRIPTION'] = "PING OK";
				$methodResult['FULL_CONSOLE_OUTPUT'] =  self::createFullConsoleOutput($execResult);
			}
			else{
				$methodResult['STATUS'] = 'ERROR';
				$methodResult['STATUS_DESCRIPTION'] = "ERROR WHEN LOST Percentage detect";
				$methodResult['FULL_CONSOLE_OUTPUT'] =  self::createFullConsoleOutput($execResult);
			}
		}
		else{
			$methodResult['STATUS'] = 'ERROR';
			$methodResult['STATUS_DESCRIPTION'] = 'Unknown error';
			$methodResult['FULL_CONSOLE_OUTPUT'] =  self::createFullConsoleOutput($execResult);
		}

		return $methodResult;
	}

	protected static function findLossPercentage ($string) {
		$result = array();

		preg_match_all ('#([\d]{1,3})\% packet loss#Usmi', $string, $result, PREG_SET_ORDER);

		if (!empty($result)) {
			return $result[0][1];
		} else {
			return false;
		}
	}

	protected static function createFullConsoleOutput($execResult){
		unset($execResult['command_terminate_status']);
		return implode("\n", $execResult);
	}
}