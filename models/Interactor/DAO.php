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
        $ass_array= $this->getAss_Array($obj);
        return $this->db->create($ass_array,$this->table_name);
    }
    public  function update( $obj){
        $ass_array= $this->getAss_Array($obj);
        return $this->db->update($ass_array,$this->table_name);
    }
    public  function remove($obj){
        $ass_array= $this->getAss_Array($obj);
        return $this->db->delete($ass_array,$this->table_name);
    }

    /**
     * @param $obj
     * @return array
     */
    private function getAss_Array($obj)
    {
        return ParseArray::doParse($obj);
    }
}
?>
