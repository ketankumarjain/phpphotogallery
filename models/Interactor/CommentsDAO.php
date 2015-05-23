<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/17/2015
 * Time: 7:45 AM
 */

namespace Interactor;
include_once("D:/wamp/www/phpphotogallery/models/Interactor/DAO.php");

class CommentsDAO extends DAO{
    public function __construct(DBGetway $db){
        $this->db=$db;
        $this->table_name="comments";
    }
    public  function get_all_comments_by($photoId){
       $result=$this->db->find_comment_by_Photo_id($photoId,$this->table_name);
        return $result;
    }
    public function remove_comments($photoId){
        $result=$this->db->removeComment_by_PhotoId($photoId);
        return $result;

    }
}
/*include_once("../Interactor/db/MySqlQueryEngine.php");
$CommentsDAO=new CommentsDAO(new MySqlQueryEngine());
print_r($CommentsDAO->get_all_comments_by(14));*/

?>