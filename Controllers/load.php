<?php
require_once __DIR__ . '/../Models/Query.php';
require_once __DIR__ . '/Profileprocess.php';
// Taking offset value from AJAX call.
$starting = $_POST['starting'];
$ob = new Query();
// Fetch all the deatils related to post.
$pro = $ob->showProfile($starting);
?>
<!-- Collecting reponse as form of some div -->
<?php foreach ($pro as $x) : ?>
  <div class="post">
    <!-- Shows profile name along with profile picture -->
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
    <!-- Shows user's caption -->
    <p class="caption"><?= $x['caption'] ?></p></br>
    <!--If user upload some picture with caption then show it on feed page-->
    <?php if (!empty($x['post'])) : ?>
      <?php echo '<img src="data:image;base64,' . base64_encode($x['post']) . '" >'; ?></br>
      <div class="like">
        <i class="fa-light fa-thumbs-up" id="like"></i>
      </div>
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
  </div>
<?php endforeach; ?>
