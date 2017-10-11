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
     * @param array $newUser the values of the new user.
     *
     * $newUser = [
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
     * @return boolean true if acronym unique, false otherwise.
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
            return true;
        }
    }
}
