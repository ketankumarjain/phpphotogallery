<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/27/2015
 * Time: 1:25 PM
 */

namespace Interactor;
require_once dirname(__DIR__)."/../config/Auto_load.php";


class UsersDAO extends DAO {
    /**
     * @param \Interactor\DBGetway $
     */
    public function __construct(DBGetway $db){
       $this->db=$db;
        $this->table_name="galleryusers";
    }


    public  function authenticate($user="", $pass="") {
        $username = $user;
        $password =$pass;

        $result_object = $this->db->find_User($username, $password,$this->table_name);
        return $result_object;
    }



}
/*$user=new User();
$user->setUsername("hitesh");
$user->setPassword("h123");
$user->setFirstName("ok");
$user->setLastName("jain");
//when
$Userdao=new UsersDAO(new MySqlQueryEngine());
$Userdao->Insert($user);*/

?>