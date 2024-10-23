<?php
namespace Views;
use Controllers\BookController;
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <h1>Book App</h1>
  <?php
    $books = BookController::findAll();
    require_once '../views/bookDisplay.php';
  ?>
</body>


