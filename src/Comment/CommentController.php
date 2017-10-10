<?php

namespace Mafd16\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A controller for the Comment System.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
//class CommentController implements AppInjectableInterface
class CommentController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * Get ALL comments from an article.
     *
     * @return void
     */
    public function getComments()
    {
        $key = "comPage";
        // Get comments from model
        $comments = $this->di->get("com")->getComments($key);
        // Add views to a specific region, add comments
        $this->di->get("view")->add("comment/index", ["comments"=>$comments], "main");
        // Render a standard page using layout
        $this->di->get("pageRender")->renderPage(["title" => "Kommentarssystem"]);
    }


    /**
     * Get ONE comment from an article.
     *
     * @param string $key for the article
     * @param int    $id for the comment id
     *
     * @return void
     */
    public function getComment($id)
    {
        $comment = $this->di->get("com")->getComment($id);
        return $comment;
    }


    /**
     * Get ONE comment for editing.
     *
     * @return void
     */
    public function getCommentToEdit()
    {
        $id = $this->di->get("request")->getGet("id");
        // Get the comment from Model.
        $comment = $this->di->get("com")->getComment($id);
        // Add views to a specific region
        $this->di->get("view")->add("comment/edit", ["comment"=>$comment], "main");
        // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Redigera kommentar",
        ]);
    }


    /**
     * Edit a comment.
     *
     * @return void
     */
    public function editComment()
    {
        // Get post-variables
        $post = $this->di->get("request")->getPost();
        // Instruct Model to edit comment:
        // Edited comment:
        $comment = [
            "user_id" => $post["user_id"],
            "name" => $post["name"],
            "email" => $post["email"],
            "comment" => $post["comment"],
            "id" => $post["id"]
        ];
        $this->di->get("com")->updateComment($post["id"], $comment);
        // Send user back to comment page.
        $url = $this->di->get("url")->create("comment");
        $this->di->get("response")->redirect($url);
    }



    /**
     * Post a comment, with name and email.
     *
     * @return void
     */
    public function postComment()
    {
        // Catch post variables
        $post = $this->di->get("request")->getPost();
        // Instruct Model to add comment:
        $this->di->get("com")->addComment($post);
        // Send user back to comment page.
        $url = $this->di->get("url")->create("comment");
        $this->di->get("response")->redirect($url);
    }


    /**
     * Update old comment with new comment
     *
     * @param int       $id         id for comment
     * @param array     $comment    the comment-array (name, email, comment, id)
     *
     * @return void
     */
    public function updateComment($id, $comment)
    {
        $this->di->get("com")->updateComment($id, $comment);
    }


    /**
     * Delete comment with id
     *
     * @return void
     */
    public function deleteComment()
    {
        // Get id-variable from request.
        $id = $this->di->get("request")->getGet("id");
        // Instruct Model to delete comment:
        $this->di->get("com")->deleteComment($id);
        // Send user back to comment page.
        $url = $this->di->get("url")->create("comment");
        $this->di->get("response")->redirect($url);
    }
}
