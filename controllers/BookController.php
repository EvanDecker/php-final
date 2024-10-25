<?php
namespace Controllers;
use App\Models\Book;
require_once '../models/models.php';

class BookController {
    function __construct($model){
        $this->model = $model;
    }
    public $model;

    public static function index() {
        $BookModel = new Book;
        $BookController = new BookController($BookModel);
        $books = $BookController->model->findAll();
        require_once '../views/index.php';
    }
    public static function show() {
        $BookModel = new Book;
        $BookController = new BookController($BookModel);
        $books = $BookController->model->findAll();
        require_once '../views/show.php';
    }
    public static function create() {
        $BookModel = new Book;
        $BookController = new BookController($BookModel);
        $books = $BookController->model->findAll();
        require_once '../views/create.php';
    }
    public static function update() {
        $BookModel = new Book;
        $BookController = new BookController($BookModel);
        $books = $BookController->model->findAll();
        require_once '../views/update.php';
    }
    public static function delete() {
        $BookModel = new Book;
        $BookController = new BookController($BookModel);
        $books = $BookController->model->findAll();
        require_once '../views/delete.php';
    }

}

BookController::index();
