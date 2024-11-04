<?php
namespace App\Repositories;
use \App\Repositories\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    /** The model that interacts with the DB. */
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Calls the model's find method.
     * 
     * @param int $id The id of the book to be found.
     * 
     * @return mixed The result as an array of objects.
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Calls the model's findAll method.
     * 
     * @return mixed The results as an array of objects.
     */
    public function findAll()
    {
        return $this->model->findAll();
    }

    /**
     * Calls the model's create method.
     * 
     * @param mixed $book The book to be added to the DB.
     * 
     * @return bool The success of the operation.
     */
    public function create($book)
    {
        return $this->model->save($book);
    }

    /**
     * Calls the model's update method.
     * 
     * @param mixed $book The book to be updated.
     * @param bool $update Flag to indicate an update instead of an insert.
     * 
     * @return mixed The success of the operation.
     */
    public function update($book, $update)
    {
        return $this->model->save($book, $update);
    }

    /**
     * Calls the model's destroy method.
     * 
     * @param int $id The ID of the book to be deleted.
     * 
     * @return bool The success of the operation.
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Calls the model's findByTitle method.
     * 
     * @param string $title The title of the book to be found.
     * 
     * @return mixed The results as an array of objects.
     */
    public function findByTitle($title)
    {
        return $this->model->findByTitle($title);
    }

    /**
     * Calls the model's errors method.
     * 
     * @return string[] The array of errors.
     */
    public function errors()
    {
        return $this->model->errors();
    }

    /**
     * Calls the model's addError method.
     * 
     * @param string $err The error to be added.
     * 
     * @return void
     */
    public function addError($err)
    {
        $this->model->addError($err);
    }

    /**
     * Calls the model's removeError method.
     * 
     * @param string $err The error to be removed.
     * 
     * @return void
     */
    public function removeError($err)
    {
        $this->model->removeError($err);
    }

    /**
     * Calls the model's checkErrInArr method.
     * 
     * @param string $err The error to be checked.
     * 
     * @return void
     */
    public function checkErrInArr($err)
    {
        $this->model->checkErrInArr($err);
    }

    /**
     * Calls the model's validate method.
     * 
     * @return bool The success of the operation.
     */
    public function validate()
    {
        return $this->model->validate();
    }
}