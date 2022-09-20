<?php

namespace App\core;

class Router {

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

        foreach(glob("routes/*.php") as $fileRoute) {
            require_once $fileRoute;
            
            $className = explode("/", explode(".", $fileRoute)[0])[1];

            if ((new ("App\\routes\\" . $className)())->handleRoute($method, $path)) $handlerFound = true;
        }

        if (!$handlerFound) {
            header("Location: /");
            die();
        }
    }
}

?>