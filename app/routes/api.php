<?php

use App\Controllers\AuthController;
use App\Middlewares\AuthMiddleware;

$router->post(BASE_URL . '/api/login', [AuthController::class, 'loginPost']);
$router->get(BASE_URL . '/api/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

?>