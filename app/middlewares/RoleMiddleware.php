<?php
namespace App\Middlewares;

use App\Core\Auth;

class RoleMiddleware
{
  public function handle(?string $role = null): void
  {
    $u = Auth::user();
    if (!$u) {
      header('Location: ' . url('login'));
      exit;
    }

    if ($role && ($u['tipo'] ?? null) !== $role) {
      http_response_code(403);
      echo "403 - Acesso negado";
      exit;
    }
  }
}