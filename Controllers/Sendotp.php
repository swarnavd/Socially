<?php
require_once '../vendor/autoload.php';
// require_once '../Core/Dotenv.php';
use PHPMailer\PHPMailer\PHPMailer;
class Sendotp
{
  public $mail;
  public function __construct()
  {
    $dotenv = Dotenv\Dotenv::createImmutable('/var/www/mvctask/Core/');
    $dotenv->load();
    // $env = new Dotenv();
    $mail = new PHPMailer(TRUE);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = TRUE;
    $mail->isHTML(TRUE);
    $mail->Username = $_ENV['username'];
    $mail->Password = $_ENV['appPassword'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    // Adding sender's email address.
    $mail->setFrom("swarnav.das@innoraft.com");
    $this->mail = $mail;
  }
  public function sendOtp($email,  $otp)
  {
    $mail = $this->mail;
    $mail->addAddress($email);
    $mail->Subject = "OTP for registration!!";
    $mail->Body = $otp;
    $mail->send();
  }
}
