<?php

namespace App\routes;

require_once "core/Routes.php";

use App\core\Routes;

class AuthRoutes extends Routes {
    protected function defineRoutes(): void {
        $this->get("login", "AuthController", "showLoginPage");
        $this->get("register", "AuthController", "showRegisterPage");
        $this->post("login", "AuthController", "login");
        $this->post("register", "AuthController", "register");
        $this->post("logout", "AuthController", "logout");
    }
}

?>