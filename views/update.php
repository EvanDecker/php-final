<?php
namespace App\Views;

?>
<h1>Update a Book Already in Your App</h1>
<?php
if ($books === true) : ?>
  <p>Book successfully updated!</p>
<?php
else : ?>
  <p>Failed to update book.</p>
  <?php
  $errs = $controller->bookModel->errors();
    foreach($errs as $err) : ?>
      <p><?= $err ?></p>
    <?php endforeach ?>
<?php endif ?>