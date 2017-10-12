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
        // Add user to db
        $newUser = (object) [
            "acronym" => "charles",
            "password" => "darwin",
            "email" => "charles@darwin",
        ];
        $this->di->get("user")->createUser($newUser);

        $user = $this->di->get("user")->getUserFromDatabase("id", 1);
        $this->assertEquals("charles", $user->acronym);
        $this->assertEquals("charles@darwin", $user->email);
        $this->assertNotEquals("darwin", $user->password);
    }


    /**
     * Test update user in database.
     */
    public function testUpdateUserInDatabase()
    {
        // Add user to db
        $newUser = (object) [
            "acronym" => "charles",
            "password" => "darwin",
            "email" => "charles@darwin",
            "admin" => 1,
        ];
        $this->di->get("user")->createUser($newUser);
        // Update user
        $update = (object) [
            "password" => "darwinist",
            "email" => "charles@darwin.net",
            "admin" => 0,
        ];
        $user = $this->di->get("user")->updateUserInDatabase(1, $update);
        $this->assertEquals("charles@darwin.net", $user->email);
        $this->assertNotNull($user->updated);
        $this->assertTrue($user->verifyPassword("charles", "darwinist"));
        $this->assertEquals(0, $user->admin);
    }


    /**
     * Test logout user from session.
     */
    public function testLogoutUser()
    {
        // Create user
        $user = (object) [
            "id" => 1,
            "acronym" => "Kalle Anka",
            "email" => "kalle@ankeborg",
            "admin" => 1,
        ];
        // login user
        $this->di->get("user")->saveToSession($user);
        // Check user is logged in
        $this->assertEquals("Kalle Anka", $this->di->get("session")->get("my_user_name"));
        $this->assertEquals(1, $this->di->get("session")->get("my_user_id"));
        $this->assertEquals("kalle@ankeborg", $this->di->get("session")->get("my_user_email"));
        $this->assertEquals(1, $this->di->get("session")->get("my_user_admin"));

        // Logout user
        $this->di->get("user")->logoutUser();

        $this->assertNull($this->di->get("session")->get("my_user_name"));
        $this->assertNull($this->di->get("session")->get("my_user_id"));
        $this->assertNull($this->di->get("session")->get("my_user_email"));
        $this->assertNull($this->di->get("session")->get("my_user_admin"));
    }


    /**
     * Test delete user from db.
     * (We are actually only setting $user->deleted to timestamp)
     */
    public function testDeleteUser()
    {
        // Add user to db
        $newUser = (object) [
            "acronym" => "knatte",
            "password" => "fnatte",
            "email" => "tjatte",
            "admin" => 0,
        ];
        $this->di->get("user")->createUser($newUser);
        // Check that user is not already deleted
        $user = $this->di->get("user")->getUserFromDatabase("id", 1);
        $this->assertNull($user->deleted);
        $this->assertEquals("knatte", $user->acronym);
        // Delete user
        $user = $this->di->get("user")->deleteUser($user->id);
        // Check that user is deleted
        $this->assertNotNull($user->deleted);
    }
}
