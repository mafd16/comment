<?php

namespace Mafd16\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\User\HTMLForm\UserLoginForm;
use \Anax\User\HTMLForm\CreateUserForm;

/**
 * A controller class.
 */
class UserController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "A index page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "content" => "An index page",
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getLogin()
    {
        $title      = "A login page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            //"content" => $form->getHTML(),
            "message" => "",
        ];

        $view->add("user/crud/login", $data);


        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getCreateUser($message = null)
    {
        $title      = "A create user page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        //$form       = new CreateUserForm($this->di);

        //$form->check();

        $data = [
            //"content" => $form->getHTML(),
            "message" => $message,
        ];

        $view->add("user/crud/create", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function postCreatingUser()
    {
        //$title      = "A create user page";
        //$view       = $this->di->get("view");
        //$pageRender = $this->di->get("pageRender");
        $request    = $this->di->get("request");
        $session    = $this->di->get("session");

        // Get POST-variables
        $acronym = $request->getPost("name");
        $email = $request->getPost("email");
        $password = $request->getPost("password");
        $passwordagain = $request->getPost("passwordagain");

        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->getCreateUser($message);
            return;
        }

        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        // Update $user:
        $user->email = $email;
        $user->setPassword($password);
        $user->acronym = $acronym;
        $user->admin = 0;
        // Save to database
        $user->save();
        // Save user to session
        $session->set("my_user_id", $user->id);
        $session->set("my_user_name", $user->acronym);
        $session->set("my_user_email", $user->email);
        $session->set("my_user_admin", $user->admin);
        //$session->set("who", $user);
        // Redirect back to profile
        $this->di->get("response")->redirect("user/profile");
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getUserProfile()
    {
        $title      = "A profile page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $id = $session->get("my_user_id");
        //$id = $my_user->id;
        $user->find("id", $id);

        $data = [
            "user" => $user,
            //"content" => $form->getHTML(),
        ];

        $view->add("user/crud/profile", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function validateUser()
    {
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $request    = $this->di->get("request");
        $session    = $this->di->get("session");

        //$session->set("test", "testing");
        // Connect to database
        $user = new User();
        $user->setDb($this->di->get("db"));
        // Get POST-variables
        $acronym = $request->getPost("name");
        $password = $request->getPost("password");
        // Get the user from DB
        $user->find("acronym", $acronym);

        if ($user->deleted) {
            $title = "A login page";
            $data = [
                "message" => $user->acronym . " were deleted " . $user->deleted,
            ];
            $view->add("user/crud/login", $data);
            $pageRender->renderPage(["title" => $title]);
        }

        // Validate password against database
        $valid = $user->verifyPassword($acronym, $password);
        // if true, save user id to session and goto profile
        if ($valid) {
            // Save user id to session
            $session->set("my_user_id", $user->id);
            $session->set("my_user_name", $user->acronym);
            $session->set("my_user_email", $user->email);
            $session->set("my_user_admin", $user->admin);
            //$session->set("who", $user);
            //$session->set("user", $user);
            $this->di->get("response")->redirect("user/profile");
        } else {
            // if false goto login
            //$this->di->get("response")->redirect("user/login");
            $title = "A login page";
            $data = [
                "acronym" => $acronym,
                "password" => $password,
                "valid" => $valid,
                "message" => "Name or password was incorrect!",
            ];
            $view->add("user/crud/login", $data);
            $pageRender->renderPage(["title" => $title]);
        }
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function updateGetUserProfile($message = null)
    {
        $title      = "Update user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $id = $this->di->get("session")->get("my_user_id");
        $user->find("id", $id);

        //$user = $session->get("my_user");

        $data = [
            "user" => $user,
            "message" => $message,
            //"content" => $form->getHTML(),
        ];

        $view->add("user/crud/update", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function updatePostUserProfile()
    {
        //$title      = "Updating user";
        //$view       = $this->di->get("view");
        //$pageRender = $this->di->get("pageRender");
        $request    = $this->di->get("request");
        $session    = $this->di->get("session");

        // Get POST-variables
        $email = $request->getPost("email");
        $password = $request->getPost("password");
        $passwordagain = $request->getPost("passwordagain");

        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->updateGetUserProfile($message);
        }

        // Get user id from session
        $id = $session->get("my_user_id");
        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $id);
        // Update $user:
        $user->email = $email;
        if (!empty($password)) {
            $user->setPassword($password);
        }
        //$user->acronym = $session->get("user")
        // Save to database
        $user->save();
        // Save to session
        $session->set("my_user_id", $user->id);
        $session->set("my_user_name", $user->acronym);
        $session->set("my_user_email", $user->email);
        $session->set("my_user_admin", $user->admin);
        // Redirect back to profile
        $this->di->get("response")->redirect("user/profile");
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getLogout()
    {
        // Unset session-key user
        $this->di->get("session")->delete("my_user_id");
        $this->di->get("session")->delete("my_user_name");
        $this->di->get("session")->delete("my_user_email");
        $this->di->get("session")->delete("my_user_admin");
        // Redirect back to login
        $this->di->get("response")->redirect("user/login");
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getAdmin()
    {
        $title      = "An admin page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get users from db
        $user = new User();
        $user->setDb($this->di->get("db"));

        $data = [
            "users" => $user->findAll(),
        ];

        $view->add("user/admin/index", $data);
        $pageRender->renderPage(["title" => $title]);
    }




    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getAdminUpdateUser($message = "", $userId = null)
    {
        $title      = "Admin update user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get user id from GET variable
        $userId = isset($userId) ? $userId : $this->di->get("request")->getGet("id");
        //$userId = $this->di->get("request")->getGet("id");

        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $userId);

        $data = [
            "user" => $user,
            "message" => $message,
        ];

        $view->add("user/admin/update", $data);
        $pageRender->renderPage(["title" => $title]);
    }




    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function postAdminUpdateUser()
    {
        //$title      = "Admin updating user";
        //$view       = $this->di->get("view");
        //$pageRender = $this->di->get("pageRender");
        $request    = $this->di->get("request");
        //$session    = $this->di->get("session");

        // Get POST-variables
        $email = $request->getPost("email");
        $password = $request->getPost("password");
        $passwordagain = $request->getPost("passwordagain");
        $admin = $request->getPost("admin");
        $userId = $request->getPost("user_id");

        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->getAdminUpdateUser($message, $userId);
        }

        // Get user id from session
        //$id = $session->get("my_user_id");
        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $userId);
        // Update $user:
        $user->email = $email;
        $user->admin = $admin;
        if (!empty($password)) {
            $user->setPassword($password);
        }
        //$user->acronym = $session->get("user")
        // Save to database
        $user->save();

        // Redirect back to admin page
        $this->di->get("response")->redirect("user/admin");
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getAdminCreateUser($message = null)
    {
        $title      = "Admin create user page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        //$form       = new CreateUserForm($this->di);

        //$form->check();

        $data = [
            //"content" => $form->getHTML(),
            "message" => $message,
        ];

        $view->add("user/admin/create", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function postAdminCreateUser()
    {
        //$title      = "Admin create user page";
        //$view       = $this->di->get("view");
        //$pageRender = $this->di->get("pageRender");
        $request    = $this->di->get("request");
        //$session    = $this->di->get("session");

        // Get POST-variables
        $acronym = $request->getPost("name");
        $email = $request->getPost("email");
        $admin = $request->getPost("admin");
        $password = $request->getPost("password");
        $passwordagain = $request->getPost("passwordagain");

        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->getAdminCreateUser($message);
            return;
        }

        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        // Update $user:
        $user->email = $email;
        $user->setPassword($password);
        $user->acronym = $acronym;
        $user->admin = $admin;
        // Save to database
        $user->save();
        // Redirect back to admin
        $this->di->get("response")->redirect("user/admin");
    }




    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getAdminDeleteUser()
    {
        //$title      = "Delete user";
        //$view       = $this->di->get("view");
        //$pageRender = $this->di->get("pageRender");

        // Get user to delete from GET variable
        $userToDelete = $this->di->get("request")->getGet("id");

        // Get user from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $userToDelete);
        // Delete user (Set Deleted to timestamp)
        //$user->delete($userToDelete);
        $user->deleted = date("Y-m-d H:i:s");
        $user->save();

        // Redirect back to admin
        $this->di->get("response")->redirect("user/admin");
    }
}
