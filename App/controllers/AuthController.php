<?php

namespace App\controllers;

require_once "core/Controller.php";
require_once "models/User.php";

use App\core\Controller;
use App\models\User;

class AuthController extends Controller {
    public User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLoginPage() {
        // GET /login
        // Shows the login page
        // If user is logged in, redirect to notes (user) or users list (admin)

        if (isset($_SESSION["userId"])) {
            $this->defaultRedirect();
        }
        else {
            $this->view("auth/login");
        }
    }

    public function showRegisterPage() {
        // GET /register
        // Shows the registration page
        // If user is logged in, redirect to notes (user) or users list (admin)

        if (isset($_SESSION["userId"])) {
            $this->defaultRedirect();
        }
        else {
            $this->view("auth/register");
        }
    }

    public function login() {
        // POST /login
        // Receives user credentials (email, password)
        // If credentials are valid, redirects to notes (user) or users list (admin) and starts session
        // Otherwise, redirect to login page with error

        if (isset($_SESSION["userId"])) {
            $this->defaultRedirect();
        }
        else if (isset($_POST["email"]) && isset($_POST["password"])) {
            if (!User::isEmailValid($_POST["email"])) {
                $_SESSION["error"] = "Email invalid!";
            }
            else {
                $userSameEmail = $this->userModel->select(["id", "name", "password", "is_admin"])->where([["email", "=", $_POST["email"]]])->fetch();
                if (!$userSameEmail || !password_verify($_POST["password"], $userSameEmail["password"])) {
                    $_SESSION["error"] = "Invalid credentials!";
                }
                else {
                    $_SESSION["userId"] = $userSameEmail["id"];
                    $_SESSION["name"] = $userSameEmail["name"];
                    $_SESSION["isAdmin"] = $userSameEmail["is_admin"];

                    if ($_SESSION["isAdmin"]) {
                        $this->redirectTo("/users");
                    }
                    else {
                        $this->redirectTo("/notes");
                    }
                }
            }
        }
        else {
            $_SESSION["error"] = "All fields must be filled!";
        }

        $this->redirectTo("/login");
    }

    public function register() {
        // POST /register
        // Receives new user data (name, email, password)
        // If email is unique and all data are valid, creates new user and redirects to login page
        // Otherwise, redirect to registration page with error

        if (isset($_SESSION["userId"])) {
            $this->defaultRedirect();
        }
        else if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            // validation
            $name = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $_POST["name"])));
            if (!User::isNameValid($name)) {
                $_SESSION["error"] = "Name invalid!";
            }
            else {
                if (!User::isEmailValid($_POST["email"])) {
                    $_SESSION["error"] = "Email invalid!";
                }
                else {
                    $userSameEmail = $this->userModel->select(["id"])->where([["email", "=", $_POST["email"]]])->fetch();
                    if ($userSameEmail) {
                        $_SESSION["error"] = "Email has already been taken!";
                    }
                    else {
                        if (!User::isPasswordValid($_POST["password"])) {
                            $_SESSION["error"] = "Password invalid!";
                        }
                        else {
                            $this->userModel->create([
                                "name" => $name, 
                                "email" => $_POST["email"], 
                                "password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
                            ])->execute();

                            if (!$this->userModel->checkRowCount()) {
                                $_SESSION["error"] = "Registration failed!";
                            }
                            else {
                                $this->redirectTo("/login");
                            }
                        }
                    }
                }
            }
        }
        else {
            $_SESSION["error"] = "All fields must be filled!";
        }

        $this->redirectTo("/register");
    }

    public function logout() {
        // POST /logout
        // invalidates session

        session_destroy();

        $this->redirectTo("/");
    }
}

?>