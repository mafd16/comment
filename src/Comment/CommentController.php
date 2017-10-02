<?php

namespace Mafd16\Comment;

//use \Anax\Common\AppInjectableInterface;
//use \Anax\Common\AppInjectableTrait;
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
    //use AppInjectableTrait;


    /**
     * Get ALL comments from an article.
     *
     * @return void
     */
    //public function getComments($key)
    public function getComments()
    {
        $key = "comPage";
        //$session = $this->di->get("session");
        // Get comments from model
        //$comments = $this->app->com->getComments($key);
        //$comments = $this->di->get("com")->getComments($key);
        $comments = $this->di->get("com")->getComments($key);
        //$comments = $data["comments"];
        //$comments = $data;

        // Add views to a specific region, add comments
        //$this->app->view->add("comment/index", ["comments"=>$comments], "main");
        $this->di->get("view")->add("comment/index", ["comments"=>$comments], "main");
        //$this->di->get("view")->add("comment/index", ["comments"=>$data["comments"]], "main");

        // Render a standard page using layout
        //$this->app->renderPage([
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
        //$comment = $this->app->com->getComment($key, $id);
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
        //$key = "comPage";
        // Get id-variable from request.
        //$id = $this->app->request->getGet("id");
        $id = $this->di->get("request")->getGet("id");
        // Get the comment from Model.
        //$comment = $this->app->com->getComment($key, $id);
        $comment = $this->di->get("com")->getComment($id);
        // Add views to a specific region
        //$this->app->view->add("comment/edit", ["comment"=>$comment], "main");
        $this->di->get("view")->add("comment/edit", ["comment"=>$comment], "main");
        // Render a standard page using layout
        //$this->app->renderPage([
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
        //$post = $this->app->request->getPost();
        $post = $this->di->get("request")->getPost();
        // Instruct Model to edit comment:
        //$comKey = "comPage";
        // Edited comment:
        $comment = [
            "user_id" => $post["user_id"],
            "name" => $post["name"],
            "email" => $post["email"],
            "comment" => $post["comment"],
            "id" => $post["id"]
        ];
        //$this->app->com->updateComment($comKey, $post["id"], $comment);
        $this->di->get("com")->updateComment($post["id"], $comment);
        // Send user back to comment page.
        //$url = $this->app->url->create("comment");
        $url = $this->di->get("url")->create("comment");
        //$this->app->response->redirect($url);
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
        //$this->app->com->addComment($post);
        $this->di->get("com")->addComment($post);
        // Send user back to comment page.
        //$url = $this->app->url->create("comment");
        $url = $this->di->get("url")->create("comment");
        //$this->app->response->redirect($url);
        $this->di->get("response")->redirect($url);
    }


    /**
     * Update old comment with new comment
     *
     * @param string    $key        for the dataset
     * @param int       $id         id for comment
     * @param array     $comment    the comment-array (name, email, comment, id)
     *
     * @return void
     */
    public function updateComment($id, $comment)
    {
        //$this->app->com->updateComment($key, $id, $comment);
        $this->di->get("com")->updateComment($id, $comment);
    }


    /**
     * Delete comment with id
     *
     * @return void
     */
    public function deleteComment()
    {
        //$key = "comPage";
        // Get id-variable from request.
        //$id = $this->app->request->getGet("id");
        $id = $this->di->get("request")->getGet("id");
        // Instruct Model to delete comment:
        //$this->app->com->deleteComment($key, $id);
        $this->di->get("com")->deleteComment($id);
        // Send user back to comment page.
        //$url = $this->app->url->create("comment");
        $url = $this->di->get("url")->create("comment");
        //$this->app->response->redirect($url);
        $this->di->get("response")->redirect($url);
    }
}
