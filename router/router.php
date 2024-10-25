<?php
namespace App\Router;

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
    //index (show all records), show    (1 record), create, update, delete

    public function routeToController() {
        if(array_key_exists($this->uri, $this->routes)) {
            require $this->routes[$this->uri];
        } else {
            $this->abort();
        }
    }

    private function abort() {
        http_response_code(404);
    
        require 'views/404.view.php';
    
        die();
    }
}

