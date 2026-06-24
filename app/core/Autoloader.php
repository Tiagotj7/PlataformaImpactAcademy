<?php
namespace App\Core;

class Autoloader
{
  public static function register(): void
  {
    spl_autoload_register(function ($class): void {
      $prefix = 'App\\';
      $len = strlen($prefix);
      if (strncmp($prefix, $class, $len) !== 0) {
        return;
      }

      $relativeClass = substr($class, $len);
      $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
      $segments = explode('\\', $relativeClass);
      $fileName = array_pop($segments) . '.php';

      $currentDir = $baseDir;
      foreach ($segments as $segment) {
        $entries = is_dir($currentDir) ? scandir($currentDir) : [];
        $matched = null;
        $segmentLower = strtolower($segment);

        foreach ($entries as $entry) {
          if ($entry === '.' || $entry === '..') {
            continue;
          }

          if (strtolower($entry) === $segmentLower) {
            $matched = $entry;
            break;
          }
        }

        if ($matched === null) {
          return;
        }

        $currentDir .= $matched . DIRECTORY_SEPARATOR;
      }

      $entries = is_dir($currentDir) ? scandir($currentDir) : [];
      foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..') {
          continue;
        }

        if (strtolower($entry) === strtolower($fileName)) {
          require $currentDir . $entry;
          return;
        }
      }
    });
  }
}