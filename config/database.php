<?php
return [
  // Use 127.0.0.1 para forçar TCP (evita problema de socket no XAMPP)
  'host' => '127.0.0.1',

  // Se quiser usar socket do XAMPP, preencha (opcional):
  // 'socket' => '/opt/lampp/var/mysql/mysql.sock',
  'socket' => null,

  'port' => 3306,
  'db'   => 'impact_academy',
  'user' => 'root',
  'pass' => '',
  'charset' => 'utf8mb4',
];