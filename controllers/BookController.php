<?php
namespace App\Controllers;

use App\Models\Book;

require_once '../models/models.php';

class BookController {
    public function __construct($uri, $query, $bookModel = null) {
        $this->uri = $uri;
        $this->query = $query;
        $this->reqData = json_decode(file_get_contents('php://input'));

        $bookModel === null ? $this->bookModel = $bookModel : $this->bookModel = new Book;
    }
    
    public $bookModel;
    public $uri;
    private $reqData;

    public function processRequest() {
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
    public function processErrors() {
        http_response_code(400);
        foreach ($this->bookModel->errors() as $err) {
            echo $err;
        }
    }
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $books = Book::findAll();
        if ($books === []) {
            $this->bookModel->addError('No books found in the database.');
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($books);
        }
    }
    public function show() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $book = Book::find($this->reqData->id);
        if ($book === null) {
            $this->bookModel->addError('A book with that id does not exist.');
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($book);
        }
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->requestError();
        $result = $this->bookModel->save($this->reqData);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(201);
            echo json_encode($this->bookModel->findByTitle($this->reqData->title)[0]);
        }
    }
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'PATCH') return $this->requestError();
        $result = $this->bookModel->save($this->reqData, true);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($this->bookModel->findByTitle($this->reqData->title)[0]);
        }
    }
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') return $this->requestError();
        $result = $this->bookModel->destroy($this->reqData->id);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(204);
            echo "Book was successfully deleted.";
        }
    }
    public function requestError() {
        header(405);
        echo 'This route does not permit this type of request.';
    }
}

// header('Content-Type: application/json; charset=utf-8');
