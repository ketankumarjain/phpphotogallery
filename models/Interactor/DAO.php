<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/27/2015
 * Time: 9:21 AM
 */

namespace Interactor;

/***
 * DAO -database access object this interact with database
 */
use Exception;
use utility\ParseArray;
require_once dirname(__DIR__)."/../config/Auto_load.php";
abstract class DAO {
    protected  $table_name="";
    protected  $db;

    public  function getAll() {
        $result= $this->db->find_All($this->table_name);
        if($result==null)
            throw new Exception("No Content Found");

        return $result;
    }
    public   function get_by_Id($id) {
        $result= $this->db->findBySingleValue("id",$id,$this->table_name);
        if($result==null)
            throw new Exception("No Content Found");
        return $result;
    }
    public  function Insert( $obj){
        $objectarray=ParseArray::doParse($obj);
        return $this->db->create($objectarray,$this->table_name);
    }
    public  function update( $obj){
        $userobjaaray=ParseArray::doParse($obj);
        return $this->db->update($userobjaaray,$this->table_name);
    }
    public  function remove($obj){
        $userobjaaray=ParseArray::doParse($obj);
        return $this->db->delete($userobjaaray,$this->table_name);
    }
}
?>
