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
