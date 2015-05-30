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
class MySqlQueryEngine implements DBGetway
{
    private $db;
    private $last_query;

    function __construct()
    {
        $this->db = DBConnection::getInstance();

    }

    public function find_by_id($id, $table_name)
    {
        $query = "SELECT * FROM " . $table_name . " WHERE id={$id} LIMIT 1";
        $objects= $this->getResult($query);
        return $objects;
    }

    public function find_All($table_name)
    {
        $query = "SELECT * FROM " . $table_name;
        return $this->getResult($query);
    }

    public   function find_User($username, $password,$table_name)
    {
        $query="select * from ".$table_name." where username='{$username}' AND password='{$password}' LIMIT 1";
        return $this->getResult($query);
    }

    function find_comment_by_Photo_id($photo_id, $table_name)
    {
        $sql = "SELECT * FROM " .$table_name;
        $sql .= " WHERE photograph_id=" .$photo_id;
        $sql .= " ORDER BY created ASC";
        return $this->getResult($sql);
    }

    function countAll($table_name)
    {
            throw new \Exception("Not Implemented");
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
    public function get_insert_id()
    {
        return mysqli_insert_id(DBConnection::getInstance()->getConnection());
    }
    public  function deleteall($tablename){
        $this->query("TRUNCATE TABLE ".$tablename);
    }

    //private

    private function query($sql)
    {
        $this->last_query = $sql;
        $result = mysqli_query($this->db->getConnection(),$sql);
        $this->confirm_query($result);
        return $result;
    }
    private function confirm_query($result) {
        if (!$result) {
            $output = "Database query failed: " .$this->db->getConnection()->error;
            die( $output );
        }
    }
    private function getResult($query)
    {
        if ($result = $this->db->getConnection()->query($query)) {
           $objects= $this->iterate($result);

            return $objects;

        } else {
            $this->confirm_query($result);
        }
    }
    private function iterate($result)
    {
        $objects =array();
        while ($object = $this->getObjects($result))
            array_push($objects, $object);
        return $objects;
    }
}

?>

