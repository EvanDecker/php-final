<?php
namespace App\Router;

class Router
{
    public function __construct($fullUri)
    {
        $parsed = parse_url($fullUri);
        $this->uri = $parsed['path'];
    }

    private $uri;
    private $routes = [
        '/' => '../controllers/BookController.php',
        '/show' => '../controllers/BookController.php',
        '/create' => '../controllers/BookController.php',
        '/update' => '../controllers/BookController.php',
        '/delete' => '../controllers/BookController.php',
    ];

    public function makeController()
    {
        return new \App\Controllers\BookController($this->uri);
    }

    private function abort()
    {
        http_response_code(404);
    
        return "{error: 'page not found.'";
    }
}
