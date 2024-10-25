<?php
namespace App\Util;

class BookType {
    function __construct($title, $author, $pages, $id = null) {
      $this->title = $title;
      $this->author = $author;
      $this->pages = $pages;
      if ($id !== null) $this->id = $id;
    }
    public $title;
    public $author;
    public $pages;
    public $id;
}