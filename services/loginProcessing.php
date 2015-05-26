<?php
use Interactor\DBConnection;

include_once("Session.php");
include_once("../models/Interactor/db/MySqlQueryEngine.php");
include_once("../models/Interactor/UsersDAO.php");
include_once("../models/utility/CommanFunction.php");
include_once("../models/Interactor/db/DBConnection.php");

/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/18/2015
 * Time: 3:46 PM
 */
header("Access-Control-Allow-Origin: *");
$postData = file_get_contents("php://input");
$request = json_decode($postData);

$user=new \Interactor\UsersDAO(new \Interactor\MySqlQueryEngine());
$name =mysqli_escape_string(DBConnection::getInstance()->getConnection(), $request->user);
$pass =mysqli_escape_string(DBConnection::getInstance()->getConnection(),$request->pass);

$found_user = $user->authenticate($name,$pass);
print_r($found_user);
if (isset($found_user[0]->id)) {
    $session->login($found_user);
    log_action("Login",$name);
    echo $name;
} else {
    header("HTTP/1.0 204 Not content");
}
