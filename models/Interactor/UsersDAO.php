<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/27/2015
 * Time: 1:25 PM
 */

namespace Interactor;
use Exception;
require_once dirname(__DIR__)."/../config/Auto_load.php";
class UsersDAO extends DAO {

    public function __construct(DBGetway $db){
       $this->db=$db;
        $this->table_name="galleryusers";
    }
    public  function authenticate($user, $pass) {
        $username = $user;
        $password =$pass;
        //code smell
        $results = $this->db->find_by_Values("username",$username,"password",$password,$this->table_name);
        if($results==null)
            throw new Exception("No Content Found");
        return $results;
    }
}

?>