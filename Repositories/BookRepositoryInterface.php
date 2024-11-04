<?php
namespace App\Repositories;

interface BookRepositoryInterface
{
    public function __construct($model);

    public function find($id);
    public function findAll();
    public function create($book);
    public function update($book, $update);
    public function destroy($id);
    public function findByTitle($title);

    public function errors();
    public function addError($err);
    public function removeError($err);
    public function checkErrInArr($err);
    public function validate();
}