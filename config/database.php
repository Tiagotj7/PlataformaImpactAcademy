<?php
$socket = getenv('DB_SOCKET') ?: ($_ENV['DB_SOCKET'] ?? '');
$useLocal = file_exists('/opt/lampp/var/mysql/mysql.sock') || file_exists('/var/run/mysqld/mysqld.sock');

if ($socket === '' && $useLocal) {
  $socket = file_exists('/opt/lampp/var/mysql/mysql.sock')
    ? '/opt/lampp/var/mysql/mysql.sock'
    : '/var/run/mysqld/mysqld.sock';
}

return [
  'host' => $useLocal ? '127.0.0.1' : (getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? '127.0.0.1')),
  'port' => $useLocal ? 3306 : (int)(getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? 3306)),
  'db'   => $useLocal ? 'impact_academy' : (getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'impact_academy')),
  'user' => $useLocal ? 'root' : (getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root')),
  'pass' => $useLocal ? '' : (getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? '')),
  'charset' => getenv('DB_CHARSET') ?: ($_ENV['DB_CHARSET'] ?? 'utf8mb4'),
  'socket'  => $socket ?: null,
];