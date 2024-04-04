<?php
require './Controllers/Otpvalidation.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="./Views/CSS/registration-style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="./Views/JS/script.js"></script>
</head>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <?php $message ?>
    <div class="form">
      <div class="title">Welcome</div>
      <div class="subtitle">Let's create your account!</div>

      <p class="errormessage"><?php echo $message ?></p>

      <div class="input-container ic1">

        <input id="firstname" class="input" type="text" placeholder=" " name="uname" />
        <div class="cut"></div>
        <label for="name" class="placeholder">Name</label>
      </div>

      <div class="input-container ic2">
        <input id="email" class="input" type="text" id="email" placeholder="enter your email id... " name="email" />
        <div class="cut cut-short"></div>
        <label for="email" class="placeholder">Email</>
      </div>

      <div class="input-container ic2">
        <input id="password" class="input" type="password" placeholder="Enter password.. " name="password" />
      </div>

      <div class="input-container ic2">
        <input type="file" id="image" name="image" accept="image/*" class="in">
      </div>


      <div id="otpf">
        <input id="otpi" class="input" type="text" placeholder="Enter OTP.. " name="otp" />

      </div>
      <div class="input-container ic2">
        <a href="/Login" class="signin">Sign in </a>
      </div>
      <input type="submit" class="submit" name="submit" id="submit"></button>
    </div>

    <button type="button" id="otp">Get otp</button>
  </form>

</body>

</html>
