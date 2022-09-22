<?php

namespace App\core;

abstract class Controller {
    protected function view(string $view, array $data = []): void {
        require_once "views/" . $view . ".php";
        unset($_SESSION["error"]);
    }

    protected function defaultRedirect() {
        if (session_status() === PHP_SESSION_NONE) {
            header("Location: /login");
        }
        else if ($_SESSION["role"] == "admin") {
            header("Location: /users");
        }
        else { // role == "user"
            header("Location: /notes");
        }
        die();
    }
}

?>