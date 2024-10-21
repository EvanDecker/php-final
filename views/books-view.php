<?php
namespace Views;
?>

<ul>
    <?php foreach ($books as $book) : ?>
      <div>
        <p>Title: <?= $book->Title ?></p>
        <p>Author: <?= $book->Author ?></p>
        <p>Pages: <?= $book->Pages ?></p>
      </div>
    <?php endforeach ?>
  </ul>
  