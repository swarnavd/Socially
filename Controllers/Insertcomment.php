<?php
require_once __DIR__ . '/../Models/Query.php';
$postId = $_POST['postid'];
$comment = $_POST['comment'];
$userId = $_POST['userid'];
$ob = new Query();
$ob->insertComments($postId, $comment, $userId);
?>
