<?php
session_start();
if (!isset($_SESSION['flag'])) {
  header('location:/Login');
}
require_once './Controllers/Profileprocess.php';
require_once './Controllers/Editprocess.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="./Views/CSS/landing-style.css">
</head>

<body>
  <header>
    <nav class="nav-padding"><!--nav bar starts-->
      <div class="wrapper flexspacebetween flex-aligncenter">
        <ul>
          <!--navigation menu styling starts from here-->
          <li><a href="/Home">Home</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="/Profile">Profile</a></li>
          <li><a href="/Logout">Log out</a></li>
          <!--navigation menu styling ends from here-->
        </ul>
        <!--search box styling starts from here-->
        <!-- <div class="search  flex-aligncenter">
          <input type="text" placeholder="Enter Search now" class="fade">
        </div> -->
        <!--Search box styling ends here-->
        <div class="profile">
          <div class="img-container">
            <?php echo '<img src="data:image;base64,' . base64_encode($users['image']) . ' " class="img-profile">'; ?>
          </div>
          <div class="name1">
            <?= $users['user'] ?>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="form">
      <div class="img-container">
        <?php echo '<img src="data:image;base64,' . base64_encode($users['image']) . ' " class="img-profile1">'; ?>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <label for="uname">Change Username</label></br>
        <input type="text" value="<?= $users['user'] ?>" name="uname" class="change-input"></br>
        <label for="pp">Change profile picture</label></br>
        <input type="file" name="pp" accept="image/*" class="change-input"></br>
        <!-- <label for="password">Change Password</label></br>
        <input type="password" name="password"  class="change-input"></br> -->
        <input type="submit" name="submit">
      </form>
    </div>


  </main>
</body>

</html>
