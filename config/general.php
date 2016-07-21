<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 15.07.16
 * Time: 13:54
 */

return array(

	'directories' => array(
		
		'baseDir' => array(
			'path' => '/var/www/local.deploy-helper.net/', 
			'alias' => '@baseDir@'
		), 
		
		'controllersDir' => array(
			'path' => '@baseDir@/pages/controllers', 
			'alias' => '@controllers@'
		),

		'templatesDir' => array(
			'path' => '@baseDir@/pages/templates', 
			'alias' => '@templates@'
		)
	),


	'default_route' => 'site/index'

);