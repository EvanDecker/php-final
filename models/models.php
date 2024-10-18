<?php
namespace Models;

class Book {
  // CRUD books interacting w/DB
  // find() and findAll() to fetch model records

  // save() to insert or update a record into the db
    // attempt to validate the model before trying to save
      // if not validated, should return False
    // return True or False if successful
    
  // destroy() to delete the record from the db
  // validate to validate properties on the model (returns True or False as to if the model is valid)
    // should feed data to an errors() function that returns an array of errors (if any)
  function __construct(string $title, string $author, int $totalPages, int $pagesRead = 0) {
    $this->$title = $title;
    $this->$author = $author;
    $this->$totalPages = $totalPages;
    $this->$pagesRead = $pagesRead;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function getTotalPages() {
    return $this->totalPages;
  }

  public function getPagesRead() {
    return $this->pagesRead;
  }

  public function getPercentRead() {
    return ceil($this->pagesRead / $this->totalPages);
  }

  private $title;
  private $author;
  private $totalPages;
  private $pagesRead;
}