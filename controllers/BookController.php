<?php
namespace App\Controllers;

use App\Models\Book;
use App\Util\BookType;

require_once '../models/models.php';
require_once '../util.php';

class BookController {
    public function __construct($uri, $query, $bookModel = null) {
        $this->uri = $uri;
        $this->query = $query;
        $this->reqData = json_decode(file_get_contents('php://input'));

        if ($bookModel !== null) {
            $this->bookModel = $bookModel;
        } else {
            $this->bookModel = new Book;
        }
    }
    
    public $bookModel;
    public $uri;
    private $reqData;
    public function getView() {
        $bookController = $this;
        switch ($this->uri) {
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

    // private function assembleBook() {
    //     // TODO:
    //     $this->params['id'] ? $newBook = new BookType($this->params['title'], $this->params['author'], $this->params['pages'], $this->params['id']) : $newBook = new BookType($this->params['title'], $this->params['author'], $this->params['pages']);
    //     return $newBook;
    // }

    public function index($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $books = $this->bookModel->findAll();
        require_once '../views/index.php';
    }
    public function show($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $book = $this->bookModel->find($this->reqData->id);
        require_once '../views/show.php';
    }
    public function create($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->requestError();
        $books = $this->bookModel->save($this->reqData);
        require_once '../views/create.php';
    }
    public function update($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'PATCH') return $this->requestError();
        $books = $this->bookModel->save($this->reqData, true);
        require_once '../views/update.php';
    }
    public function delete($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') return $this->requestError();
        $books = $this->bookModel->destroy($this->reqData->id);
        require_once '../views/delete.php';
    }
    public function requestError() {
        require_once '../views/requestError.php';
    }
}
