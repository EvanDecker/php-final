<?php
namespace Views;
use Models\Book;
// use Util\BookType;
require_once '../models/models.php';
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <h1>Book App</h1>
  <?php
    // $ack = new BookType("ACK, a story", "Greg Gregson", 989);
    // $BookModel->save($ack);
    // $BookModel->destroy('ACK, a story');
    $books = Book::findAll();
    require_once '../views/books-view.php';
  ?>
</body>


