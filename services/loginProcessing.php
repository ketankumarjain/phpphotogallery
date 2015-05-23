<?php
include_once("Session.php");
include_once("../models/Interactor/db/MySqlQueryEngine.php");
include_once("../models/Interactor/UsersDAO.php");
include_once("../models/utility/CommanFunction.php");

/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/18/2015
 * Time: 3:46 PM
 */
header("Access-Control-Allow-Origin: *");
$postData = file_get_contents("php://input");
$request = json_decode($postData);
$name = $request->user;
$pass = $request->pass;

$user=new \Interactor\UsersDAO(new \Interactor\MySqlQueryEngine());
$found_user = $user->authenticate($name,$pass);
if (isset($found_user->id)) {
    $session->login($found_user);
    echo $name;
} else {
    header("HTTP/1.0 204 Not content");
}
