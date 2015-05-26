<?php
/**
 * Created by PhpStorm.
 * User: ketan
 * Date: 5/26/2015
 * Time: 11:18 AM
 */

namespace intgrationTest;

use entity\User;
use Interactor\MySqlQueryEngine;
use Interactor\UsersDAO;

include_once "../../models/Interactor/UsersDAO.php";
include_once "../../models/Interactor/PhotoGraphDAO.php";
include_once"../../models/entity/User.php";
include_once "../../models/Interactor/db/MySqlQueryEngine.php";
include_once"../../models/utility/ParseArray.php";

class UsersDAOTest extends \PHPUnit_Framework_TestCase {

    private $users;
    private $user;
    /*
     * @before
     * */
    public function setup(){
        $this->users=new UsersDAO(new MySqlQueryEngine());
        $this->user=new User();
        $this->user->setFirstName("ankit");
        $this->user->setLastName("kie");
        $this->user->setPassword("jpeg");
        $this->user->setUsername("rock");
        //when
        $this->users->Insert($this->user,"galleryusers");

    }
    public function testFindAll(){
        //given
        //when
        $userlist=$this->users->getAll();
        //then
        $this->assertEquals(2,count($userlist));
    }
    public function testFindById(){
        //given
        //when
        $userlist=$this->users->get_by_Id(1);
        //then
        $this->assertEquals(1,$userlist[0]->id);
    }

    /*
     *
     * @after*/
    public function tearDown(){
        //assert

        $db=new MySqlQueryEngine();
        $db->deleteall("galleryusers");
        $this->user=new User();
        //defult user
        $this->user->setFirstName("ketan");
        $this->user->setLastName("jain");
        $this->user->setPassword("k123");
        $this->user->setUsername("rock");
        $this->users->Insert($this->user,"galleryusers");
    }
}
