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

    /* HANYA CONTOH PEMAKAIAN, NANTI DIDELETE */
    public function getUserById() {
        $data = $this->userModel->select(["id", "name", "email"])->where([["id", "=", 1]])->fetch();
        if (!$data) {
            http_response_code(500);
            die();
        }
        $this->view("userDashboard", $data);
    }

    public function createUser() {
        $this->userModel->create(["name" => "testName", "email" => "tesEmail", "password" => "tesPassword"])->execute();
        $this->view("account");
    }
}

?>