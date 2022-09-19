<?php

namespace App\routes;

require_once "core/Routes.php";

use App\core\Routes;

class UserRoutes extends Routes {
    protected function setRoutes(): void {
        $this->get("users/(?P<id>\d+)", "UserController", "getUserById");
    }
}

?>