<?php
namespace App\Core;

use PDO;
use PDOException;

final class Database
{
  private static ?PDO $pdo = null;

  public static function pdo(): PDO
  {
    if (self::$pdo) return self::$pdo;

    $cfg = require __DIR__ . '/../../config/database.php';

    $charset = $cfg['charset'] ?? 'utf8mb4';
    $db      = $cfg['db'] ?? '';
    $user    = $cfg['user'] ?? '';
    $pass    = $cfg['pass'] ?? '';
    $host    = $cfg['host'] ?? '127.0.0.1';
    $port    = (int)($cfg['port'] ?? 3306);
    $socket  = $cfg['socket'] ?? null;

    if (!empty($socket)) {
      $dsn = "mysql:unix_socket={$socket};dbname={$db};charset={$charset}";
    } else {
      $dsn = "mysql:host={$host};port={$port};dbname={$db};charset={$charset}";
    }

    try {
      self::$pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      ]);
    } catch (PDOException $e) {
      http_response_code(500);
      // Em produção, troque por log + mensagem genérica
      echo "Erro ao conectar no banco: " . htmlspecialchars($e->getMessage());
      exit;
    }

    return self::$pdo;
  }
}