<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "com" => [
            "shared" => true,
            "callback" => function () {
                $com = new \Mafd16\Comment\CommentModel();
                $com->setDI($this);
                return $com;
            }
        ],
        "comController" => [
            "shared" => false,
            "callback" => function () {
                $comController = new \Mafd16\Comment\CommentController();
                $comController->setDI($this);
                return $comController;
            }
        ],
        "user" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\User\UserModel();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\User\UserController();
                $obj->setDI($this);
                $obj->setUp();
                return $obj;
            }
        ],
        "db" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Database\DatabaseQueryBuilder();
                $obj->configure("database.php");
                return $obj;
            }
        ],
    ],
];
