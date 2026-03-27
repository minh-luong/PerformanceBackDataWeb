<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;

$router->get(BASE_URL . '/', [HomeController::class, 'index'], ['AuthMiddleware']);
$router->get(BASE_URL . '/login', [AuthController::class, 'loginPage']);
$router->get(BASE_URL . '/dashboard', [HomeController::class, 'showDashboard'], ['AuthMiddleware']);

?>