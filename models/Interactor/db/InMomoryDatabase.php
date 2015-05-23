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

include_once("../../entity/User.php");
include_once("../DBGetway.php");
class InMomoryDatabase implements  DBGetway {


    private $result=array();

    function __construct(){
        $user=new User();
        //defult user
        $user->setId(1);
        $user->setFirstName("ketan");
        $user->setFirstName("ketan");
        $user->setLastName("jain");
        $user->setPassword("k123");
        $user->setUsername("rock");
        array_push($this->result,$user);
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
        // TODO: Implement find_by_id() method.
    }

    function find_All($table_name="")
    {
        return $this->result;
        // TODO: Implement find_All() method.
    }

    function countAll($table_name)
    {
        // TODO: Implement countAll() method.
    }

    function create($objectAss_Array, $table_name)
    {
        // TODO: Implement create() method.
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
        // TODO: Implement removeComment_by_PhotoId() method.
    }
}
?>