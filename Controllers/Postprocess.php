<?php
require_once './Models/Query.php';
require_once './Models/Connection.php';
  if (isset($_POST['Submit'])) {
    session_start();
    $ob = new Query();
    $comment = $_POST['comment'];
  if (!empty($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])) {
    // File was uploaded, handle the file upload logic here.
    $image = file_get_contents($_FILES['image']['tmp_name']);
    $ob->addPost($_SESSION['email'], $comment, $image);
  }
  else {
    // No file was uploaded, handle the case where no file is uploaded.
    $ob->addComment($_SESSION['email'], $comment);
  }
}
?>
