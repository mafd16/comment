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
     * Protected variables
     */
    protected $view;
    protected $pageRender;
    protected $request;
    protected $response;
    protected $session;


    /**
     * Set services to variables
     *
     */
    public function setUp()
    {
        $this->view       = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
        $this->request    = $this->di->get("request");
        $this->response   = $this->di->get("response");
        $this->session    = $this->di->get("session");
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
    public function getIndex()
    {
        $title      = "A index page";
        $data = [
            "content" => "An index page",
        ];
        $this->view->add("default2/article", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        $data = [
            "message" => "",
        ];
        $this->view->add("user/crud/login", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        $data = [
            "message" => $message,
        ];
        $this->view->add("user/crud/create", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        // Get POST-variables
        $acronym = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $passwordagain = $this->request->getPost("passwordagain");

        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->getCreateUser($message);
            return;
        }
        $newUser = (object) [
            "acronym" => $acronym,
            "password" => $password,
            "email" => $email,
        ];
        $createdUser = $this->di->get("user")->createUser($newUser);
        if (!$createdUser) {
            $message = "<p>User " . $acronym . " already exists!</p>";
            $this->getCreateUser($message);
            return;
        }
        // Save user to session
        $this->di->get("user")->saveToSession($createdUser);
        // Redirect back to profile
        $this->response->redirect("user/profile");
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
        // Get user from db
        $id = $this->session->get("my_user_id");
        $user = $this->di->get("user")->getUserFromDatabase("id", $id);

        $data = [
            "user" => $user,
        ];
        $this->view->add("user/crud/profile", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        // Get POST-variables
        $acronym = $this->request->getPost("name");
        $password = $this->request->getPost("password");
        // Get the user from DB
        $user = $this->di->get("user")->getUserFromDatabase("acronym", $acronym);

        if ($user->deleted) {
            $title = "A login page";
            $data = [
                "message" => $user->acronym . " were deleted " . $user->deleted,
            ];
            $this->view->add("user/crud/login", $data);
            $this->pageRender->renderPage(["title" => $title]);
        }

        // Validate password against database
        $valid = $user->verifyPassword($acronym, $password);
        // if true, save user id to session and goto profile
        if ($valid) {
            // Save user id to session
            $this->di->get("user")->saveToSession($user);
            $this->response->redirect("user/profile");
        } else {
            // if false goto login
            $title = "A login page";
            $data = [
                "acronym" => $acronym,
                "password" => $password,
                "valid" => $valid,
                "message" => "Name or password was incorrect!",
            ];
            $this->view->add("user/crud/login", $data);
            $this->pageRender->renderPage(["title" => $title]);
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
        // Get user from db
        $id = $this->session->get("my_user_id");
        $user = $this->di->get("user")->getUserFromDatabase("id", $id);
        $data = [
            "user" => $user,
            "message" => $message,
        ];
        $this->view->add("user/crud/update", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        // Get POST-variables
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $passwordagain = $this->request->getPost("passwordagain");

        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->updateGetUserProfile($message);
        }
        // Get user id from session
        $id = $this->session->get("my_user_id");
        // Update user
        $update = (object) [
            "password" => $password,
            "email" => $email,
        ];
        $user = $this->di->get("user")->updateUserInDatabase($id, $update);
        $this->di->get("user")->saveToSession($user);
        // Redirect back to profile
        $this->response->redirect("user/profile");
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
        $this->di->get("user")->logoutUser();
        // Redirect back to login
        $this->response->redirect("user/login");
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
        // Get users from db
        $user = new User();
        $user->setDb($this->di->get("db"));
        $data = [
            "users" => $user->findAll(),
        ];
        $this->view->add("user/admin/index", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        // Get user id from GET variable
        $userId = isset($userId) ? $userId : $this->request->getGet("id");

        $user = $this->di->get("user")->getUserFromDatabase("id", $userId);
        $data = [
            "user" => $user,
            "message" => $message,
        ];
        $this->view->add("user/admin/update", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        // Get POST-variables
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $passwordagain = $this->request->getPost("passwordagain");
        $admin = $this->request->getPost("admin");
        $userId = $this->request->getPost("user_id");
        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->getAdminUpdateUser($message, $userId);
        }
        // Update user
        $update = (object) [
            "password" => $password,
            "email" => $email,
            "admin" => $admin,
        ];
        $this->di->get("user")->updateUserInDatabase($userId, $update);
        // Redirect back to admin page
        $this->response->redirect("user/admin");
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
        $data = [
            "message" => $message,
        ];
        $this->view->add("user/admin/create", $data);
        $this->pageRender->renderPage(["title" => $title]);
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
        // Get POST-variables
        $acronym = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $admin = $this->request->getPost("admin");
        $password = $this->request->getPost("password");
        $passwordagain = $this->request->getPost("passwordagain");
        if ($password !== $passwordagain) {
            $message = "<p>Passwords did not match!</p>";
            $this->getAdminCreateUser($message);
            return;
        }
        // Create new user
        $newUser = (object) [
            "acronym" => $acronym,
            "password" => $password,
            "email" => $email,
            "admin" => $admin,
        ];
        $this->di->get("user")->createUser($newUser);
        // Redirect back to admin
        $this->response->redirect("user/admin");
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
        // Get user to delete from GET variable
        $userToDelete = $this->request->getGet("id");
        // Delete user
        $this->di->get("user")->deleteUser($userToDelete);
        // Redirect back to admin
        $this->response->redirect("user/admin");
    }
}
