<?php
class Router
{
    private $routes = [];

    public function get(string $path, array $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function dispatch(string $method, string $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            echo "404";
            return;
        }

        [$obj, $fn] = $this->routes[$method][$path];
        echo $obj->$fn();
    }
}
