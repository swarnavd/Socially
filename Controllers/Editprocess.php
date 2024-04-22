<?php
require_once __DIR__ . '/../Models/Query.php';
//If submit button is clicked.
if (isset($_POST['submit'])) {
  $ob = new Query();
  // Checks if user want to update profile name or image or both.
  if (isset($_FILES['pp']['tmp_name']) && !empty($_FILES['pp']['tmp_name'])) {
    $image = file_get_contents($_FILES['pp']['tmp_name']);
  }
  session_start();
  $ob->editProfile($_SESSION['email'], $_POST['uname'], $image);
  }
?>
