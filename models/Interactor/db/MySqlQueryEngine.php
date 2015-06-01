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
    public function findBySingleValue($key,$value,$table_name){
        $query = "SELECT * FROM " . $table_name . " WHERE {$key}={$value}";
        $objects= $this->getResult($query);
        return $objects;
    }
    public function find_by_Values($key1, $value1, $key2, $value2, $table_name)
    {
        $query="select * from ".$table_name." where {$key1}='{$value1}' AND {$key2}='{$value2}' LIMIT 1";
        return $this->getResult($query);
    }

    public function create($associativeArray, $table_name)
    {

        $sql = "INSERT INTO ".$table_name." (";
        $sql .= join(", ", array_keys($associativeArray));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($associativeArray));
        $sql .= "')";
        return $this->query($sql);
    }
    public function delete($associativeArray, $table_name)
    {

        $sql = "DELETE FROM ".$table_name;
        $sql .= " WHERE id=".$associativeArray["id"];
        $sql .= " LIMIT 1";
        return ($this->query($sql)) ? 1 : 0;

    }
    public function update($associativeArray, $table_name)
    {
        $attribute_pairs = array();
        foreach($associativeArray as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $associativeArray["id"];
        return ($this->query($sql)) ? true : false;
    }

    //mysql specific query
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
    public  function deleteAll($tablename){
        $this->query("TRUNCATE TABLE ".$tablename);
    }

    //private
    private function query($sql)
    {
        $this->last_query = $sql;
        $result =$this->executeQuery($sql);
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
        if ($result = $this->executeQuery($query)) {
            return $this->iterate($result);
        } else {                                //code smell
            return $this->confirm_query($result);
        }
    }
    private function iterate($result)
    {
        $objects =array();
        while ($object = $this->getObjects($result))
            array_push($objects, $object);
        return $objects;
    }
    public function removeBySingleValue($key, $value, $table_name)
    {
        $sql = "DELETE FROM{$table_name}";
        $sql .= " WHERE $key=".$value;
        return $this->query($sql);
    }
    /**
     * @param $query
     * @return bool|\mysqli_result
     */
    private function executeQuery($query)
    {
        return $this->db->getConnection()->query($query);
    }
}

?>

