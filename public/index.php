<?php
use App\Router\Router;

require '../router/router.php';

$router = new Router($_SERVER['REQUEST_URI']);
$router->routeToController();
$controller = $router->makeController();
$controller->getView();