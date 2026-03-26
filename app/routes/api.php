<?php

$router->post(BASE_URL . '/api/login', 'AuthController@loginPost');
$router->get(BASE_URL . '/api/logout', 'AuthController@logout', ['AuthMiddleware']);

?>