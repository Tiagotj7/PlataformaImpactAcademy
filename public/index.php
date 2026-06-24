<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../app/core/Dotenv.php';
\App\Core\Dotenv::load(dirname(__DIR__));

$app = require __DIR__ . '/../config/app.php';
date_default_timezone_set($app['timezone'] ?? 'UTC');

require_once __DIR__ . '/../app/core/Autoloader.php';
\App\Core\Autoloader::register();

require_once __DIR__ . '/../app/helpers/functions.php';

use App\Core\Router;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RoleMiddleware;

$router = new Router($app['base_path'] ?? '');

/**
 * =========================
 * ROTAS PÚBLICAS
 * =========================
 */
$router->get('', 'App\Controllers\HomeController@index');
$router->get('programas', 'App\Controllers\HomeController@programs');

$router->get('login', 'App\Controllers\AuthController@showLogin');
$router->post('login', 'App\Controllers\AuthController@login');

$router->get('cadastro', 'App\Controllers\AuthController@showRegister');
$router->post('cadastro', 'App\Controllers\AuthController@register');

$router->post('logout', 'App\Controllers\AuthController@logout');


/**
 * =========================
 * ROTAS DO ALUNO (LOGADO)
 * =========================
 */
$router->get('dashboard', 'App\Controllers\StudentController@dashboard', [
  AuthMiddleware::class
]);

$router->get('meus-programas', 'App\Controllers\StudentController@myPrograms', [
  AuthMiddleware::class
]);

$router->get('programa/{id}', 'App\Controllers\StudentController@program', [
  AuthMiddleware::class
]);

$router->get('aula/{id}', 'App\Controllers\StudentController@lesson', [
  AuthMiddleware::class
]);

$router->post('aula/{id}/concluir', 'App\Controllers\StudentController@concludeLesson', [
  AuthMiddleware::class
]);

$router->get('ranking', 'App\Controllers\StudentController@ranking', [
  AuthMiddleware::class
]);

$router->get('perfil', 'App\Controllers\StudentController@profile', [
  AuthMiddleware::class
]);

$router->post('perfil', 'App\Controllers\StudentController@updateProfile', [
  AuthMiddleware::class
]);


/**
 * =========================
 * ROTAS ADMIN (LOGADO + ROLE ADMIN)
 * =========================
 */
$router->get('admin', 'App\Controllers\AdminController@dashboard', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/programas', 'App\Controllers\AdminController@programs', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/programas/novo', 'App\Controllers\AdminController@programCreate', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->post('admin/programas/novo', 'App\Controllers\AdminController@programStore', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/programas/{id}/editar', 'App\Controllers\AdminController@programEdit', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->post('admin/programas/{id}/editar', 'App\Controllers\AdminController@programUpdate', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->post('admin/programas/{id}/excluir', 'App\Controllers\AdminController@programDelete', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/programas/{id}/modulos', 'App\Controllers\AdminController@modules', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/programas/{id}/modulos/novo', 'App\Controllers\AdminController@moduleCreate', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->post('admin/programas/{id}/modulos/novo', 'App\Controllers\AdminController@moduleStore', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/modulos/{id}/aulas', 'App\Controllers\AdminController@lessons', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->get('admin/modulos/{id}/aulas/novo', 'App\Controllers\AdminController@lessonCreate', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

$router->post('admin/modulos/{id}/aulas/novo', 'App\Controllers\AdminController@lessonStore', [
  AuthMiddleware::class,
  [RoleMiddleware::class, 'admin']
]);

// EDITAR / EXCLUIR MÓDULOS
$router->get('admin/modulos/{id}/editar', 'App\Controllers\AdminController@moduleEdit', [
  AuthMiddleware::class, [RoleMiddleware::class, 'admin']
]);
$router->post('admin/modulos/{id}/editar', 'App\Controllers\AdminController@moduleUpdate', [
  AuthMiddleware::class, [RoleMiddleware::class, 'admin']
]);
$router->post('admin/modulos/{id}/excluir', 'App\Controllers\AdminController@moduleDelete', [
  AuthMiddleware::class, [RoleMiddleware::class, 'admin']
]);

// EDITAR / EXCLUIR AULAS
$router->get('admin/aulas/{id}/editar', 'App\Controllers\AdminController@lessonEdit', [
  AuthMiddleware::class, [RoleMiddleware::class, 'admin']
]);
$router->post('admin/aulas/{id}/editar', 'App\Controllers\AdminController@lessonUpdate', [
  AuthMiddleware::class, [RoleMiddleware::class, 'admin']
]);
$router->post('admin/aulas/{id}/excluir', 'App\Controllers\AdminController@lessonDelete', [
  AuthMiddleware::class, [RoleMiddleware::class, 'admin']
]);


/**
 * =========================
 * DISPATCH (tolerante a CLI)
 * =========================
 */
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri    = $_SERVER['REQUEST_URI'] ?? '/';

$router->dispatch($method, $uri);