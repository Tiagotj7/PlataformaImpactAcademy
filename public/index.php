<?php
declare(strict_types=1);

session_start();

$app = require __DIR__ . '/../config/app.php';
date_default_timezone_set($app['timezone'] ?? 'UTC');

require __DIR__ . '/../app/core/Autoloader.php';
\App\Core\Autoloader::register();

require __DIR__ . '/../app/helpers/functions.php';

use App\Core\Router;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RoleMiddleware;

$router = new Router($app['base_path'] ?? '');

/** Rotas públicas */
$router->get('', 'App\Controllers\HomeController@index');
$router->get('programas', 'App\Controllers\HomeController@programs');

$router->get('login', 'App\Controllers\AuthController@showLogin');
$router->post('login', 'App\Controllers\AuthController@login');
$router->get('cadastro', 'App\Controllers\AuthController@showRegister');
$router->post('cadastro', 'App\Controllers\AuthController@register');
$router->post('logout', 'App\Controllers\AuthController@logout');

/** Aluno (logado) */
$router->get('dashboard', 'App\Controllers\StudentController@dashboard', [AuthMiddleware::class]);
$router->get('meus-programas', 'App\Controllers\StudentController@myPrograms', [AuthMiddleware::class]);
$router->get('programa/{id}', 'App\Controllers\StudentController@program', [AuthMiddleware::class]);
$router->get('aula/{id}', 'App\Controllers\StudentController@lesson', [AuthMiddleware::class]);
$router->post('aula/{id}/concluir', 'App\Controllers\StudentController@concludeLesson', [AuthMiddleware::class]);
$router->get('ranking', 'App\Controllers\StudentController@ranking', [AuthMiddleware::class]);

/** Admin */
$router->get('admin', 'App\Controllers\AdminController@dashboard', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/programas', 'App\Controllers\AdminController@programs', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

// ... (mantenha as demais rotas admin como já estão)

/**
 * Defaults seguros (evita quebrar quando você testa via `php -r "require index.php"`)
 */
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri    = $_SERVER['REQUEST_URI'] ?? '/';

$router->dispatch($method, $uri);