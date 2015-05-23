<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/22/2015
 * Time: 3:40 PM
 */
include_once"../models/Interactor/CommentsDAO.php";
include_once"../models/Interactor/db/MySqlQueryEngine.php";
include_once "../models/utility/CommanFunction.php";
include_once"../models/entity/Comment.php"
/*if (!$session->is_logged_in()) {     redirect_to("http://localhost/photo_gallery/AdminIdex.html");
} */?>
<?php
// must have an ID
$postData = file_get_contents("php://input");
$request = json_decode($postData);
$postId =$request->postId;


$CommentDAO=new \Interactor\CommentsDAO(new \Interactor\MySqlQueryEngine());
$CommentDetails = $CommentDAO->get_by_Id($postId);

$comment=new Comment();
$comment->id=$CommentDetails[0]->id;
$comment->photograph_id=$CommentDetails[0]->photograph_id;
$comment->author=$CommentDetails[0]->author;
$comment->body=$CommentDetails[0]->body;
$comment->created=$CommentDetails[0]->created;

if($CommentDAO->remove($comment)) {
    echo"Deleted";
} else {
    header("HTTP/1.0 204 Not content");
}

?>
