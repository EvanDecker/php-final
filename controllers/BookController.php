<?php
namespace Controllers;

use App\Models\Book;
use App\Util\BookType;

require_once '../models/models.php';
require_once '../util.php';

class BookController {
    public function __construct($bookModel = null) {
        $this->url = strtok($_SERVER['REQUEST_URI'], '?');
        $this->params = $_SERVER['QUERY_STRING'];
        parse_str($_SERVER['QUERY_STRING'], $this->params);
        if ($bookModel !== null) {
            $this->bookModel = $bookModel;
        } else {
            $this->bookModel = new Book;
        }
    }
    
    public $bookModel;
    public $url;
    private $params;

    public function getView() {
        $bookController = $this;
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
        $this->params['id'] ? $newBook = new BookType($this->params['title'], $this->params['author'], $this->params['pages'], $this->params['id']) : $newBook = new BookType($this->params['title'], $this->params['author'], $this->params['pages']);
        return $newBook;
    }

    public function index($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $books = $this->bookModel->findAll();
        require_once '../views/index.php';
    }
    public function show($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $book = $this->bookModel->find($_GET['id']);
        require_once '../views/show.php';
    }
    public function create($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->requestError();
        $newBook = $this->assembleBook();
        $books = $this->bookModel->save($newBook);
        require_once '../views/create.php';
    }
    public function update($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'PATCH') return $this->requestError();
        $updateBook = $this->assembleBook();
        $books = $this->bookModel->save($updateBook, true);
        require_once '../views/update.php';
    }
    public function delete($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') return $this->requestError();
        $books = $this->bookModel->destroy($this->params['id']);
        require_once '../views/delete.php';
    }
    public function requestError() {
        require_once '../views/requestError.php';
    }
}
