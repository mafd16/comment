<?php

namespace Mafd16\User;

use PHPUnit\Framework\TestCase;
use \Anax\DI\DIFactoryDefault;

/**
 * Test cases for class UserController.
 */
class UserControllerTest extends TestCase
{
    /**
     * Protected variables
     */
    protected $di;
    protected $usercon;
    //protected $post;

    /**
     * Setup before each testcase
     */
    public function setUp()
    {
        $this->di  = new \Anax\DI\DIFactoryConfig("../test/diTest.php");
        $this->usercon = new UserController();
        $this->usercon->setDI($this->di);
    //    $this->user = new User();
        // $this->commod->setDI($this->di);
    }

    /**
     * Create an object.
     */
    public function testCreate()
    {
        $usercon = new UserController();
        $this->assertInstanceOf("Mafd16\User\UserController", $usercon);
    }

    /**
     * Inject $di.
     */
    public function testInjectDi()
    {
        $usercon = new UserController();
        $obj = $usercon->setDI($this->di);
        $this->assertEquals($usercon, $obj);
    }

    /**
     * getAdminDeleteUser
     */
    /*public function testGetAdminDeleteUser()
    {
        $this->di->get("request")->setGet("id", 1);
        $this->usercon->getAdminDeleteUser();

        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", 1);
        // Delete user (Set Deleted to timestamp)
        $this->assertNotNull($user->deleted);
    }*/
}
