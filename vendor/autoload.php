<?php
/**
 * Created by PhpStorm.
 * User: jaman
 * Date: 12.07.16
 * Time: 10:56
 */


spl_autoload_register(function($className){
    $className = ltrim($className, '\\');

    $fileName = $_SERVER['DOCUMENT_ROOT']
        . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR ;

    $fileNameArray = explode('\\', $className);    

    $fileNameString = implode(DIRECTORY_SEPARATOR, $fileNameArray);

    $fileName .= $fileNameString.'.php';

    if(file_exists($fileName)){
        require_once $fileName;
    }
});