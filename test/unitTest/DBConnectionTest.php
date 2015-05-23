<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/19/2015
 * Time: 10:35 AM
 */
include_once("../../models/Interactor/db/DBConnection.php");

class DBConnectionTest extends PHPUnit_Framework_TestCase {
    public function testDBConnection(){
        //given
        $connection="";
        //when
        $connection=\Interactor\DBConnection::getInstance()->getConnection();
        //then
        $this->assertTrue($connection->select_db("photo_gallery"));

    }

}
