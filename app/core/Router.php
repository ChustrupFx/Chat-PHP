<?php 

namespace App\Core;

class Router {

    private $routes = [];

    public function get($route, $function) {

        $data = [
            'route' => $route,
            'function' => is_object($function) 
                            ? $function 
                            : $this->controllerFunctionByString($function),
            'method' => 'GET'
        ];

        array_push($this->routes, $data);
    }

    public function dispatch() {
        $currentRoute =  $_SERVER["REQUEST_URI"];
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        foreach($this->routes as $route) {
            if ($route['route'] === $currentRoute) {

                if ($requestMethod !== $route['method']) {
                    throw new \Exception("THIS ROUTE NEEDS A $requestMethod REQUEST");
                    return;
                }

                $route['function']();
                break;
            }
        }
    }

    private function controllerFunctionByString($string) {
        [$controllerName, $functionName] = explode('@', $string);

        if (!file_exists("app/controllers/$controllerName.php"))
            throw new \Exception("The controller called $controllerName do not exists");

        require_once("app/controllers/$controllerName.php");

        $controllerInstance = new $controllerName;

        if (!method_exists($controllerInstance, $functionName))
            throw new Exception("Method $functionName does not exist on controller $controller");

        $controllerMethod = [$controllerInstance, $functionName];

        return $controllerMethod;
        
    }

}