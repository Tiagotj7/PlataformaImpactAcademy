<?php
namespace App\Core;

class Router
{
  private array $routes = [];
  private string $basePath;

  public function __construct(string $basePath = '')
  {
    $this->basePath = trim($basePath, '/');
  }

  public function get(string $path, string $handler, array $middlewares = []): void
  {
    $this->map('GET', $path, $handler, $middlewares);
  }

  public function post(string $path, string $handler, array $middlewares = []): void
  {
    $this->map('POST', $path, $handler, $middlewares);
  }

  private function map(string $method, string $path, string $handler, array $middlewares): void
  {
    $path = trim($path, '/');
    $this->routes[] = compact('method', 'path', 'handler', 'middlewares');
  }

  public function dispatch(string $method, string $uri): void
  {
    $path = parse_url($uri, PHP_URL_PATH) ?? '/';
    $path = trim($path, '/');

    if ($this->basePath !== '') {
      if (str_starts_with($path, $this->basePath)) {
        $path = trim(substr($path, strlen($this->basePath)), '/');
      }
    }

    foreach ($this->routes as $route) {
      if ($route['method'] !== $method) {
        continue;
      }

      $pattern = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([^/]+)', $route['path']);
      $pattern = '#^' . $pattern . '$#';

      if (preg_match($pattern, $path, $matches)) {
        array_shift($matches);

        foreach ($route['middlewares'] as $mw) {
          if (is_array($mw)) {
            $class = $mw[0];
            $arg = $mw[1] ?? null;
            (new $class())->handle($arg);
          } else {
            (new $mw())->handle();
          }
        }

        [$class, $action] = explode('@', $route['handler']);
        $controller = new $class();
        call_user_func_array([$controller, $action], $matches);
        return;
      }
    }

    http_response_code(404);
    echo '404 - Página não encontrada';
  }
}