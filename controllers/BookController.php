<?php
namespace App\Controllers;

use App\Models\Book;

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
    public function processErrors($controller) {
        http_response_code(400);
        foreach ($controller->bookModel->errors() as $err) {
            echo $err;
        }
    }
    public function index($controller) {
        //TODO: check to see if this works correctly with an empty db
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $books = $controller->bookModel->findAll();
        if ($books === null || []) {
            $controller->bookModel->addError('No books found in the database.');
            $controller->processErrors($controller);
        } else {
            http_response_code(200);
            echo json_encode($books);
        }
    }
    public function show($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $book = $controller->bookModel->find($this->reqData->id);
        if ($book === null) {
            $controller->bookModel->addError('A book with that id does not exist.');
            $controller->processErrors($controller);
        } else {
            http_response_code(200);
            echo json_encode($book);
        }
    }
    public function create($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->requestError();
        $result = $controller->bookModel->save($this->reqData);
        if ($result === false) {
            $controller->processErrors($controller);
        } else {
            http_response_code(201);
            // TODO: return the newly created book
        }
    }
    public function update($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'PATCH') return $this->requestError();
        $result = $controller->bookModel->save($this->reqData, true);
        if ($result === false) {
            $controller->processErrors($controller);
        } else {
            http_response_code(200);
            // TODO: return the newly updated book
        }
    }
    public function delete($controller) {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') return $this->requestError();
        $result = $controller->bookModel->destroy($this->reqData->id);
        if ($result === false) {
            $controller->processErrors($controller);
        } else {
            http_response_code(200);
            echo "Book was successfully deleted.";
            // TODO: return the deleted book??
        }
    }
    public function requestError() {
        header(405);
        echo 'This route does not permit this type of request.';
    }
}

// header('Content-Type: application/json; charset=utf-8');
