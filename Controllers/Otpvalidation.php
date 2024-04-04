<?php
require './Models/Query.php';
$image = "";
if(isset($_POST['submit'])) {
  session_start();
  if ($_SESSION['otp'] == $_POST['otp']) {
    $query = new Query();
    if(!$query->isExistingUser($_POST['email'])) {
      $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $image = file_get_contents($_FILES['image']['tmp_name']);
    $query->insertion($_POST['uname'], $_POST['email'],$hash, $image);
    $message = "You are succesfully registered,please sign in!!";
    session_destroy();
    }
    else {
      $message = "Email already exists";
      session_destroy();
  }
}
else {
  $message = "Sorry not matched.";
  session_destroy();

}
}
?>
