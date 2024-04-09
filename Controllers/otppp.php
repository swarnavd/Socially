<?php
require_once __DIR__ . '/Sendmail.php';
session_start();
$otpmail = new Sendmail();
// Generates OTP.
$otp = rand(10000, 99999);
// Storing otp on session for validating purpose.
$_SESSION['otp'] = $otp;
// Sending Otp to user given mail address.
$otpm = $otpmail->sendOtp($_POST['email'], $otp);
?>
