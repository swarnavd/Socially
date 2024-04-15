<?php
require './Models/Query.php';
// Checks if submit button is pressed or not.
if (isset($_POST['submit'])) {
  session_start();
  // Validate OTP.
  if ($_SESSION['otp'] == $_POST['otp']) {
    $query = new Query();

    // If user is already registered then dont insert into DB.
    if(!$query->isExistingUser($_POST['email'])) {
      // Hashing done here.
      $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $dummyPath = "Views/Image/istockphoto-1337144146-612x612.jpg";
      $image = file_get_contents($dummyPath);
      $query->insertion($_POST['uname'], $_POST['email'], $hash, $image);
      $message = "You are succesfully registered,please sign in!!";
      session_destroy();
    }
    else {
      $message = "Email already exists";
      session_destroy();
    }
  }
// If Otp not matched.
else {
  $message = "Sorry not matched.";
  session_destroy();
}
}
?>
