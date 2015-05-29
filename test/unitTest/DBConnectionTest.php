<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/19/2015
 * Time: 10:35 AM
 */
use Interactor\db\DBConnection;

require_once dirname(__DIR__)."/../config/Auto_load.php";

class DBConnectionTest extends PHPUnit_Framework_TestCase {
    public function testDBConnection(){
        //given
        $connection="";
        //when
        $connection= DBConnection::getInstance()->getConnection();
        //then
        $this->assertTrue($connection->select_db("photo_gallery"));

    }

}
