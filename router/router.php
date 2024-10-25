<?php
namespace App\Router;
use Controllers\BookController;

require_once '../controllers/BookController.php';

class Router
{
    public function __construct($fullUrl) {
        $this->fullUri = $fullUrl;
        $this->uri = strtok($this->fullUri, '?');
    }

    private $fullUri;
    private $uri;
    private $routes = [
        '/' => '../controllers/BookController.php',
        '/show' => '../controllers/BookController.php',
        '/create' => '../controllers/BookController.php',
        '/update' => '../controllers/BookController.php',
        '/delete' => '../controllers/BookController.php',
    ];

    public function routeToController() {
        if(array_key_exists($this->uri, $this->routes)) {
            require_once $this->routes[$this->uri];
        } else {
            $this->abort();
        }
    }

    public function makeController() {
        return new BookController();
    }

    private function abort() {
        http_response_code(404);
    
        require '../views/404.view.php';
    
        die();
    }
}
