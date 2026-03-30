<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Middlewares\AuthMiddleware;

$router->get(BASE_URL . '/', [HomeController::class, 'index'], [AuthMiddleware::class]);
$router->get(BASE_URL . '/login', [AuthController::class, 'loginPage']);
$router->get(BASE_URL . '/dashboard', [HomeController::class, 'showDashboard'], [AuthMiddleware::class]);

$router->get(BASE_URL . '/admin/users', [AdminController::class, 'index'], [AuthMiddleware::class]);
$router->get(BASE_URL . '/admin/users/add', [AdminController::class, 'addPage'], [AuthMiddleware::class]);
?>