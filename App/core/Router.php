<?php

namespace App\core;

class Router {
    private array $routesList = [];

    function __construct() {
        // Autoload from routes folder
        foreach(glob("routes/*.php") as $fileRoute) {
            require_once $fileRoute;
            
            $className = explode("/", explode(".", $fileRoute)[0])[1];

            array_push($this->routesList, new ("App\\routes\\" . $className)());
        }
    }

    function handleRequest(): void {
        // Iterates through routes to find a handler for the corresponding route
        $path = "";
        if (isset($_GET["url"])) {
            $path = $_GET["url"];
        }

        $method = "GET";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $method = "POST";
            if (isset($_POST["_method"])) {
                if ($_POST["_method"] == "PUT") {
                    $method = "PUT";
                }
                else if ($_POST["_method"] == "DELETE") {
                    $method = "DELETE";
                }
            }
        }

        $handlerFound = false;

        foreach ($this->routesList as $routes) {
            if ($routes->handleRoute($method, $path)) $handlerFound = true;
        }

        if (!$handlerFound) {
            http_response_code(404);
            die();
        }
    }
}

?>