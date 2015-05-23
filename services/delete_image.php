<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/15/2015
 * Time: 6:31 PM
 */
use entity\Photograph;
use Interactor\PhotoGraphDAO;
include_once"../models/Interactor/PhotoGraphDAO.php";
include_once"../models/Interactor/CommentsDAO.php";

include_once"../models/Interactor/db/MySqlQueryEngine.php";
include_once "../models/utility/CommanFunction.php";
/*if (!$session->is_logged_in()) {     redirect_to("http://localhost/photo_gallery/AdminIdex.html");
} */?>
<?php
// must have an ID
$postData = file_get_contents("php://input");
$request = json_decode($postData);
echo($request->photo_id);

$photoDAO=new PhotoGraphDAO(new \Interactor\MySqlQueryEngine());
$commentDAO=new \Interactor\CommentsDAO(new \Interactor\MySqlQueryEngine());
$photoDetails = $photoDAO->get_by_Id($request->photo_id);

$photo=new Photograph();
$photo->id=$photoDetails[0]->id;
$photo->filename=$photoDetails[0]->filename;
$photo->path=$photoDetails[0]->path;
$photo->caption=$photoDetails[0]->caption;
$photo->size=$photoDetails[0]->size;
$photo->type=$photoDetails[0]->type;

if($photoDAO->destroy($photo)) {
    $commentDAO->remove_comments($photoDetails[0]->id);
    header("HTTP/1.0 200 ok");
}
    else {
    header("HTTP/1.0 204 Not content");
}

?>
