<?php
require_once __DIR__ . '/../Models/Query.php';
$postId = $_POST['postid'];
$comment = $_POST['comment'];
$ob = new Query();
$commen = $ob->getComments($postId);
foreach ($commen as $com) {
   echo $com['comment'] . "<br>";
}
