<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Core/Dotenv.php';

use PHPMailer\PHPMailer\PHPMailer;

/**
 * A class to send mail for different purpose.
 */
class Sendmail
{
  /**
   * Variable to act as a object of PHPMailer/
   *
   * @var object
   */
  public $mail;
  /**
   * A variable to act as a object of Dotenv class.
   *
   * @var object
   */
  public $env;
  /**
   * Constructor to initialize PHPMailer and Dotenv class.
   */
  public function __construct()
  {
    $this->mail = new PHPMailer(TRUE);
    $this->env = new Dotenv();
  }
  /**
   * Function to configure PHPMailer.
   *
   * @return void
   */
  public function config()
  {
    $this->mail->isSMTP(TRUE);
    $this->mail->Host = 'smtp.gmail.com';
    $this->mail->SMTPAuth = TRUE;
    $this->mail->isHTML(TRUE);
    // Accesing user name from .env file.
    $this->mail->Username = $_ENV['username'];
    // Accesing password from .env file.
    $this->mail->Password = $_ENV['appPassword'];
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $this->mail->Port = 465;
    // Adding sender's email address.
    $this->mail->setFrom($_ENV['username']);
  }
  /**
   * Function to send reset link to user's mail id.
   *
   * @param string $email
   *  User's emailid.
   * @param string $link
   *  Link to change password.
   *
   * @return void
   */
  public function sendReset(string $email, string $link)
  {
    $this->config();
    $mail = $this->mail;
    $mail->addAddress($email);
    $mail->Subject = "Reset your password!!";
    $mail->Body = "Click this <a href = '$link'>Click here</a>";
    $mail->send();
  }
  /**
   * Function to send otp to user provided mail id.
   *
   * @param string $email
   *  User's email-id.
   * @param integer $otp
   *  Generated OTP.

   * @return void
   */
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
