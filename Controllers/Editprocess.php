<?php
require_once './Models/Query.php';

if(isset($_POST['submit'])){
  $ob = new Query();
  if (isset($_FILES['pp']['tmp_name']) && !empty($_FILES['pp']['tmp_name'])) {
    $image = file_get_contents($_FILES['pp']['tmp_name']);
    // Process the image data
  } else {
    // Handle the case where the file was not uploaded successfully
    echo 'Error: No file uploaded';
  }

  // echo "hello";
  // var_dump($_FILES['pp']['tmp_name']);
  session_start();
  // $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $ob->editProfile($_SESSION['email'],$_POST['uname'], $image);


}
?>
