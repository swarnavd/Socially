<?php
require_once __DIR__ . '/../Models/Query.php';
// Collecting data from ajax call.
$postId = $_POST['postid'];
$comment = $_POST['comment'];
$userId = $_POST['userid'];
$ob = new Query();
// Calling method to insert comment in DB.
$ob->insertComments($postId, $comment, $userId);
?>
