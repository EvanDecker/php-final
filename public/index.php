<?php
require __DIR__ . '/../vendor/autoload.php';
require '../router/router.php';

$router = new \App\Router\Router($_SERVER['REQUEST_URI']);
$router->routeToController();
$controller = $router->makeController();
$controller->processRequest();
