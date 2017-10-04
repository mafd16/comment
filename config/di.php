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
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\User\UserController();
                $obj->setDI($this);
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
