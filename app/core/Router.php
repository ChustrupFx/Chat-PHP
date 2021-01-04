<?php 

namespace App\Core;

class Router {

    private string $currentRoute;
    private array $routes = [];

    public function get($route, $function) {

        $this->currentRoute = $route;

        $data = [
            'route' => $route,
            'function' => is_object($function) 
                            ? $function 
                            : $this->controllerFunctionByString($function),
            'method' => 'GET',
            'name' => ''
        ];

        array_push($this->routes, $data);

        return $this;
    }

    public function name(string $name): void {
        if (empty($this->currentRoute)) 
            throw new Exception('No route selected');

        foreach($this->routes as $route) {
            if ($route['route'] === $this->currentRoute) {
                
                $route['name'] = $name;

                return;
            }
        }

    }

    public function route(string $routeName): string {

        foreach($this->routes as $route) {

            if ($route['name'] === $routeName) {
                return $_SERVER["SERVER_NAME"].$route['route'];
            }

        }

        throw new Exception("There's no named with $routeName");

    }

    public function dispatch(): void {
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

    private function controllerFunctionByString(string $string) {
        [$controllerName, $functionName] = explode('@', $string);

        if (!file_exists("../app/controllers/$controllerName.php"))
            throw new \Exception("The controller called $controllerName do not exists");

        require_once("../app/controllers/$controllerName.php");

        $controllerInstance = new $controllerName;

        if (!method_exists($controllerInstance, $functionName))
            throw new Exception("Method $functionName does not exist on controller $controller");

        $controllerMethod = [$controllerInstance, $functionName];

        return $controllerMethod;


    }

}