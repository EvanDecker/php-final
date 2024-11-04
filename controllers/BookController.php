<?php
namespace App\Controllers;

class BookController
{
    public $bookRepo;
    private $uriArr;
    private $reqData;

    public function __construct($uriArr)
    {
        $this->reqData = json_decode(file_get_contents('php://input'));
        $this->bookRepo = new \App\Repositories\BookRepository(new \App\Models\Book);
        $this->uriArr = $uriArr;
    }

    public function processRequest()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if ($this->uriArr[2] === 'show') {
                    $this->show($this->uriArr[3]);
                } else {
                    $this->index();
                }
                break;
            case 'POST':
                $this->create();
                break;
            case 'PUT':
                $this->update();
                break;
            case 'PATCH':
                $this->update();
                break;
            case 'DELETE':
                $this->delete($this->uriArr[2]);
                break;
        }
    }

    public function processErrors()
    {
        http_response_code(400);
        foreach ($this->bookRepo->errors() as $err) {
            echo $err;
        }
    }

    public function index()
    {
        $books = \App\Models\Book::findAll();
        if ($books === []) {
            $this->bookRepo->addError('No books found in the database.');
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($books);
        }
    }

    public function show($id)
    {
        $book = \App\Models\Book::find($id);
        if ($book === null) {
            $this->bookRepo->addError('A book with that id does not exist.');
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($book);
        }
    }

    public function create()
    {
        $result = $this->bookRepo->save($this->reqData);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(201);
            echo json_encode($this->bookRepo->findByTitle($this->reqData->title)[0]);
        }
    }

    public function update()
    {
        $result = $this->bookRepo->save($this->reqData, true);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($this->bookRepo->findByTitle($this->reqData->title)[0]);
        }
    }

    public function delete($id)
    {
        $result = $this->bookRepo->destroy($id);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(204);
            echo "Book was successfully deleted.";
        }
    }

    public function requestError()
    {
        echo 'Something went wrong with your request.';
    }
}
