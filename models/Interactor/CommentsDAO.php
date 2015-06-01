<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/17/2015
 * Time: 7:45 AM
 */

namespace Interactor;
require_once dirname(__DIR__)."/../config/Auto_load.php";



class CommentsDAO extends DAO{
    const COMMENTS = "comments";
    const PHOTOGRAPH_ID = "photograph_id";

    public function __construct(DBGetway $db){
        $this->db=$db;
        $this->table_name=  self::COMMENTS;
    }
    public  function getComments_by($photoId){

       $result=$this->db->findBySingleValue(self::PHOTOGRAPH_ID ,$photoId,$this->table_name);
        return $result;
    }
    public function remove_comments($photoId){
        $result=$this->db->removeBySingleValue(self::PHOTOGRAPH_ID,$photoId,$this->table_name);
        return $result;

    }
}

?>