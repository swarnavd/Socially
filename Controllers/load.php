<?php
require_once '../Models/Query.php';
$starting = $_POST['starting'];

$ob = new Query();

$pro = $ob->showProfile($starting);
?>

<?php foreach ($pro as $x) : ?>
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
    <p class="caption"><?= $x['comment'] ?></p></br>
    <?php if (!empty($x['post'])) : ?>
      <?php echo '<img src="data:image;base64,' . base64_encode($x['post']) . '" >'; ?></br>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
