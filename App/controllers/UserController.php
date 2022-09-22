<?php

namespace App\controllers;

require_once "core/Controller.php";
require_once "models/User.php";

use App\core\Controller;
use App\models\User;

class UserController extends Controller {
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showAllUsers() {
        // GET /users
        // Shows a list of users
        // Only accessible by admin
        // If user is not authenticated, redirect to login page
        // If user is authenticated but is not admin, redirect to list of notes
        
    }

    public function deleteUser(int $userId) {
        // DELETE /users/<userId>
        // Deletes user with the specified id, redirects to list of users
        // If user is not authenticated, redirect to login page
        // If user is authenticated but is not admin, redirect to list of notes

    }

    public function showProfilePage() {
        // GET /profile
        // Shows a page containing current user data and password change form
        // If user is not authenticated, redirect to login page

    }

    public function changePassword() {
        // PUT /changePassword
        // Changes the password of current authenticated user
        // Redirects to profile page with success message
        // If user is not authenticated, redirect to login page
    }
}

?>