<?php
require './Models/Query.php';
require './Controllers/Sendmail.php';
if (!empty($_POST['email'])) {
  if (isset($_POST['submit'])) {
    session_start();
    $ob = new Query();
    $sendMail = new Sendmail();
    $token = $ob->addToken($_POST['email']);
    $_SESSION['token']=$token;
    $_SESSION['email']=$_POST['email'];
    $link = 'http://socially.com/Reset?token='.$token;
    $sendMail->sendReset($_POST['email'], $link);
  }
}
?>
