<?php
namespace App\Controllers;

require_once '../models/models.php';

class BookController
{
    public function __construct($uri, $query, $bookModel = null)
    {
        $this->uri = $uri;
        $this->query = $query;
        $this->reqData = json_decode(file_get_contents('php://input'));

        if ($bookModel === null) {
            $this->bookModel = new \App\Models\Book;
        } else {
            $this->bookModel = $bookModel;
        }
    }
    
    public $bookModel;
    public $uri;
    private $reqData;

    public function processRequest()
    {
        switch ($this->uri) {
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
    public function processErrors()
    {
        http_response_code(400);
        foreach ($this->bookModel->errors() as $err) {
            echo $err;
        }
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $books = \App\Models\Book::findAll();
        if ($books === []) {
            $this->bookModel->addError('No books found in the database.');
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($books);
        }
    }
    public function show()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return $this->requestError();
        $book = \App\Models\Book::find($this->reqData->id);
        if ($book === null) {
            $this->bookModel->addError('A book with that id does not exist.');
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($book);
        }
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->requestError();
        $result = $this->bookModel->save($this->reqData);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(201);
            echo json_encode($this->bookModel->findByTitle($this->reqData->title)[0]);
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'PATCH') return $this->requestError();
        $result = $this->bookModel->save($this->reqData, true);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($this->bookModel->findByTitle($this->reqData->title)[0]);
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') return $this->requestError();
        $result = $this->bookModel->destroy($this->reqData->id);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(204);
            echo "Book was successfully deleted.";
        }
    }
    public function requestError()
    {
        header(405);
        echo 'This route does not permit this type of request.';
    }
}
