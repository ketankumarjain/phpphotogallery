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

require_once dirname(__DIR__)."/../../config/Auto_load.php";

class InMemoryDataBase implements  DBGetway {


    private $users=array();

    function __construct(){
        $user=new User();
        //defult user
        $user->setId(1);
        $user->setFirstName("ketan");
        $user->setLastName("jain");
        $user->setPassword("k123");
        $user->setUsername("rock");
        $this->users[$user->getId()]=$user;
    }

    function find_by_id($idNumber, $table_name)
    {
        $item="";
        foreach($this->users as $records){
            if($records->id==$idNumber){
                $item=$records;
            }
            return $item;
        }
    }

    function find_All($table_name="")
    {
        return $this->users;
    }

    function findBySingleValue($key, $value, $table_name)
    {
        $item="";
        foreach($this->users as $records){
            if($records->$key==$value){
                $item=$records;
            }
            return $item;
        }
    }

    public function find_by_Values($key1, $value1, $key2, $value2, $table_name)
    {
        $item="";
        foreach($this->users as $records){
            if($records->$key1==$value1 && $records->$key2=$value2){
                $item=$records;
            }
            return $item;
        }
    }

    public function removeBySingleValue($key, $value, $table_name)
    {
        foreach($this->users as $records){
            if($records->$key==$value){
            }
        }

    }

    function create( $associativeArray, $table_name='')
    {

    }

    function delete($object, $table_name)
    {

    }

    function update($object, $table_name)
    {
        // TODO: Implement update() method.
    }
}

?>