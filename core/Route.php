<?php
class Route
{
    private $routes = [];

    public function get($url, $action)
    {
        $this->routes['GET'][$url] = $action;
    }

    public function post($url, $action)
    {
        $this->routes['POST'][$url] = $action;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Auto detect base folder project
        $baseFolder = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

        // Bersihkan url dari baseFolder
        $url = '/' . trim(str_replace($baseFolder, '', $url), '/');

        if (isset($this->routes[$method][$url])) {
            list($controller, $function) = explode('@', $this->routes[$method][$url]);
            $controllerFile = "../app/Controllers/{$controller}.php";

            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $obj = new $controller;
                if (method_exists($obj, $function)) {
                    $obj->$function();
                } else {
                    require_once '../app/Views/404.php';
                }
            } else {
                require_once '../app/Views/404.php';
            }
        } else {
            require_once '../app/Views/404.php';
        }
    }
}
