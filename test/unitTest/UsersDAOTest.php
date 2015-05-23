<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 4/26/2015
 * Time: 11:28 AM
 */
include_once "../../models/Interactor/UsersDAO.php";
include_once "../../models/Interactor/PhotoGraphDAO.php";

include_once "../../models/Interactor/db/InMomoryDatabase.php";

use Interactor\db\InMomoryDatabase;
use Interactor\UsersDAO;

class UsersDAOTest extends PHPUnit_Framework_TestCase {
/*
 *  @test
 */
    public function testFindAll(){
        //given
        $users=new \Interactor\UsersDAO(new InMomoryDatabase());
        //when
        $userlist=$users->getAll();
        //then
       $this->assertEquals(1,count($userlist));
    }
    public function testFindById(){
        //given
        $users=new UsersDAO(new InMomoryDatabase());
        //when
        $userlist=$users->get_by_Id(1);
        //then
        $this->assertEquals(1,$userlist->id);
    }
/*    public function testUserAuthenticate(){
        //given
        $users=new UsersDAO(new MySqlQueryEngine());
        //when
        $actualuser=$users::authenticate("kw","kw123");
            print_r($actualuser);
        //then
        $this->assertEquals("rose",$actualuser->getLastName());
    }*/

}
