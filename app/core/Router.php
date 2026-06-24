<?php
class Router
{
    public function dispatch(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = array_values(array_filter(explode('/', $uri)));

        $controller = 'HomeController';
        $action = 'index';

        if (!empty($segments[0])) {
            $controller = ucfirst($segments[0]) . 'Controller';
        }

        if (!empty($segments[1])) {
            $action = $segments[1];
        }

        $controllerClass = $controller;
        if (!class_exists($controllerClass)) {
            $controllerClass = 'HomeController';
        }

        $instance = new $controllerClass();
        if (!method_exists($instance, $action)) {
            $action = 'index';
        }

        $instance->$action();
    }
}
