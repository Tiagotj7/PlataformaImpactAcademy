<?php
namespace App\Core;

class View
{
  public static function render(string $view, array $data = [], string $layout = 'layout'): void
  {
    extract($data);

    $viewFile = __DIR__ . '/../views/' . $view . '.php';
    if (!file_exists($viewFile)) {
      http_response_code(500);
      echo "View não encontrada: " . htmlspecialchars($view);
      exit;
    }

    ob_start();
    require $viewFile;
    $content = ob_get_clean();
    if (!isset($content)) {
      $content = '';
    }

    $layoutFile = __DIR__ . '/../views/' . $layout . '.php';
    require file_exists($layoutFile) ? $layoutFile : __DIR__ . '/../views/layout.php';
  }
}