<?php
namespace App\Core;

class Controller
{
  // Layout padrão do controller (páginas públicas usam 'layout' com a navbar institucional).
  // Controllers de área logada sobrescrevem esta propriedade para 'layout_app' (sidebar).
  protected string $defaultLayout = 'layout';

  protected function view(string $view, array $data = [], ?string $layout = null): void
  {
    View::render($view, $data, $layout ?? $this->defaultLayout);
  }

  protected function redirect(string $path): void
  {
    header('Location: ' . url($path));
    exit;
  }
}