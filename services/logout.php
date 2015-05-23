<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/18/2015
 * Time: 6:44 PM
 */
include_once("Session.php");
include_once("../models/utility/CommanFunction.php");
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");

$session->logout();
?>