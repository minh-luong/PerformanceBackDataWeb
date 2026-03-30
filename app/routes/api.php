<?php

use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\AuthMiddleware;

$router->post(BASE_URL . '/api/login', [AuthController::class, 'loginPost']);
$router->get(BASE_URL . '/api/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

$router->post(BASE_URL . "/api/admin/users/create", [AdminController::class, 'createUser'], [AuthMiddleware::class, AdminMiddleware::class]);

?>