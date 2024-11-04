<?php
namespace App\Controllers;

class BookController
{
    /** @type \App\Repositories\BookRepository $bookRepo The repo that interacts with the model. */
    public $bookRepo;
    /** @type (string)[] $uriArr The exploded uri. */
    private $uriArr;
    /** @type mixed $reqData The request body. */
    private $reqData;

    public function __construct($uriArr)
    {
        $this->reqData = json_decode(file_get_contents('php://input'));
        $this->bookRepo = new \App\Repositories\BookRepository(new \App\Models\Book);
        $this->uriArr = $uriArr;
    }

    /**
     * Determines what to execute based on the uri.
     * 
     * @return void
     */
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

    /**
     * Sets a 400 respose code and relays errors.
     * 
     * @return void
     */
    public function processErrors()
    {
        http_response_code(400);
        foreach ($this->bookRepo->errors() as $err) {
            echo $err;
        }
    }

    /**
     * Handles the base findAll books route AKA index.
     * 
     * @return void
     */
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

    /**
     * Handles the show AKA find route for a book.
     * 
     * @param mixed $id The id fo the book to be shown.
     * 
     * @return void
     */
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

    /**
     * Handles the create/POST route for a book.
     * 
     * @return void
     */
    public function create()
    {
        $result = $this->bookRepo->create($this->reqData);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(201);
            echo json_encode($this->bookRepo->findByTitle($this->reqData->title)[0]);
        }
    }

    /**
     * Handles the update/PUT/PATCH route for a book.
     * 
     * @return void
     */
    public function update()
    {
        $result = $this->bookRepo->update($this->reqData, true);
        if ($result === false) {
            $this->processErrors();
        } else {
            http_response_code(200);
            echo json_encode($this->bookRepo->findByTitle($this->reqData->title)[0]);
        }
    }

    /**
     * Handles the delete route for a book.
     * 
     * @param mixed $id The id of the book to be deleted.
     * 
     * @return void
     */
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

    /**
     * Responds with an error on a faulty request.
     * 
     * @return void
     */
    public function requestError()
    {
        echo 'Something went wrong with your request.';
    }
}
