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
    public function __construct(DBGetway $db){
        $this->db=$db;
        $this->table_name="comments";
    }
    public  function getComments_by($photoId){

       $result=$this->db->findBySingleValue("photograph_id",$photoId,$this->table_name);
        return $result;
    }
    public function remove_comments($photoId){
        $result=$this->db->removeBySingleValue("photograph_id",$photoId,$this->table_name);
        return $result;

    }
}

?>