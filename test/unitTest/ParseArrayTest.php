<?php
use entity\Photograph;
use entity\User;
use utility\ParseArray;

/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/28/2015
 * Time: 10:45 AM
 */
require_once dirname(__DIR__)."/../config/Auto_load.php";


class ParseArrayTest extends PHPUnit_Framework_TestCase {

    public function testParsingofUserObject(){
        //given
        $user=new User();
        $user->setFirstName("hitesh");
        $user->setLastName("kie");
        $user->setPassword("jpeg");
        $user->setUsername("rock");
        //when
        $userObject= ParseArray::doParse($user);
        // print_r($userObject);
        //then
        $this->assertEquals("rock",$userObject['username']);
    }

    public function testParsingofPhotoGraph(){
        //given
        $user=new Photograph();
        $user->setFilename("hitesh");
        $user->setsize(12);
        $user->setType("jpeg");
        $user->setCaption("rock");
        //when
        $userObject= ParseArray::doParse($user);
       //  print_r($userObject);
        //then
        $this->assertEquals(12,$userObject['size']);
    }

}
