<?php
use App\Router\Router;

require '../router/router.php';

$router = new Router($_SERVER['REQUEST_URI']);
$controller = $router->makeController();
$router->routeToController();
$controller->processRequest();