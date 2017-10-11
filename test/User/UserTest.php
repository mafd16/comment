<?php

namespace Mafd16\User;

use PHPUnit\Framework\TestCase;
use \Anax\DI\DIFactoryDefault;

/**
 * Test cases for class User.
 */
class UserTest extends TestCase
{
    /**
     * Protected variables
     */
    protected $di;
    protected $user;
    protected $userCon;
    protected $post;

    /**
     * Setup before each testcase
     */
    public function setUp()
    {
        $this->di  = new \Anax\DI\DIFactoryConfig("../test/diTest.php");

        $this->userCon = new UserController();
        $this->userCon->setDI($this->di);

        $this->user = new User();
        $this->user->setDb($this->di->get("db"));

        $this->user->acronym = "marton";
        $this->user->password = password_hash("testpassword", PASSWORD_DEFAULT);
        //$this->user->save();
    }

    /**
     * Assert that object is an instance.
     */
    public function testCreate()
    {
        $this->assertInstanceOf("Mafd16\User\User", $this->user);
    }

    /**
     * Test verify password.
     */
    public function testVerifyPassword()
    {
        $bool = $this->user->verifyPassword($this->user->acronym, "testpassword");
        $this->assertEquals(true, $bool);

        $bool = $this->user->verifyPassword($this->user->acronym, "wrongpassword");
        $this->assertEquals($bool, false);
    }

    /**
     *
     */
    public function testSetPassword()
    {
        $this->user->setPassword("newpassword");
        $bool = $this->user->verifyPassword($this->user->acronym, "newpassword");
        $this->assertEquals(true, $bool);
    }
}
