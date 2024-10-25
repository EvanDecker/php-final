<?php
namespace Controllers;

use App\Models\Book;
use App\Util\BookType;

require_once '../models/models.php';
require_once '../util.php';

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
        $bookController = new BookController();
        switch ($this->url) {
            case '/':
                $this->index($bookController);
                break;
            case '/show':
                $this->show($bookController);
                break;
            case '/create':
                $this->create($bookController);
                break;
            case '/update':
                $this->update($bookController);
                break;
            case '/delete':
                $this->delete($bookController);
                break;
        }
    }

    private function assembleBook() {
        echo 'PARAMS:';
        $arr = [];
        parse_str($this->params, $arr);
        var_dump($arr);
        $newBook = new BookType($arr['title'], $arr['author'], $arr['pages']);
        return $newBook;
    }

    public function index($controller) {
        $books = $this->bookModel->findAll();
        require_once '../views/index.php';
    }
    public function show($controller) {
        $book = $this->bookModel->find($_GET['id']);
        require_once '../views/show.php';
    }
    public function create($controller) {
        $newBook = $this->assembleBook();
        $books = $this->bookModel->save($newBook);
        require_once '../views/create.php';
    }
    public function update($controller) {
        $updateBook = $this->assembleBook();
        $books = $this->bookModel->save($updateBook, true);
        require_once '../views/update.php';
    }
    public function delete($controller) {
        $books = $this->bookModel->destroy($_GET['id']);
        require_once '../views/delete.php';
    }
}
