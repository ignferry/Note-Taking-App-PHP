<?php

namespace App\core;

require_once "Router.php";

use App\core\Router;

class App {
    private Router $router;

    public function __construct() {
        $this->router = new Router();
        $this->router->handleRequest();
    }
}

?>