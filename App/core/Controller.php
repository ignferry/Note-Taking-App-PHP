<?php

namespace App\core;

abstract class Controller {
    protected function view(string $view, array $data = []): void {
        require_once "views/" . $view . ".php";
        unset($_SESSION["error"]);
        unset($_SESSION["success"]);
    }

    protected function defaultRedirect() {
        if (!isset($_SESSION["userId"])) {
            // Not logged in
            header("Location: /login");
        }
        else if ($_SESSION["isAdmin"]) {
            // Logged in as admin
            header("Location: /users");
        }
        else { 
            // Logged in as user
            header("Location: /notes");
        }
        die();
    }

    protected function redirectTo(string $path) {
        header("Location: " . $path);
        die();
    }
}

?>