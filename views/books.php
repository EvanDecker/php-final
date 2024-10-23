<?php
namespace Views;
use Controllers\BookController;
use Models\Book;
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <h1>Book App</h1>
  <?php
    $BookModel = new Book;
    $BookController = new BookController($BookModel);
    BookController::render();
    $books = $BookController->model->findAll();
    require_once '../views/bookDisplay.php';
  ?>
</body>


