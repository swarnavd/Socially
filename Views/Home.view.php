<?php
session_start();
if (!isset($_SESSION['flag'])) {
  header('location:/Login');
}
// require_once './Controllers/Homeprocess.php';
require_once './Controllers/Profileprocess.php';
// require_once './Controllers/load.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="./Views/CSS/landing-style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
  <main class="wrapper">
    <div class="post-show">

    </div>
    <button type="button" id="button">Load more</button>
    <input type="hidden" id="start" value="0">
  </main>
  <script>
    $(document).ready(function() {
      let offset = 0;

      $("#button").click(function() {

        offset += 2;

        $.ajax({
          url: "../Controllers/load.php",
          method: 'POST',
          data: {
            'starting': offset
          },
          success: function(response) {
            // console.log(response);
            $('.post-show').html(response);
          }

        })
      })
    })
  </script>
</body>

</html>
