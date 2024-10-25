<?php
namespace Controllers;

use App\Models\Book;

require_once '../models/models.php';

class BookController {
    public function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->bookModel = new Book;
    }
    
    public $bookModel;
    public $url;

    public function getView() {
        $BookController = new BookController();
        switch ($this->url) {
            case '/':
                $this->index();
                break;
            case '/show':
                $this->show();
                break;
            case '/create':
                $this->create();
                break;
            case '/update':
                $this->update();
                break;
            case '/delete':
                $this->delete();
                break;
        }
    }

    public function index() {
        $BookController = new BookController();
        $books = Book::findAll();
        require_once '../views/index.php';
    }
    public function show() {
        $BookController = new BookController();
        $books = Book::findAll();
        require_once '../views/show.php';
    }
    public function create() {
        $BookController = new BookController();
        $books = Book::findAll();
        require_once '../views/create.php';
    }
    public function update() {
        $BookController = new BookController();
        $books = Book::findAll();
        require_once '../views/update.php';
    }
    public function delete() {
        $BookController = new BookController();
        $books = Book::findAll();
        require_once '../views/delete.php';
    }
}
