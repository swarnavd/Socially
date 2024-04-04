<?php
require './Controllers/reset-process-execution.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./Views/CSS/otp-style.css">
</head>

<body>
  <form action="" method="post" class="pass-form">
    <?php echo $message ?>
    <h1 class="heading">Type your password:</h1><input type="password" name="pass" class="mail" placeholder="Enter your new password..">
    <input type="submit" name="submit" class="submitb">
    <a href="/Login" class="signin">Signin</a>
  </form>
</body>

</html>
