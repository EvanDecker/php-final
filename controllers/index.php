<?php
namespace Controllers;
require_once '../models/models.php';

class BookController {
  public static function render() {
    require_once '../views/index.php';
  }
}

BookController::render();
