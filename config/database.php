<?php
return [
    'dsn' => sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', env('DB_HOST', 'localhost'), env('DB_NAME', 'impact_academy')),
    'username' => env('DB_USER', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
];
