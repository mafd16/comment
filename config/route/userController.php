<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "User Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["userController", "getIndex"],
        ],
        [
            "info" => "Login a user.",
            "requestMethod" => "get",//|post",
            "path" => "login",
            "callable" => ["userController", "getLogin"],
        ],
        [
            "info" => "validate user",
            "requestMethod" => "post",
            "path" => "validate",
            "callable" => ["userController", "validateUser"],
        ],
        [
            "info" => "Create a user.",
            "requestMethod" => "get",
            "path" => "create",
            "callable" => ["userController", "getCreateUser"],
        ],
        [
            "info" => "Creating a user.",
            "requestMethod" => "post",
            "path" => "creating",
            "callable" => ["userController", "postCreatingUser"],
        ],
        [
            "info" => "User profile.",
            "requestMethod" => "get",
            "path" => "profile",
            "callable" => ["userController", "getUserProfile"],
        ],
        [
            "info" => "Update user profile.",
            "requestMethod" => "get",
            "path" => "update",
            "callable" => ["userController", "updateGetUserProfile"],
        ],
        [
            "info" => "Updating user profile.",
            "requestMethod" => "post",
            "path" => "change",
            "callable" => ["userController", "updatePostUserProfile"],
        ],
        [
            "info" => "Logout a user.",
            "requestMethod" => "get",//|post",
            "path" => "logout",
            "callable" => ["userController", "getLogout"],
        ],
        [
            "info" => "Admin handle users",
            "requestMethod" => "get",
            "path" => "admin",
            "callable" => ["userController", "getAdmin"],
        ],
        [
            "info" => "Admin get update user",
            "requestMethod" => "get",
            "path" => "admin/update",
            "callable" => ["userController", "getAdminUpdateUser"],
        ],
        [
            "info" => "Admin post update user",
            "requestMethod" => "post",
            "path" => "admin/updating",
            "callable" => ["userController", "postAdminUpdateUser"],
        ],
        [
            "info" => "Admin delete user",
            "requestMethod" => "get",
            "path" => "admin/delete",
            "callable" => ["userController", "getAdminDeleteUser"],
        ],
        [
            "info" => "Admin create user",
            "requestMethod" => "get",
            "path" => "admin/create",
            "callable" => ["userController", "getAdminCreateUser"],
        ],
        [
            "info" => "Admin creating user",
            "requestMethod" => "post",
            "path" => "admin/creating",
            "callable" => ["userController", "postAdminCreateUser"],
        ],
    ]
];
