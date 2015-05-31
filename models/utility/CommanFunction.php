<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/26/2015
 * Time: 11:17 AM
 */

function redirect_to( $location = NULL ) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function output_message($message="") {
    if (!empty($message)) {
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}

function log_action($action, $message="") {
    $logfile =dirname(__DIR__)."\\log.ini"; //SITE_ROOT.DS.'logs'.DS.'log.txt';
    $new = file_exists($logfile) ? false : true;
    if($handle = fopen($logfile, 'a')) { // append
        date_default_timezone_set("Asia/Kolkata");
        $timestamp = date('d-m-Y H:i:s', time());
        $content = "{$timestamp} | {$action}: {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        if($new) {
            chmod($logfile, 0755); }
    } else {
        echo "Could not open log file for writing.";
    }
    function __autoload($class_name){
        $msg="";
        $path1 =dirname(__FILE__)."/config/{$class_name}.php";
        $path2 =dirname(__FILE__)."/models/{$class_name}.php";
        $path3=dirname(__FILE__)."/models/{$class_name}.php";
        $path4=dirname(__FILE__)."/models/{$class_name}.php";
        $paths=array($path1,$path2,$path3,$path4);
        foreach($paths as $path){
            if(file_exists($path)) {
                require_once($path);
            }else{
                $msg="Error";
            }
        }
        echo $msg;
    }
}
?>