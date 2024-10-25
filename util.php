<?php
namespace App\Util;

class BookType {
    function __construct($title, $author, $pages) {
      $this->title = $title;
      $this->author = $author;
      $this->pages = $pages;
    }
    public $title;
    public $author;
    public $pages;      
}