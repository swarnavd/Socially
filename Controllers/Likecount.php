<?php
require_once __DIR__ . '/../Models/Query.php';
session_start();
// Getting postid from AJAX call.
$pid = (int)$_POST['postid'];
$ob= new Query();
// Checks if same user likes same post twice or not.
if($ob->getLikesinfo($_SESSION['email'], $pid)) {
  // Insert likes of post in likes table.
  $ob->insertLikes($_SESSION['email'], $pid);
  // Increases the likes count on post table.
  $ob->increaseLikes($pid);
  // Get total number of likes from post table.
  $likes = $ob->getLikes($pid);
  // Get total number of likes as response from post table.
  echo $likes;
}
else {
  // If same user tries to like same post twice then respond same number of like
  // as previous.
  $likes = $ob->getLikes($pid);
  echo $likes;
}
?>
