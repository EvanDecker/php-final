<?php
namespace Controllers;
use Models\Book;
require_once '../models/models.php';

class BookController {
  function __construct($model){
    $this->model = $model;
  }

  public static function render() {
    $BookModel = new Book;
    $BookController = new BookController($BookModel);
    $books = $BookController->model->findAll();
    require_once '../views/books.php';
  }
  public $model;
}

BookController::render();
