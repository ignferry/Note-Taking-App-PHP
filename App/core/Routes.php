<?php

namespace App\core;

use Error;

abstract class Routes {
    private array $routes;

    public function __construct() {
        $this->routes = array(
            "GET" => array(),
            "POST" => array(),
            "PUT" => array(),
            "DELETE" => array()
        );

        $this->defineRoutes();
    }

    abstract protected function defineRoutes(): void;

    public function handleRoute(string $method, string $path): bool {
        $foundMatch = false;

        foreach($this->routes[$method] as $routePath => $handler) {
            
            if (preg_match("/^" . str_replace("/", "\/", $routePath) . "$/", $path, $matches)) {
                $foundMatch = true;
                $handler = $this->routes[$method][$routePath];
                $controllerName = $handler["controller"];
                $functionName = $handler["function"];

                require_once "controllers/" . $controllerName . ".php";

                $controller = new ("\\App\\controllers\\" . $controllerName)();

                $data = [];

                foreach($matches as $match => $matchData) {
                    if (!is_numeric($match)) {
                        $data[$match] = $matchData;
                    }
                }

                try {
                    call_user_func_array([$controller, $functionName], $data);
                }
                catch (Error $e) {
                    die($e->getMessage());
                }
                
            }
        } 
        
        return $foundMatch;
    }

    protected function get(string $path, string $controller, string $function): void {
        $this->routes["GET"][$path] = array(
            "controller" => $controller,
            "function" => $function
        );
    }

    protected function post(string $path, string $controller, string $function): void {
        $this->routes["POST"][$path] = array(
            "controller" => $controller,
            "function" => $function
        );
    }

    protected function put(string $path, string $controller, string $function): void {
        $this->routes["PUT"][$path] = array(
            "controller" => $controller,
            "function" => $function
        );
    }

    protected function delete(string $path, string $controller, string $function): void {
        $this->routes["DELETE"][$path] = array(
            "controller" => $controller,
            "function" => $function
        );
    }
}

?>