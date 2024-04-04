<?php
require_once './Controllers/Forgetprocess.php';
require_once './Models/Query.php';
require_once './Models/Connection.php';
if(isset($_POST['submit'])) {
  $query = new Query();
  session_start();
  $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  $query->resetPassword($_SESSION['token'], $hash,$_SESSION['email']);
  $message = "Your password is updated!Kindly signin with new password";
  session_destroy();
}
?>
