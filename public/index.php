<?php
namespace App;

$fullUri = $_SERVER['REQUEST_URI'];
$uri = strtok($fullUri, '?');

require './routes/routes.php';