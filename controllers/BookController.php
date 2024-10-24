<?php
namespace App\Controllers;

use App\Models\Book;

require_once '../models/models.php';

class BookController
{
    public function __construct($model)
    {
        $this->model = $model;
    }

    public static function render()
    {
        $BookModel = new Book;
        $BookController = new BookController($BookModel);
        $books = $BookController->model->findAll();
        require_once '../views/books.php';
    }
    public $model;
}
