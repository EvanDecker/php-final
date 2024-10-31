<?php
require_once __DIR__ . '/../vendor/autoload.php';

$router = new \App\Router\Router($_SERVER['REQUEST_URI']);
$controller = $router->makeController();
$controller->processRequest();
