<?php
use App\Cores\Router;

require_once '../config/constants.php';
require_once '../app/cores/Router.php';

$router = new Router();

require_once '../app/routes/web.php';
require_once '../app/routes/api.php';

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
?>