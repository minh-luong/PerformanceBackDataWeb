<?php

$router->get(BASE_URL . '/', 'HomeController@index');
$router->get(BASE_URL . '/login', 'AuthController@loginPage');
$router->get(BASE_URL . '/dashboard', 'HomeController@showDashboard');

?>