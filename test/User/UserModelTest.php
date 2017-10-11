<?php

namespace Mafd16\User;

use PHPUnit\Framework\TestCase;
use \Anax\DI\DIFactoryDefault;

/**
 * Test cases for class UserModel.
 */
class UserModelTest extends TestCase
{
    /**
     * Protected variables
     */
    protected $di;
    protected $usermodel;
    protected $user;


    /**
     * Setup before each testcase
     */
    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("../test/diTest.php");

        $this->usermodel = new UserModel();
        $this->usermodel->setDI($this->di);

        /*$this->post = [
            "id" => 1,//This is the user-id.
            "name" => "Martin",
            "email" => "test@gmail.com",
            "comment" => "Hello world"
        ];*/
    }


    /**
     * Create an instance.
     */
    public function testCreate()
    {
        $this->assertInstanceOf("Mafd16\User\UserModel", $this->usermodel);
    }


    /**
     * Test create a user.
     */
    public function testCreateUser()
    {
        $newUser = (object) [
            "acronym" => "charles",
            "password" => "darwin",
            "email" => "charles@darwin",
        ];

        $this->user = $this->di->get("user")->createUser($newUser);

        $this->assertNotFalse($this->user);
        $this->assertInstanceOf("Mafd16\User\User", $this->user);

        $this->user = $this->di->get("user")->createUser($newUser);
        $this->assertFalse($this->user);
    }


    /**
     * Test save user to session.
     */
    public function testSaveToSession()
    {
        $newUser = (object) [
            "acronym" => "charles",
            "email" => "charles@darwin",
            "id" => 1,
            "admin" => 0,
        ];
        $this->di->get("user")->saveToSession($newUser);

        $this->assertEquals("charles", $this->di->get("session")->get("my_user_name"));
        $this->assertEquals(1, $this->di->get("session")->get("my_user_id"));
        $this->assertEquals("charles@darwin", $this->di->get("session")->get("my_user_email"));
        $this->assertEquals(0, $this->di->get("session")->get("my_user_admin"));
    }


    /**
     * Test get user from database.
     */
    public function testGetUserFromDatabase()
    {
        $user = $this->di->get("user")->getUserFromDatabase(1);
        $this->assertEquals("charles", $user->acronym);
        $this->assertEquals("charles@darwin", $user->email);
        $this->assertNotEquals("darwin", $user->password);
    }
}
