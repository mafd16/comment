<?php

namespace Mafd16\Comment;

use PHPUnit\Framework\TestCase;
use \Anax\DI\DIFactoryDefault;

/**
 * Test cases for class CommentController.
 */
class CommentControllerTest extends TestCase
{
    /**
     * Setup before each testcase
     */
    public function setUp()
    {
        $this->di = new DIFactoryDefault();
    }

    /**
     * Create an object.
     */
    public function testCreate()
    {
        $comcon = new CommentController();
        $this->assertInstanceOf("Mafd16\Comment\CommentController", $comcon);
    }

    /**
     * Inject $di.
     */
    public function testInjectDi()
    {
        $comcon = new CommentController();
        $obj = $comcon->setDI($this->di);
        $this->assertEquals($comcon, $obj);
    }
}
