<?php

namespace Mafd16\Comment;

use PHPUnit\Framework\TestCase;
use \Anax\DI\DIFactoryDefault;

/**
 * Test cases for class CommentController.
 */
class CommentModelTest extends TestCase
{
    /**
     * Protected variables
     */
    protected $di;
    protected $commod;
    protected $post;

    /**
     * Setup before each testcase
     */
    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("../test/diTest.php");

        $this->commod = new CommentModel();
        $this->commod->setDI($this->di);

        $this->post = [
            "id" => 1,//This is the user-id.
            "name" => "Martin",
            "email" => "test@gmail.com",
            "comment" => "Hello world"
        ];
    }

    /**
     * Create an object.
     */
    public function testCreate()
    {
        $this->assertInstanceOf("Mafd16\Comment\CommentModel", $this->commod);
    }

    /**
     * Inject $di.
     */
    public function testInjectDi()
    {
        $commod = new CommentModel();
        $obj = $commod->setDI($this->di);
        $this->assertEquals($commod, $obj);
    }

    /**
     * Add a comment to a dataset.
     * Get comments from a dataset.
     * Get a comment from dataset.
     */
    public function testAddComment()
    {
        $this->commod->addComment($this->post);
        $id = count($this->commod->getComments());
        $comment = $this->commod->getComment($id);
        $this->assertEquals($comment->comment, "Hello world");
    }

    /**
     * Update a comment from a dataset.
     */
    public function testUpdateComment()
    {
        // First, add a comment
        $this->commod->addComment($this->post);
        //$id = count($this->commod->getComments());
        $new = [
            "id" => 1,//This is the user-id.
            "name" => "Martin",
            "email" => "test@gmail.com",
            "comment" => "Hello sweden"
        ];
        $this->commod->updateComment(1, $new);
        $comment = $this->commod->getComment(1);
        $this->assertEquals($comment->comment, "Hello sweden");
    }

    /**
     * Delete a comment from a dataset.
     */
    public function testDeleteComment()
    {
        // First, add a comment
        $this->commod->addComment($this->post);
        // Get the comment, and check it is NOT deleted
        $comment = $this->commod->getComment(1);
        $this->assertNull($comment->deleted);
        // Delete comment
        $this->commod->deleteComment(1);
        $comment = $this->commod->getComment(1);
        $this->assertNotNull($comment->deleted);
    }
}
