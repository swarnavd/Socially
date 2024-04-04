<?php

$url = $_SERVER['REQUEST_URI'];
$url=explode("?", $url);
switch ($url[0]) {
  case '':
    require './Views/Login.view.php';
    break;
  case '/Login':
    require './Views/Login.view.php';
    break;
  case '/Register':
    require './Views/Register.view.php';
    break;
  case '/Forget':
    require './Views/Forget.view.php';
    break;
  case '/Forgetpro':
    require './Controllers/Forgetprocess.php';
    break;
  case '/Reset':
    require './Views/Resetform.php';
    break;
  case '/Otp':
    require_once './Views/Otpform.php';
    break;
  case '/Logout':
    require './Controllers/Logoutprocess.php';
    break;
  case '/Landing':
    require './Views/landing.php';
    break;
  case '/Add':
    require './Views/Addpost.view.php';
    break;
  case '/Profile':
    require './Views/Profile.php';
    break;
  case '/Home':
    require './Views/Home.view.php';
    break;
  case '/Edit':
    require './Views/Edit.view.php';
    break;
  default:
  require './Views/Login.view.php';
}
?>
