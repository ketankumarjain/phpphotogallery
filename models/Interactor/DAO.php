<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/27/2015
 * Time: 9:21 AM
 */

namespace Interactor;

//DAO -database access object
use utility\ParseArray;
include_once "D:/wamp/www/phpphotogallery/models/utility/ParseArray.php";
abstract class DAO {
    protected  $table_name="";
    protected  $db;
    function __construct(DBGetway $db)
    {
        $this->db=$db;

    }
    public  function getAll() {
        return $this->db->find_All($this->table_name);
    }
    public   function get_by_Id($id=0) {
        return $this->db->find_by_id($id,$this->table_name);
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
