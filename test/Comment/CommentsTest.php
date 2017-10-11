<?php

namespace Mafd16\Comment;

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
    protected $com;
    //protected $userCon;
    //protected $post;

    /**
     * Setup before each testcase
     */
    public function setUp()
    {
        $this->di  = new \Anax\DI\DIFactoryConfig("../test/diTest.php");

        //$this->userCon = new UserController();
        //$this->userCon->setDI($this->di);

        $this->com = new Comments();
        $this->com->setDb($this->di->get("db"));

        //$this->user->acronym = "marton";
        //$this->user->password = password_hash("testpassword", PASSWORD_DEFAULT);
        //$this->user->save();
    }

    /**
     * Assert that object is an instance.
     */
    public function testCreate()
    {
        $this->assertInstanceOf("Mafd16\Comment\Comments", $this->com);
    }
}
