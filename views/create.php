<?php
namespace App\Views;

?>
<h1>Create a Book!</h1>
<?php
if ($books === true) : ?>
  <p>Book successfully created!</p>
<?php
else : ?>
  <p>Failed to create book.</p>
  <?php
  $errs = $controller->bookModel->errors();
    foreach($errs as $err) : ?>
      <p><?= $err ?></p>
    <?php endforeach ?>
<?php endif ?>