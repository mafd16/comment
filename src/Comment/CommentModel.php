<?php

namespace Mafd16\Comment;

//use \Anax\Common\AppInjectableTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Mafd16\Comment\Comments;

/**
 * Comment system.
 */
class CommentModel implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;
    //use AppInjectableTrait;

    /**
     * @var array $session inject a reference to the session.
     */
    //private $session;



    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "commentsystem";



    /**
     * Inject dependencies.
     *
     * @param array $dependency key/value array with dependencies.
     *
     * @return self
     */
    public function inject($dependency)
    {
        $this->session = $dependency;//["session"];
        return $this;
    }





    /**
     * Get ALL comments from session
     *
     * @param string $key for data subset.
     *
     * @return object with the dataset
     */
    public function getComments()
    {
        // Using session as storage:
        //$data = $this->session->get($key);
        //return $data;

        // Using db as storage:
        // Get users from db
        $com = new Comments();
        $com->setDb($this->di->get("db"));
        $comments = $com->findAll();

        return $comments;
    }


    /**
     * Get ONE comment from session
     *
     * @param string $key for dataset.
     * @param int    $id for comment.
     *
     * @return array with the comment, name, email, id, or null if not exists
     */
    public function getComment($id)
    {
        // Using session
        // Get all comments
        //$comments = $this->getComments($key);
        // Get comment with id $id
        //$comment = null;
        //foreach ($comments as $key => $val) {
        //    if ($id == $val["id"]) {
        //        $comment = $val;
        //        break;
        //    }
        //}
        //return $comment;

        // Using db
        $comments = $this->getComments();
        // Get comment with id $id
        $comment = null;
        //foreach ($comments as $key => $val) {
        foreach ($comments as $val) {
            if ($id == $val->id) {
                $comment = $val;
                break;
            }
        }
        return $comment;
    }


    /**
     * Add a comment to a dataset.
     *
     * @param array     $post   variables from posted comment
     *                          (article, name, email, comment)
     *
     * @return void
     */
    public function addComment($post)
    {
        // Connect to db
        $com = new Comments();
        $com->setDb($this->di->get("db"));

        $com->UserId = $post["id"];
        $com->UserName = $post["name"];
        $com->UserEmail = $post["email"];
        $com->comment = $post["comment"];

        $com->save();

        // Using session
        //$item = array("user_id"=>$post["id"], "name"=>$post["name"], "email"=>$post["email"], "comment"=>$post["comment"]);
        //$key = $post["article"];

        //if ($this->app->session->has($key)) {
        //if ($this->session->has($key)) {
            //$dataset = $this->session->get($key);
            // Get max value for the id
            //$max = 0;
            //foreach ($dataset as $val) {
            //    if ($max < $val["id"]) {
            //        $max = $val["id"];
            //    }
            //}
            //$item["id"] = $max + 1;
            //$dataset[] = $item;
        //} else {
        //    $item["id"] = 1;
        //    $dataset = array($item);
        //};
        //$this->session->set($key, $dataset);
    }


    /**
     * Update old comment with new comment
     *
     * @param string    $comKey     for the dataset
     * @param int       $id         id for comment
     * @param array     $comment    the comment-array (name, email, comment, id)
     *
     * @return void
     */
    public function updateComment($id, $comment)
    {
        // Connect to db
        $com = new Comments();
        $com->setDb($this->di->get("db"));
        // Get comment
        $com->find("id", $id);
        // Update comment
        $com->comment = $comment["comment"];
        // Save
        $com->save();

        // Using session
        // Get all the comments
        //$comments = $this->getComments($comKey);
        // Replace old comment with new
        //foreach ($comments as $key => $value) {
        //    if ($value["id"] == $id) {
        //        $comments[$key] = $comment;
        //        break;
        //    }
        //}
        // Update session
        //$this->session->set($comKey, $comments);
    }


    /**
     * Delete comment with key and id
     *
     * @param string $keyDataset    for the dataset
     * @param int    $id            to delete
     *
     * @return void
     */
    public function deleteComment($id)
    {
        // Connect to db
        $com = new Comments();
        $com->setDb($this->di->get("db"));
        // Get comment
        $com->find("id", $id);
        // Delete (Update) comment
        $com->deleted = date("Y-m-d H:i:s");
        // Save
        $com->save();


        // Using session
        //$dataset = $this->getComments($keyDataset);
        // Find the comment if it exists
        //foreach ($dataset as $key => $val) {
        //    if ($id == $val["id"]) {
        //        unset($dataset[$key]);
        //        break;
        //    }
        //}
        //$this->app->session->set($keyDataset, $dataset);
        //$this->session->set($keyDataset, $dataset);
    }



    /**
     * Save (the modified) comment dataset.
     *
     * @param string $key     for the dataset.
     * @param string $dataset the data to save.
     *
     * @return self
     */
    //public function saveComments($dataset)
    //{
        //$this->session->set($key, $dataset);
        //return $this;
    //}
}
