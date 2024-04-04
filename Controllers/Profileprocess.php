<?php
require_once './Models/Query.php';

if(isset($_SESSION['flag'])) {
  session_start();
  $ob = new Query();
  $users = $ob->fetchUser($_SESSION['email']);
}
?>
