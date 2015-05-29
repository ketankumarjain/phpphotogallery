<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/26/2015
 * Time: 11:28 AM
 */

require_once dirname(__DIR__)."/../config/Auto_load.php";

use entity\User;
use Interactor\db\InMomoryDatabase;
use Interactor\UsersDAO;

class UsersDAOTest extends PHPUnit_Framework_TestCase {

    /**
 *  @test
 */
    public function FindAll(){
        //given
        $users=new \Interactor\UsersDAO(new InMomoryDatabase());
        //when
        $userlist=$users->getAll();
        print_r($userlist);
        //then
       $this->assertEquals(1,count($userlist));
    }
    public function testFindById(){
        //given
        $users=new UsersDAO(new InMomoryDatabase());
        //when
        $userlist=$users->get_by_Id(1);
        print_r($userlist);
        //then
        $this->assertEquals(1,$userlist->id);
    }
    public function testUserAuthenticate(){
        //given
        $users=new UsersDAO(new InMomoryDatabase());
        //when
        $actualuser=$users->authenticate("rock","k123");
        //then
        $this->assertEquals("jain",$actualuser->getLastName());
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage No Content Found
     */
    public function testUserAuthenticateWhenWrong(){
        //given
        $users=new UsersDAO(new InMomoryDatabase());
        //when
        $actualuser=$users->authenticate("rocks","k1s23");

    }

}
