<?php
namespace Routes;
use App;

class Router {

  protected $fullUri = App\fullUri;
  protected $uri = App\uri;

  protected $routes = ['/' => 'controllers/index.php'];

  protected function routeToController($uri, $routes) {
    if(array_key_exists($uri, $routes)) {
      require $routes[$uri];
    }
  }
}