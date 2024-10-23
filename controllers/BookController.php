<?php
namespace Controllers;
use Models\Book;
require_once '../models/models.php';

$BookModel = new Book;

class BookController {
  function __construct($model){
    $this->model = $model;
  }

  public static function render() {
    require_once '../views/books.php';
  }
  public $model;
}


BookController::render();
