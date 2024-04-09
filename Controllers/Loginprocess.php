<?php
require_once './Models/Query.php';
require_once __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;
/**
 * Login process class for authenticating user with their password or Linkedin.
 */
class Loginprocess {
  /**
   * Function to validate user with their password.
   *
   * @return void
   */
  public function login() {

    if (isset($_POST['login'])) {
      $ob = new Connection();
      $query = new Query();
      $usr = $_POST['email'];
      $psw = $_POST['password'];
      $user = $query->validUser($usr);
      if ($user) {
        if (password_verify($psw, $user['password'])) {
          session_start();
          $_SESSION['email'] = $usr;
          $_SESSION['flag'] = 1;
          header('location:/Home');
        }
        else {
          header('location:/403');
        }
      }
    }
  }
/**
 * A function to allow login with linkedin.
 *
 * @return void
 */
  public function LinkedIn() {
    require __DIR__ . '/config.php';
    $client = new Client();
    if (isset($_GET['code'])) {
      $code = $_GET['code'];
      // Access URL.
      $acc_url = "https://www.linkedin.com/oauth/v2/accessToken";
      try {
        $response = $client->request('POST', $acc_url, [
          'form_params' => [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri
          ]
        ]);
        $arr = json_decode($response->getBody(), true);
        $id_token = $arr['id_token'];
        try {
          $ex_arr = explode('.', $id_token);
          $payload_encrypted = $ex_arr[1];
          $payload = json_decode(base64_decode($payload_encrypted),true);
          $email = $payload['email'];
          $query = new Query();
          if ($query->isExistingUser($email)) {
            // If provided mail on linkedin page is already existing then allow
            // user to directly login.
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['flag'] = 1;
            header('location:/Home');
          }
          // If user provided mail on linkedin page is not registered then regi
          //ster first in our DB then allow login.
          else {
            $email = $payload['email'];
             $user = $payload['name'];
            $_SESSION['flag'] = 1;
            $query->linkedinRegister($user, $email);
            header('location:/Home');
          }
        }
        catch (Exception $e) {
          echo $e->getMessage();
        }
      }
      catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }
}
