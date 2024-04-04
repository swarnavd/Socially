<?php
require_once './vendor/autoload.php';
require_once './Core/Dotenv.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Sendmail {
  public $mail;
  public function __construct() {
    $mail = new PHPMailer(TRUE);
    $env = new Dotenv();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->isHTML(TRUE);
    $mail->Username = $_ENV['username'];
    $mail->Password = $_ENV['appPassword'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    // Adding sender's email address.
    $mail->setFrom($_ENV['username']);
    $this->mail = $mail;
  }
  public function sendReset(string $email, string $link) {
    // $mail = $this->mail;
    $mail = $this->mail;
    $mail->addAddress($email);
    $mail->Subject = "Reset your password!!";
    $mail->Body = "Click this <a href = '$link'>Click here</a>";
    $mail->send();
  }
}
