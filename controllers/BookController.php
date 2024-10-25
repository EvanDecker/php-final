<?php
namespace Controllers;
use App\Models\Book;
require_once '../models/models.php';

class BookController {
    function __construct($model){
        $this->model = $model;
    }

    public static function index() {
        $BookModel = new Book;
        $BookController = new BookController($BookModel);
        $books = $BookController->model->findAll();
        require_once '../views/index.php';
    }
    public $model;
}

BookController::index();
