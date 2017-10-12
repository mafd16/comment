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
            $user->admin = isset($newUser->admin) ? $newUser->admin : 0;
            //$user->admin = 0;
            // Save to database
            $user->save();
            return $user;
        }
    }


    /**
     * Save a user to session. (Should maybe be called loginUser)
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
     * @param string $key corresponding to a column in the table User
     * @param mixed $value the value of the key
     *
     * @return object $user the user object
     */
    public function getUserFromDatabase($key, $value)
    {
        // Connect to db
        $user = new User();
        $user->setDb($this->di->get("db"));
        // Get the user
        $user->find($key, $value);
        return $user;
    }


    /**
     * Update a user in the database
     *
     * @param int $id the id of the user
     * @param object $update user object with new values
     *
     * @return object $user the user object
     */
    public function updateUserInDatabase($id, $update)
    {
        // Connect to db
        $user = new User();
        $user->setDb($this->di->get("db"));
        // Get the user
        $user->find("id", $id);
        // Update $user:
        $user->email = $update->email;
        if (isset($update->password)) {
            $user->setPassword($update->password);
        }
        $user->updated = date("Y-m-d H:i:s");
        if (isset($update->admin)) {
            $user->admin = $update->admin;
        }
        // Save to database
        $user->save();
        return $user;
    }


    /**
     * Logout user from session
     *
     * @return void
     */
    public function logoutUser()
    {
        // Unset session-key user
        $this->di->get("session")->delete("my_user_id");
        $this->di->get("session")->delete("my_user_name");
        //$this->di->get("session")->delete("my_user_password");
        $this->di->get("session")->delete("my_user_email");
        //$this->di->get("session")->delete("my_user_created");
        //$this->di->get("session")->delete("my_user_updated");
        //$this->di->get("session")->delete("my_user_deleted");
        //$this->di->get("session")->delete("my_user_active");
        $this->di->get("session")->delete("my_user_admin");
    }


    /**
     * Delete user
     * (Set $user->deleted to timestamp)
     *
     * @param int $id the id of the user to delete
     *
     * @return object $user the deleted useer
     */
    public function deleteUser($id)
    {
        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $id);
        // Delete user (Set Deleted to timestamp)
        $user->deleted = date("Y-m-d H:i:s");
        $user->save();
        return $user;
    }
}
