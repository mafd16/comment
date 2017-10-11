<?php

namespace Mafd16\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 * User model for Comment system.
 */
class UserModel implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;

    /**
     * Variables
     */
    //private $session;


    /**
     * Create a new User.
     * The acronym is unique!
     *
     * @param object $newUser the values of the new user.
     *
     * $newUser = (object) [
     *      acronym => name,
     *      password => hashing in function!,
     *      email => ,
     *      created => timestamp in function,
     *      updated => null,
     *      deleted => null,
     *      active => null,
     *      admin => 0,
     *  ];
     *
     * @return object $user if acronym unique, false otherwise.
     */
    public function createUser($newUser)
    {
        // Connect to db
        $user = new User();
        $user->setDb($this->di->get("db"));

        // Check if acronym already exists,
        if ($user->find("acronym", $newUser->acronym)) {
            return false;
        } else {
            // else create user
            $user->acronym = $newUser->acronym;
            $user->setPassword($newUser->password);
            $user->email = $newUser->email;
            $user->created = date("Y-m-d H:i:s");
            //$user->$updated;
            //$user->$deleted;
            //$user->$active;
            $user->admin = 0;
            // Save to database
            $user->save();
            return $user;
        }
    }


    /**
     * Save a user to session.
     *
     * @param object $user the values of the user.
     *
     * $user = (object) [
     *      acronym => name,
     *      password => hashed,
     *      email => email,
     *      created => timestamp,
     *      updated => null/timestamp,
     *      deleted => null/timestamp,
     *      active => null/timestamp,
     *      admin => 0/1,
     *  ];
     *
     * @return void
     */
    public function saveToSession($user)
    {
        $session = $this->di->get("session");
        // Save user to session
        $session->set("my_user_id", $user->id);
        $session->set("my_user_name", $user->acronym);
        //$session->set("my_user_password", $user->password);
        $session->set("my_user_email", $user->email);
        //$session->set("my_user_created", $user->created);
        //$session->set("my_user_updated", $user->updated);
        //$session->set("my_user_deleted", $user->deleted);
        //$session->set("my_user_active", $user->active);
        $session->set("my_user_admin", $user->admin);
    }


    /**
     * Get a user from the database
     *
     * @param int $id the id of the user
     *
     * @return object $user the user object
     */
    public function getUserFromDatabase($id)
    {
        // Connect to db
        $user = new User();
        $user->setDb($this->di->get("db"));
        // Get the user
        $user->find("id", $id);
        return $user;
    }
}
