<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ReportController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\AdminMiddleware;

$router->get(BASE_URL . '/', [HomeController::class, 'index'], [AuthMiddleware::class]);
$router->get(BASE_URL . '/login', [AuthController::class, 'loginPage']);
$router->get(BASE_URL . '/dashboard', [HomeController::class, 'showDashboard'], [AuthMiddleware::class]);
$router->get(BASE_URL . '/change-password', [AuthController::class, 'changePasswordPage'], [AuthMiddleware::class]);

$router->get(BASE_URL . '/data', [ReportController::class, 'manageMyDataPage'], [AuthMiddleware::class]);
$router->get(BASE_URL . '/data/edit/{year}/{month}', [ReportController::class, 'editDataPage'], [AuthMiddleware::class]);

$router->get(BASE_URL . '/admin/users', [AdminController::class, 'manageUserPage'], [AuthMiddleware::class, AdminMiddleware::class]);
$router->get(BASE_URL . '/admin/users/create', [AdminController::class, 'createUserPage'], [AuthMiddleware::class, AdminMiddleware::class]);
?>