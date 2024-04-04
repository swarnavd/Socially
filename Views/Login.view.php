<?php
require_once './Controllers/Loginexecution.php';
session_start();
if (isset($_SESSION['flag'])) {
  header('location:/Landing');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./Views/CSS/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  <div class="bg-img">
    <div class="content">
      <header>Login Form</header>
      <form action="" method="post">
        <div class="field">
          <span class="fa fa-user"></span>
          <input type="text" required placeholder="Email" name="email">
        </div>
        <div class="field space">
          <span class="fa fa-lock"></span>
          <input type="password" class="password" required placeholder="Password" name="password">

        </div>
        <div class="pass">
          <a href="/Forget">Forgot Password?</a>
        </div>
        <div class="field">
          <input type="submit" value="LOGIN" name="login">
        </div>
        <div class="login">Or login with</div>
        <div class="link">
          <div class="linkedin">
            <i class="fab fa-linkedin"><span>Linkedin</span></i>
          </div>

        </div>
        <div class="signup">Don't have account?
          <a href="/Register">SignUp Now</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
