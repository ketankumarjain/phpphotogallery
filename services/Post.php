<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/22/2015
 * Time: 10:21 AM
 *
 */
use entity\Comment;
use Interactor\CommentsDAO;
use Interactor\MySqlQueryEngine;
include_once"../models/Interactor/PhotoGraphDAO.php";
include_once"../models/Interactor/db/MySqlQueryEngine.php";
include_once "../models/utility/CommanFunction.php";
include_once"../models/entity/Comment.php";
$postData = file_get_contents("php://input");
$request = json_decode($postData);
$comment=new Comment();
$comment->photograph_id =$request->photo_id;
$comment->created =date("Y-m-d H:i:s", time());
$comment->author = $request->author;;
$comment->body = $request->comment;;
$commentsDao=new CommentsDAO(new MySqlQueryEngine());
header("Access-Control-Allow-Origin: *");
if($commentsDao->Insert($comment)) {
    header("HTTP/1.0 200 ok");
} else {
    // Failed
    header("HTTP/1.0 204 no content");
}

?>