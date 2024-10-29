<?php
namespace App\Router;

use App\Controllers\BookController;

require_once '../controllers/BookController.php';

class Router
{
    public function __construct($fullUrl)
    {
        $parsed = parse_url($fullUrl);
        $this->uri = $parsed['path'];
        $this->query = $parsed['query'];
    }

    private $uri;
    private $query;
    private $routes = [
        '/' => '../controllers/BookController.php',
        '/show' => '../controllers/BookController.php',
        '/create' => '../controllers/BookController.php',
        '/update' => '../controllers/BookController.php',
        '/delete' => '../controllers/BookController.php',
    ];

    public function routeToController()
    {
        if (array_key_exists($this->uri, $this->routes)) {
            require_once $this->routes[$this->uri];
        } else {
            $this->abort();
        }
    }

    public function makeController()
    {
        return new BookController($this->uri, $this->query);
    }

    private function abort()
    {
        http_response_code(404);
    
        require '../views/404.view.php';
    
        die();
    }
}
