<?php 

namespace App\Core;

class Router {

    private static string $currentRoute;
    private static array $routes = [];

    private function routeExists($route) {
        foreach(self::$routes as $route) {
            if ($route['route'] === $route) return true;

            return false;
        }
    } 

    private function getRoute($route) {
        if (!$this->routeExists($route)) return null;

        foreach($this->route as $route) {
            if ($route['route'] === $route) return $route;
        }
    }

    private function addRoute($route, $function, $method) {
        self::$currentRoute = $route;

        if (Router::routeExists($route)) {

            $existingRoute = $this->getRoute($route);
            $routeMethods = $existingRoute['method'];

            if (!in_array($method, $routeMethods)) return;

            array_push($existingRoute, $method);

            return;
        }

        $data = [
            'route' => $route,
            'function' => is_object($function) 
                            ? $function 
                            : Router::controllerFunctionByString($function),
            'method' => [$method],
            'name' => ''
        ];

        array_push(self::$routes, $data);
    }

    public static function get($route, $function) {

        Router::addRoute($route, $function, 'GET');

        return new self;
    }

    public function post($route, $function) {
        self::addRoute($route, $function, 'POST');

        return new self;
    }

    public function name(string $name): void {
        if (empty(self::$currentRoute)) 
            throw new \Exception('No route selected');

        for ($i = 0; $i < self::$routes; $i++) {
            if (self::$routes[$i]['route'] === Router::$currentRoute) {
                self::$routes[$i]['name'] = $name;
                return;
            }
        }

    }

    public function route(string $routeName): string {

        foreach(self::$routes as $route) {
            if ($route['name'] === $routeName) {
                return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") 
                . "://$_SERVER[HTTP_HOST]$route[route]";
            }

        }

        throw new \Exception("There's no route named with $routeName");

    }

    public function dispatch(): void {
        $currentRoute =  $_SERVER["REQUEST_URI"];
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        foreach(self::$routes as $route) {
            if ($route['route'] === $currentRoute) {
                
                if (!in_array($requestMethod, $route['method'])) {
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
            throw new \Exception("Method $functionName does not exist on controller $controller");

        $controllerMethod = [$controllerInstance, $functionName];

        return $controllerMethod;

    }

}