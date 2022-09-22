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

    }

    public function showRegisterPage() {
        // GET /register
        // Shows the registration page
        // If user is logged in, redirect to notes (user) or users list (admin)
        
    }

    public function login() {
        // POST /login
        // Receives user credentials (email, password)
        // If credentials are valid, redirects to notes (user) or users list (admin)
        // Otherwise, redirect to login page with error

    }

    public function register() {
        // POST /register
        // Receives new user data (name, email, password)
        // If email is unique and all data are valid, creates new user and redirects to login page
        // Otherwise, redirect to registration page with error

    }
}

?>