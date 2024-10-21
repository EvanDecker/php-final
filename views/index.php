<?php
namespace Views;
use Models\Book;
require_once '../models/models.php';
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <h1>Book App</h1>
  <?php
    $bookModel = new Book;
    $books = $bookModel->findAll();
    require_once '../views/books-view.php';
  ?>
</body>


