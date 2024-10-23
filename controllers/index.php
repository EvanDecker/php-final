<?php
namespace Controllers;
use Models;
require_once '../models/models.php';

$BookModel = new Models\Book;

class BookController {
  public static function render() {
    require_once '../views/index.php';
  }
}

BookController::render();
