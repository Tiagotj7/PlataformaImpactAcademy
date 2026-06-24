<?php
return [
  'host' => getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? '127.0.0.1'),
  'port' => (int)(getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? 3306)),
  'db'   => getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'impact_academy'),
  'user' => getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root'),
  'pass' => getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? ''),
  'charset' => getenv('DB_CHARSET') ?: ($_ENV['DB_CHARSET'] ?? 'utf8mb4'),
  'socket'  => getenv('DB_SOCKET') ?: ($_ENV['DB_SOCKET'] ?? null),
];