<?php

namespace App\routes;

require_once "core/Routes.php";

use App\core\Routes;

class UserRoutes extends Routes {
    protected function defineRoutes(): void {
        $this->get("users", "UserController", "showAllUsers");
        $this->delete("users/(?P<id>\d+)", "UserController", "deleteUser");
        $this->get("profile", "UserController", "showProfilePage");
        $this->put("changePassword", "UserController", "changePassword");
    }
}

?>