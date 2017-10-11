<?php

namespace Mafd16\Comment;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Comments extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comments";


    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $UserId;
    public $UserName;
    public $UserEmail;
    public $comment;
    public $created;
    public $updated;
    public $deleted;
}
