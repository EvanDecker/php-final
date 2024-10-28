<?php
namespace Views;

?>
<h1>Here's the Book You Requested</h1>
<?php if (count($book) < 1) : ?>
  <p>A book with that ID does not exist.</p>
<?php else : ?>
<div style="margin-bottom: 34px;">
  <p>Title: <?= $book[0]->title ?></p>
  <p>Author: <?= $book[0]->author ?></p>
  <p>Pages: <?= $book[0]->pages ?></p>
</div>
<?php endif ?>