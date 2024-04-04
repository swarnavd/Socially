<?php
session_start();
if (!isset($_SESSION['flag'])) {
  header('location:/Login');
}
require_once './Controllers/Postprocess.php';
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
          <li><a href="/Add">Add Post</a></li>
          <li><a href="/Logout">Log out</a></li>
          <!--navigation menu styling ends from here-->
        </ul>
        <!--search box styling starts from here-->
        <div class="search  flex-aligncenter">
          <input type="text" placeholder="Enter Search now" class="fade">
        </div>
        <!--Search box styling ends here-->
      </div>
    </nav>
  </header>
  <main>
    <form action="/Add" method="post" enctype="multipart/form-data" class="form">
      <h3><?= $message ?>!!!</h3></br>
      <label for="comment">Enter your bio</label>
      <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Add your bio..." class="in"></textarea>
      <label for="image">Upload a image</label>
      <input type="file" id="image" name="image" accept="image/*" class="in">
      <input type="submit" name="Submit" class="sub">

    </form>
  </main>
</body>

</html>
