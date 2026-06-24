<?php
require_once __DIR__ . '/../app/core/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->register();

$router = new Router();
$router->dispatch();
