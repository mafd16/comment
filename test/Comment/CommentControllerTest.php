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
     * Protected variables
     */
    protected $di;
    protected $comcon;
    protected $post;
    protected $commod;


    /**
     * Setup before each testcase
     */
    public function setUp()
    {
        //$this->di = new DIFactoryDefault();
        $this->di = new \Anax\DI\DIFactoryConfig("../test/diTest.php");

        $this->comcon = new CommentController();
        $this->comcon->setDI($this->di);

        $this->commod = new CommentModel();
        $this->commod->setDI($this->di);

        $this->post = [
            "id" => 1,//This is the user-id.
            "name" => "Martin",
            "email" => "test@gmail.com",
            "comment" => "Hello you"
        ];
    }

    /**
     * Assert instance of an object.
     */
    public function testInstance()
    {
        $this->assertInstanceOf("Mafd16\Comment\CommentController", $this->comcon);
    }

    /**
     * Test get comment.
     */
    public function testGetComment()
    {
        $this->commod->addComment($this->post);
        $id = count($this->commod->getComments());

        $comment = $this->comcon->getComment($id);
        //print_r($comment);
        $this->assertEquals("Hello you", $comment->comment);
        $this->assertInstanceOf("Mafd16\Comment\Comments", $comment);
    }

    /**
     * Test updateComment.
     */
    public function testUpdateComment()
    {
        // First add comment
        $this->commod->addComment($this->post);
        //$this->commod->addComment($this->post);
        $id = count($this->commod->getComments());
        $comment = $this->comcon->getComment($id);
        //assertfalse
        $this->assertNotEquals(2, $comment->UserId);
        $this->assertNotEquals("marton", $comment->UserName);
        $this->assertNotEquals("testupdatecomment", $comment->UserEmail);
        $this->assertNotEquals("batman", $comment->comment);
        //update comment
        $this->post = [
            "user_id" => 2,//This is the user-id.
            "name" => "marton",
            "email" => "testupdatecomment",
            "comment" => "batman"
        ];
        $this->comcon->updateComment($id, $this->post);
        //get comment
        $newComment = $this->comcon->getComment($id);
        // assert true
        //$this->assertEquals(2, $newComment->UserId);
        //$this->assertEquals("marton", $newComment->UserName);
        //$this->assertEquals("testupdatecomment", $newComment->UserEmail);
        $this->assertEquals("batman", $newComment->comment);
    }



    /**
     * Inject $di.
     */
    //public function testInjectDi()
    //{
        //$comcon = new CommentController();
        //$obj = $comcon->setDI($this->di);
        //$this->assertEquals($comcon, $obj);
    //    $obj = $comcon->setDI($this->di);
    //    $this->assertEquals($comcon, $obj);
    //}
}
