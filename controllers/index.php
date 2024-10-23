<?php
namespace Controllers;
use Models\Book;
require_once '../models/models.php';

$BookModel = new Book;

class BookController extends Book {
  public static function render() {
    require_once '../views/index.php';
  }
}

$BookController = new BookController();
BookController::render();
