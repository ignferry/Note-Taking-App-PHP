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
        
        if (isset($_SESSION["userId"]) && $_SESSION["isAdmin"]) {
            $users = $this->userModel->selectAll()->where([["is_admin", "=", false]])->fetchAll();
            $this->view("users/index", $users);
        }
        else {
            $this->defaultRedirect();
        }
    }

    public function deleteUser(int $userId) {
        // DELETE /users/<userId>
        // Deletes user with the specified id, redirects to list of users
        // If user is not authenticated, redirect to login page
        // If user is authenticated but is not admin, redirect to list of notes

        if (!isset($_SESSION["userId"])) {
            http_response_code(401);
            die();
        }
        else if (!$_SESSION["isAdmin"]) {
            http_response_code(403);
            die();
        }
        else {
            $toBeDeletedUser = $this->userModel->select(["is_admin"])->where([["id", "=", $userId]])->fetch();
            if (!$toBeDeletedUser) {
                http_response_code(404);
                die();
            }
            else if ($toBeDeletedUser["is_admin"]) {
                http_response_code(405);
            }
            else {
                $this->userModel->delete()->where([["id", "=", $userId]])->execute();
                $this->redirectTo("/users");
            }
        }
    }

    public function showProfilePage() {
        // GET /profile
        // Shows a page containing current logged in user data and password change form
        // If user is not authenticated, redirect to login page

        if (isset($_SESSION["userId"])) {
            $currentUser = $this
                ->userModel
                ->select(["name", "email", "password", "is_admin"])
                ->where([["id", "=", $_SESSION["userId"]]])
                ->fetch();

            if (!$currentUser) {
                http_response_code(500);
                die();
            }
            else {
                $this->view("/users/profile", $currentUser);
            }
        }
        else {
            $this->defaultRedirect();
        }
    }

    public function changePassword() {
        // PUT /changePassword
        // Receives current password, new password, and new password confirmation
        // Changes the password of current authenticated user
        // Redirects to profile page with success message
        // If user is not authenticated, redirect to login page

        if (isset($_SESSION["userId"])) {
            $currentUser = $this
                ->userModel
                ->select(["password"])
                ->where([["id", "=", $_SESSION["userId"]]])
                ->fetch();

            if (!$currentUser) {
                http_response_code(500);
                die();
            }
            else {
                $currentPassword = isset($_POST["currentPassword"]) ? $_POST["currentPassword"] : "";
                $newPassword = isset($_POST["newPassword"]) ? $_POST["newPassword"] : "";
                $newPasswordConfirm = isset($_POST["newPasswordConfirm"]) ? $_POST["newPasswordConfirm"] : "";

                if (!$currentPassword || !$newPassword || !$newPasswordConfirm) {
                    $_SESSION["error"] = "All fields must be filled!";
                    $this->redirectTo("/profile");
                }
                else if ($newPassword != $newPasswordConfirm) {
                    $_SESSION["error"] = "New password does not match with confirmation!";
                    $this->redirectTo("/profile");
                }
                else if (!User::isPasswordValid($newPassword)) {
                    $_SESSION["error"] = "New password invalid!";
                    $this->redirectTo("/profile");
                }
                else if (!password_verify($currentPassword, $currentUser["password"])) {
                    $_SESSION["error"] = "Invalid credentials!";
                    $this->redirectTo("/profile");
                }
                else {
                    $this->userModel->update([
                        "password" => password_hash($newPassword, PASSWORD_BCRYPT)
                    ])->where([["id", "=", $_SESSION["userId"]]])->execute();

                    $_SESSION["success"] = "Password successfully changed";
                    $this->redirectTo("/profile");
                }
            }
        }
        else {
            $this->defaultRedirect();
        }
    }
}

?>