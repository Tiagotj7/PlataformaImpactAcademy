<?php
namespace App\Core;

use App\Models\User;

class Auth
{
  public static function user(): ?array
  {
    return $_SESSION['user'] ?? null;
  }

  public static function id(): ?int
  {
    return isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;
  }

  public static function check(): bool
  {
    return self::user() !== null;
  }

  public static function attempt(string $email, string $password): bool
  {
    $user = (new User())->findByEmail($email);
    if (!$user) return false;
    if ($user['status'] !== 'ativo') return false;

    if (!password_verify($password, $user['senha'])) return false;

    session_regenerate_id(true);
    unset($user['senha']);
    $_SESSION['user'] = $user;

    return true;
  }

  public static function logout(): void
  {
    unset($_SESSION['user']);
    session_regenerate_id(true);
  }
}