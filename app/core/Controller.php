<?php
namespace App\Core;

class Controller
{
  protected function view(string $view, array $data = [], string $layout = 'layout'): void
  {
    View::render($view, $data, $layout);
  }

  protected function redirect(string $path): void
  {
    header('Location: ' . url($path));
    exit;
  }
}