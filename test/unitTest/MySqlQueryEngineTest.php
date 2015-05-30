<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/19/2015
 * Time: 9:05 AM
 */
use entity\User;
use Interactor\db\MySqlQueryEngine;
use utility\ParseArray;

include_once("D:/wamp/www/phpphotogallery/models/entity/User.php");
include_once("D:/wamp/www/phpphotogallery/models/utility/ParseArray.php");
include_once "D:/wamp/www/phpphotogallery/models/Interactor/db/MySqlQueryEngine.php";
class MySqlQueryEngineTest extends PHPUnit_Framework_TestCase {
    private $mysqlEngine;
    private $user;
    private $userlist;

    /*
     * @before
     * */
    public function setup(){
        $this->mysqlEngine=new MySqlQueryEngine();
        $this->user=new User();
        $this->user->setFirstName("ankit");
        $this->user->setLastName("kie");
        $this->user->setPassword("jpeg");
        $this->user->setUsername("rock");

        //when
        $userObject= ParseArray::doParse($this->user);
        $this->mysqlEngine->create($userObject,"galleryusers");

    }
    public function testFindByID(){
        //when
        $this->userlist=$this->mysqlEngine->find_by_id(1,"galleryusers");
        //then
        $this->assertEquals("rock",$this->userlist[0]->username);
    }
    public function testFindAll(){
        //when
        $this->userlist=$this->mysqlEngine->find_All("galleryusers");
        $actual=count($this->userlist);
        //then
        $this->assertEquals(2,$actual);

    }
    public function testfindby2keyValuePair(){
        //when
        $this->mysqlEngine=new MySqlQueryEngine();
        $this->userlist=$this->mysqlEngine->find_by_Values("username","rock","password","jpeg","galleryusers");
        //then
        $this->assertEquals("rock",$this->userlist[0]->username);
    }
    public function testDeleteEntity(){
        $this->user->id=2;
        $userObject= ParseArray::doParse($this->user);
        $actual=$this->mysqlEngine->delete($userObject,"galleryusers");
        $this->assertEquals(1,$actual);

    }
    public function testSingleValue(){
        //when
        $this->userlist=$this->mysqlEngine->singleValue("id",1,"galleryusers");
        //then
        $this->assertEquals("rock",$this->userlist[0]->username);

    }


    /*
     *
     * @after*/
    public function tearDown(){
        //assert
        $this->mysqlEngine->deleteAll("galleryusers");
         $this->user=new User();
         //defult user
         $this->user->setFirstName("ketan");
         $this->user->setLastName("jain");
         $this->user->setPassword("k123");
         $this->user->setUsername("rock");
         $userObject= ParseArray::doParse($this->user);
         $this->mysqlEngine->create($userObject,"galleryusers");
    }
}
