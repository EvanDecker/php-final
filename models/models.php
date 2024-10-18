<?php
namespace Models;

class Book {
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