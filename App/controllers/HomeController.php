<?php

namespace App\controllers;

require_once "core/Controller.php";

use App\core\Controller;

class HomeController extends Controller {
    public function home() {
        $this->view("home");
    }
}

?>