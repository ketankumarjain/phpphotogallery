<?php

/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/27/2015
 * Time: 2:28 PM
 */

function my_autoloader($class_name){
    //echo $class_name;
    $msg=2;
    $path1 =dirname(__DIR__)."/config/{$class_name}.php";
    $path2 =dirname(__DIR__)."/models/{$class_name}.php";
    $path3 =dirname(__DIR__)."/services/{$class_name}.php";

    $paths=array($path1,$path2,$path3);
    foreach($paths as $path){
        if(file_exists($path)) {
            require_once($path);
        }else {
            $msg--;
        }
    }
    echo $msg>2;
}
spl_autoload_register('my_autoloader');
