<?php
namespace App\Core;

final class Dotenv
{
  public static function load(string $rootPath, string $file = '.env'): void
  {
    $path = rtrim($rootPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;

    if (!is_file($path) || !is_readable($path)) {
      return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!$lines) return;

    foreach ($lines as $line) {
      $line = trim($line);

      // ignora comentários
      if ($line === '' || str_starts_with($line, '#')) continue;

      // KEY=VALUE
      $pos = strpos($line, '=');
      if ($pos === false) continue;

      $key = trim(substr($line, 0, $pos));
      $val = trim(substr($line, $pos + 1));

      // remove aspas simples/duplas
      if ((str_starts_with($val, '"') && str_ends_with($val, '"')) ||
          (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
        $val = substr($val, 1, -1);
      }

      if ($key === '') continue;

      // define em todos os lugares
      $_ENV[$key] = $val;
      $_SERVER[$key] = $val;
      putenv($key . '=' . $val);
    }
  }
}