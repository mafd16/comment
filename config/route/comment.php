<?php
/**
 * Routes for the comment system
 */
 return [
     "routes" => [
         [
             "info" => "Route for the comment page",
             "requestMethod" => "get",
             "path" => "comment",
             "callable" => ["comController", "getComments"]
         ],
         [
             "info" => "Route for add comment",
             "requestMethod" => "post",
             "path" => "comment/add",
             "callable" => ["comController", "postComment"]
         ],
         [
             "info" => "Route for delete comment",
             "requestMethod" => "get",
             "path" => "comment/delete",
             "callable" => ["comController", "deleteComment"]
         ],
         [
             "info" => "Route for editing the comment.",
             "requestMethod" => "get",
             "path" => "comment/edit",
             "callable" => ["comController", "getCommentToEdit"]
         ],
         [
             "info" => "Route for posting edited comment",
             "requestMethod" => "post",
             "path" => "comment/edit2",
             "callable" => ["comController", "editComment"]
         ],
     ]
 ];

/**
 * Route for comment page
 */
//$app->router->add("comment", [$app->comController, "getComments"]);

/**
 * Route for add comment
 */
//$app->router->post("comment/add", [$app->comController, "postComment"]);

/**
 * Route for delete comment (Processpage)
 */
//$app->router->get("comment/delete", [$app->comController, "deleteComment"]);

/**
 * Route for edit comment. Where the controller gets the comment
 * and the user edit the comment.
 */
//$app->router->get("comment/edit", [$app->comController, "getCommentToEdit"]);

/**
 * Route for edit2. Where the controller edit the comment and sends the user
 * back to page with comments.
 */
//$app->router->post("comment/edit2", [$app->comController, "editComment"]);
