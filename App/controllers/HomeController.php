<?php

namespace App\controllers;

require_once "core/Controller.php";

use App\core\Controller;

class HomeController extends Controller {
    public function showHomePage() {
        // GET /
        // Shows the home page
        
        $this->view("home");
    }
}

?>