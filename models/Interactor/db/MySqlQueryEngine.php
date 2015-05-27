<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/27/2015
 * Time: 8:37 AM
 */
namespace Interactor\db;
require_once dirname(__DIR__)."/../../config/Auto_load.php";



use Interactor\DBGetway;
use entity\User;

class MySqlQueryEngine implements DBGetway
{
    private $db;
    private $objList=array();
    private $last_query;

    function __construct()
    {
        $this->db = DBConnection::getInstance()->getConnection();

    }

    public function find_by_id($id, $table_name)
    {

        if ($result = mysqli_query($this->db, "SELECT * FROM ".$table_name." WHERE id={$id} LIMIT 1")) {
            while ($object = $this->getObjects($result)) {
                array_push($this->objList,$object);
            }
        }else{
            $this->confirm_query($result);
        }
        if (!empty($this->objList)) {
            return $this->objList;
        }

    }

    public function find_All($table_name)
    {
        if ($result = mysqli_query($this->db, "SELECT * FROM " . $table_name)) {
            while ($object = $this->getObjects($result)) {
                array_push($this->objList,$object);
            }
        }else{
            $this->confirm_query($result);
        }
        return $this->objList;
    }

    function find_comment_by_Photo_id($photo_id, $table_name)
    {
        $sql = "SELECT * FROM " .$table_name;
        $sql .= " WHERE photograph_id=" .$photo_id;
        $sql .= " ORDER BY created ASC";
        if ($result = mysqli_query($this->db,$sql)) {
            while ($object = $this->getObjects($result)) {
                array_push($this->objList,$object);
            }
        }else{
            $this->confirm_query($result);
        }
        return $this->objList;

    }

    public   function find_User($username, $password,$table_name)
    {
        $sql="select * from ".$table_name." where username='{$username}' AND password='{$password}' LIMIT 1";
        if ($result = mysqli_query($this->db,$sql)) {
            while ($object = $this->getObjects($result)) {
                array_push($this->objList,$object);
            }
        }else{
            $this->confirm_query($result);
        }
        return $this->objList;    }


    function countAll($table_name)
    {
        // TODO: Implement countAll() method.
    }

    function create($objectArray, $table_name)
    {

        $sql = "INSERT INTO ".$table_name." (";
        $sql .= join(", ", array_keys($objectArray));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($objectArray));
        $sql .= "')";
        return $this->query($sql);


    }

    function delete($object, $table_name)
    {
        $sql = "DELETE FROM ".$table_name;
        $sql .= " WHERE id=".$object["id"];
        $sql .= " LIMIT 1";
        $this->query($sql);
        return ($this->affected_rows($this->db) == 1) ? true : false;

    }

    public function removeComment_by_PhotoId($photo_id)
    {
        $sql = "DELETE FROM comments";
        $sql .= " WHERE photograph_id=".$photo_id;
        $this->query($sql);
        return ($this->affected_rows($this->db) >= 1) ? true : false;
    }

    function update($attributes, $table_name)
    {
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $attributes["id"];
        $this->query($sql);
        return ($this->affected_rows($this->db) == 1) ? true : false;
    }

    public function  find_user_query($sql,$table="")
    {
        $result_set = $this->query($sql);
        // $object_array = array();
        if($this->query($sql)) {
            $user = new User();
            $objectarra = $this->fetch_array($result_set);
            $user->setId($objectarra['id']);
            $user->setUsername($objectarra['username']);
            $user->setPassword($objectarra['password']);
            $user->setFirstname($objectarra['first_name']);
            $user->setLastName($objectarra['last_name']);
            return $result_set == false ? false : $user;
        }
    }
    private function query($sql)
    {
        $this->last_query = $sql;
        $result = mysqli_query($this->db,$sql);
        $this->confirm_query($result);
        return $result;
    }

    // "mysql-database-specific" methods

    public function fetch_array($result_set)
    {
        return mysqli_fetch_assoc($result_set);
    }

    public function getObjects($result_set)
    {
        return mysqli_fetch_object($result_set);
    }
    public function affected_rows($Dbconnecction)
    {
        return mysqli_affected_rows($Dbconnecction);
    }
    public function insert_id()
    {
        // get the last id inserted over the current db connection
        return mysqli_insert_id(DBConnection::getInstance()->getConnection());
    }

    public  function deleteall($tablename){
        $this->query("TRUNCATE TABLE ".$tablename);
    }

    private function confirm_query($result) {
        if (!$result) {
            $output = "Database query failed: " . mysqli_error($this->db) . "<br /><br />";
            //$output .= "Last SQL query: " . $this->last_query;
            die( $output );
        }
    }
}

?>

