<?php

namespace App\controllers;

require_once "core/Controller.php";

use App\core\Controller;

class HomeController extends Controller {
    public function showHomePage() {
        $this->view("home");
    }
}

?>