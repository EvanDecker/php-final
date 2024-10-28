<?php
namespace App\Views\Books;
?>

<ul>
    <?php foreach ($books as $book) : ?>
        <div style="margin-bottom: 34px;">
            <p>Title: <?= $book->title ?></p>
            <p>Author: <?= $book->author ?></p>
            <p>Pages: <?= $book->pages ?></p>
        </div>
    <?php endforeach ?>
    </ul>
    