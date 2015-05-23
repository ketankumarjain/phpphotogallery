<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/16/2015
 * Time: 2:00 PM
 */
use Interactor\PhotoGraphDAO;
include_once"../models/Interactor/PhotoGraphDAO.php";
include_once"../models/Interactor/db/MySqlQueryEngine.php";
include_once "../models/utility/CommanFunction.php";
include_once"../models/entity/Comment.php";
?>
<?php
// must have an ID

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$photoDAO=new PhotoGraphDAO(new \Interactor\MySqlQueryEngine());//code smell
$photoDetails=array();
$photoId=$_REQUEST['id'];

if(isset($photoId)) {
    $photoDetails = $photoDAO->get_by_Id($photoId);
    $photo=$photoDetails[0];
    $records=json_encode($photoDetails[0]);
    $comments=$photoDAO->getComments($photo);
    $records2=json_encode($comments);
    $result='{"record" :'.$records.','.'"comments" :'.$records2.'}';

    echo $result;
}

?>
