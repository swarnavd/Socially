<?php
require_once '../Controllers/Sendotp.php';
// require_once '../Models/Query.php';

session_start();
$otpmail = new Sendotp();
$otp = rand(10000, 99999);
  $_SESSION['otp'] = $otp;
  $otpm = $otpmail->sendOtp($_POST['email'], $otp);


?>
