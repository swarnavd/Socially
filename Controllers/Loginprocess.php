<?php
require_once './Models/Query.php';
class Loginprocess {
  public $message;
  public function login() {
    if(isset($_POST['login'])) {
      $ob = new Connection();
      $usr = $_POST['email'];
      $psw = $_POST['password'];
      $sql = $ob->conn->prepare("SELECT * FROM info WHERE email = '$usr'");
      $sql->execute();
      $user = $sql->fetch(PDO::FETCH_ASSOC);
      // print_r($user);
      if ($user) {
        if (password_verify($psw, $user['password'])) {
          session_start();
          $_SESSION['email'] = $usr;
          $_SESSION['flag'] = 1;
          header('location:/Landing');
        }
        else {
          $this->message = "Sorry, Record not matched";
          header('location:/Login');
        }
    }
  }
}
}
