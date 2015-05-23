<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/13/2015
 * Time: 9:34 PM
 */
/*if (!$session->is_logged_in()) {     redirect_to("http://localhost/photo_gallery/AdminIdex.html");
}*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "D:/wamp/www/phpphotogallery/models/Interactor/PhotoGraphDAO.php";
include_once "D:/wamp/www/phpphotogallery/models/Interactor/db/MySqlQueryEngine.php";
$photos=new \Interactor\PhotoGraphDAO(new \Interactor\MySqlQueryEngine());
$photoList=$photos->getPhotographs();
$a="";
$photo= json_encode($photoList);
$result='{"records" :'.$photo.'}';
echo($result);

?>