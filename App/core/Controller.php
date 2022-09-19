<?php

namespace App\core;

abstract class Controller {
    protected function view(string $view, array $data = []): void {
        require_once "views/" . $view . ".php";
    }
}

?>