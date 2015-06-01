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

    const tablename = "galleryusers";

    const userNameKey = "username";

    const passwordkey = "password";

    public function __construct(DBGetway $db){
       $this->db=$db;
        $this->table_name= self::tablename;
    }
    public  function authenticate($user, $pass) {
        $username = $user;
        $password =$pass;
        //code smell
        $results = $this->db->find_by_Values(self::userNameKey,$username, self::passwordkey,$password,$this->table_name);
        if($results==null)
            throw new Exception("No Content Found");
        return $results;
    }
}

?>