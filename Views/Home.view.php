<?php
require_once __DIR__ . '/../Controllers/Sessioncheck.php';
require_once './Controllers/Profileprocess.php';
require_once './Controllers/Defaultprocess.php';
// require_once './Controllers/Likecount.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="./Views/CSS/landing-style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
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
          <li><a href="/Edit">Edit profile</a></li>
          <li><a href="/Logout">Log out</a></li>
          <!--navigation menu styling ends from here-->
        </ul>
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
    <div class="default-show">
      <?php foreach ($row as $x) : ?>
        <div class="post">
          <div class="profile-container">
            <div class="img-container">

              <?php if (!empty($x['image'])) : ?>
                <?php echo '<img src="data:image;base64,' . base64_encode($x['image']) . ' " class="im">'; ?>
              <?php endif; ?>

            </div>
            <div class="name">
              <?= $x['user'] ?>
            </div>
          </div>
          <p class="caption"><?= $x['caption'] ?></p></br>
          <?php if (!empty($x['post'])) : ?>
            <?php echo '<img src="data:image;base64,' . base64_encode($x['post']) . '" >'; ?></br>
          <?php endif; ?>
          <div class="like1">
            <div class="social" data-post-id="<?php echo $x['post_id']; ?>">
              <i class=" uil uil-thumbs-up" id="like"></i>
              <div class="show-count"><?= $x['likes_count'] ?></div>
              <div class="comment">
                <i class="uil uil-comment"></i>
              </div>
            </div>

            <div class="comment1">
              <textarea rows="3" cols="40" class="com"></textarea>
              <button type="submit" id="submit" data-user-id="<?php echo $x['id']; ?>" data-post-id="<?php echo $x['post_id']; ?>">Submit</button>
              <div class="show-comment"></div>
            </div>
          </div>


        </div>

      <?php endforeach; ?>
    </div>

    <div class="post-show">

    </div>
    <button type="button" id="button">Load more</button>
  </main>
  <script src="../Views/JS/load.js"></script>
</body>

</html>
