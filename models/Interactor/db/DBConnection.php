<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/26/2015
 * Time: 11:47 AM
 */
namespace Interactor;
use DBConfig;
include_once "D:/wamp/www/phpphotogallery/config/DBConfig.php";

class DBConnection {
    private $connection;
    private static $_instance;
    //The single instance
    /*
     Get an instance of the Database
     @return Instance
     */


    public static function getInstance() {
        if(!isset(self::$_instance)){ // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct() {

        $this->connection = new \mysqli(DBConfig::DB_SERVER,DBConfig::DB_USER,DBConfig::DB_PASS,DBConfig::DB_NAME);

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQLServer: " . mysqli_connect_error(),
                E_USER_ERROR);
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }

    // Get mysqli connection
    public function getConnection() {
        return $this->connection;
    }
    public function close_Connection() {
        return $this->connection->close();
    }
}