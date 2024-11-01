<?php
namespace App\Router;

class Router
{
    private $uri;
    private $uriArr;
    
    public function __construct($fullUri)
    {
        $parsed = parse_url($fullUri);
        $this->uri = $parsed['path'];
        $this->uriArr = explode("/", $this->uri);
        var_dump($this->uriArr);
    }

    public function routeToController()
    {
        if ($this->uriArr[1] === 'books') {
            return new \App\Controllers\BookController($this->uriArr);
        } else {
            $this->abort();
        }
    }

    private function abort()
    {
        http_response_code(404);

        die("{error: 'Page not found.'}");
    }
}
