<?php
namespace App\Middlewares;

use App\Core\Auth;

class AuthMiddleware
{
  public function handle(): void
  {
    if (!Auth::check()) {
      header('Location: ' . url('login'));
      exit;
    }
  }
}