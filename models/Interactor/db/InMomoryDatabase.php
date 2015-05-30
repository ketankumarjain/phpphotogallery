<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/19/2015
 * Time: 10:38 AM
 */

namespace Interactor\db;


use entity\User;
use Interactor\DBGetway;
use Prophecy\Exception\Exception;

require_once dirname(__DIR__)."/../../config/Auto_load.php";

class InMomoryDatabase implements  DBGetway {


    private $result=array();

    function __construct(){
        $user=new User();
        //defult user
        $user->setId(1);
        $user->setFirstName("ketan");
        $user->setLastName("jain");
        $user->setPassword("k123");
        $user->setUsername("rock");
        $this->result[$user->getId()]=$user;
    }

    function find_by_id($idNumber, $table_name)
    {
        $item="";
        foreach($this->result as $records){
            if($records->id==$idNumber){
                $item=$records;
            }
            return $item;
        }
    }

    function find_All($table_name="")
    {
        return $this->result;
    }

    function countAll($table_name)
    {
                count($this->result);
    }

    function create( $objectAss_In_Array, $table_name='')
    {
    }

    function delete($object, $table_name)
    {
        // TODO: Implement delete() method.
    }

    function update($object, $table_name)
    {
        // TODO: Implement update() method.
    }

    function find_user_query($sql, $table_name = "")
    {
        // TODO: Implement find_user_query() method.
    }

    function find_comment_by_Photo_id($objet, $table)
    {
        // TODO: Implement find_comment_by_Photo_id() method.
    }

    public function removeComment_by_PhotoId($photo_id)
    {

    }

    public function find_User($username, $password, $table_name)
    {
        foreach($this->result as $records){
            if($records->username==$username && $records->password==$password)
                return $records;
        }

    }

    function findBySingleValue($key, $value, $table_name)
    {
        // TODO: Implement findBySingleValue() method.
    }

    public function find_by_Values($key1, $value1, $key2, $value2, $table_name)
    {
        // TODO: Implement find_by_Values() method.
    }

    public function removeBySingleValue($key, $value, $table_name)
    {
        // TODO: Implement removeBySingleValue() method.
    }
}

?>