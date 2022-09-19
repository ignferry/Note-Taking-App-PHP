<?php

namespace App\controllers;

require_once "core/Controller.php";

use App\core\Controller;

class UserController extends Controller {
    public function getUserById(int $id) {
        $this->view("userDashboard");
    }
}

?>