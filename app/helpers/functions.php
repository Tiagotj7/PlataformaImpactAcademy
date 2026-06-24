<?php
use App\Core\Auth;

function app_cfg(string $key, $default = null) {
  static $cfg = null;
  if ($cfg === null) $cfg = require __DIR__ . '/../../config/app.php';
  return $cfg[$key] ?? $default;
}

function url(string $path = ''): string
{
  $base = '/' . trim((string)app_cfg('base_path', ''), '/');
  $base = $base === '/' ? '' : $base;

  $path = '/' . trim($path, '/');
  return $base . ($path === '/' ? '' : $path);
}

function e(string $value): string
{
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function flash(string $key, ?string $message = null): ?string
{
  if ($message !== null) {
    $_SESSION['_flash'][$key] = $message;
    return null;
  }
  $msg = $_SESSION['_flash'][$key] ?? null;
  unset($_SESSION['_flash'][$key]);
  return $msg;
}

function is_admin(): bool {
  $u = Auth::user();
  return $u && ($u['tipo'] ?? null) === 'admin';
}