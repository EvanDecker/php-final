<?php
namespace App\Router;

class Router
{
    /** @var string The current request uri. */
    private $uri;
    /** @var string[] The exploded array of the request uri. */
    private $uriArr;

    /**
     * Creates the router which will direct the entire app.
     * 
     * @param string $fullUri
     */
    public function __construct($fullUri)
    {
        $parsed = parse_url($fullUri);
        $this->uri = $parsed['path'];
        $this->uriArr = explode("/", $this->uri);
    }

    /**
     * Returns the correct controller based on the uri.
     * 
     * @return \App\Controllers\BookController
     */
    public function routeToController()
    {
        if ($this->uriArr[1] === 'books') {
            return new \App\Controllers\BookController($this->uriArr);
        } else {
            $this->abort();
        }
    }

    /**
     * Handles page errors.
     * 
     * @return never
     */
    private function abort()
    {
        http_response_code(404);

        die("{error: 'Page not found.'}");
    }
}
