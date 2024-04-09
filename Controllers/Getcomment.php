<?php
require_once __DIR__ . '/../Models/Query.php';
$postId = $_POST['postid'];
$comment = $_POST['comment'];
// echo $postId;
// $userId = $_POST['userid'];
$ob = new Query();
$commen = $ob->getComments($postId);
// var_dump($commen) ;
   foreach($commen as $com){
      echo $com['comment']."<br>";
    }

