<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Core/Dotenv.php';
use PHPMailer\PHPMailer\PHPMailer;
/**
 * A class to send mail for different purpose.
 */
class Sendmail {
  public $mail;
  public $env;
  public function __construct() {
    $this->mail = new PHPMailer(TRUE);
    $this->env = new Dotenv();
  }
  public function config() {

    $this->mail->isSMTP(TRUE);
    $this->mail->Host = 'smtp.gmail.com';
    $this->mail->SMTPAuth = TRUE;
    $this->mail->isHTML(TRUE);
    $this->mail->Username = $_ENV['username'];
    $this->mail->Password = $_ENV['appPassword'];
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $this->mail->Port = 465;
    // Adding sender's email address.
    $this->mail->setFrom($_ENV['username']);

  }
  public function sendReset(string $email, string $link) {
    // $mail = $this->mail;
    $this->config();
    $mail = $this->mail;
    $mail->addAddress($email);
    $mail->Subject = "Reset your password!!";
    $mail->Body = "Click this <a href = '$link'>Click here</a>";
    $mail->send();
  }

  public function sendOtp(string $email,  int $otp)
  {
    $this->config();
    $mail = $this->mail;
    $mail->addAddress($email);
    $mail->Subject = "OTP for registration!!";
    $mail->Body = $otp;
    $mail->send();
  }
}
