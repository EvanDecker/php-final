<?php
namespace App\Repositories;
use \App\Repositories\BookRepositoryInterface;

require_once __DIR__ . '/BookRepositoryInterface.php';

class BookRepository implements BookRepositoryInterface
{
    public function __construct($model)
    {
        $this->model = $model;
    }

    private $model;

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findAll()
    {
        return $this->model->findAll();
    }

    public function create($book)
    {
        return $this->model->save($book);
    }

    public function update($book, $update)
    {
        return $this->model->save($book, $update);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function findByTitle($title)
    {
        return $this->model->findByTitle($title);
    }

    public function errors()
    {
        return $this->model->errors();
    }

    public function addError($err)
    {
        $this->model->addError($err);
    }

    public function removeError($err)
    {
        $this->model->removeError($err);
    }

    public function checkErrInArr($err)
    {
        $this->model->checkErrInArr($err);
    }

    public function validate()
    {
        return $this->model->validate();
    }
}