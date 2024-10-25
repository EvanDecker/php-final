<?php
namespace Controllers;

use App\Models\Book;

require_once '../models/models.php';

class BookController {
    public function __construct() {
        $this->url = strtok($_SERVER['REQUEST_URI'], '?');
        $this->params = $_SERVER['QUERY_STRING'];
        $this->bookModel = new Book;
    }
    
    public $bookModel;
    public $url;
    private $params;

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
        $books = Book::findAll();
        require_once '../views/index.php';
    }
    public function show() {
        $book = Book::find($_GET['id']);
        require_once '../views/show.php';
    }
    public function create() {
        $books = Book::findAll();
        require_once '../views/create.php';
    }
    public function update() {
        $books = Book::findAll();
        require_once '../views/update.php';
    }
    public function delete() {
        $books = Book::findAll();
        require_once '../views/delete.php';
    }
}
