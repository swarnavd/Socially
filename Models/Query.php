<?php
if ($_SERVER['SCRIPT_FILENAME'] == '/var/www/mvctask/Controllers/load.php') {
  require_once '../Models/Connection.php';
}
else {
  require_once './Models/Connection.php';
}
class Query
{
  private $query;
  private $query1;
  public $row ;
  public function insertion($user, $email, $psw, $image)
  {
    $ob = new Connection();
    try {
      $this->query = $ob->conn->prepare("INSERT INTO info ( user, email, password, image) VALUES(:user, :email, :password, :image)");
      $this->query->execute(array(':user' => $user, ':email' => $email, ':password' => $psw, ':image' => $image));
      $result = $this->query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      echo $e;
    }
  }
  public function isExistingUser(String $user)
  {
    $ob = new Connection();
    try {
      $this->query1 = $ob->conn->prepare("SELECT * FROM info WHERE email = '$user'");
      $this->query1->execute();
      $result = $this->query1->fetch(PDO::FETCH_ASSOC);
      $row = $this->query1->rowCount();
      if ($row > 0) {
        return 1;
      }
      else {
        return 0;
      }
    }
    catch (Exception $e) {
      echo $e;
    }
  }

  public function addToken($email)
  {
    $ob = new Connection();
    $token = bin2hex(random_bytes(16));
    $tokenHash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 2);
    try {
      $this->query1 = $ob->conn->prepare("UPDATE info set reset_token_hash='$tokenHash' ,reset_token_expires_at='$expiry' where email='$email'");
      $this->query1->execute();
    } catch (Exception $e) {
      echo $e;
    }
    return $tokenHash;
  }

  public function resetPassword($token, $hash, $email)
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT * FROM info WHERE reset_token_hash = '{$token}'");
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $sql = $ob->conn->prepare("UPDATE info SET password=:hash, reset_token_hash=NULL, reset_token_expires_at=NULL WHERE email=:email");
      $sql->bindParam(':hash', $hash, PDO::PARAM_STR);
      $sql->bindParam(':email', $email, PDO::PARAM_STR);
      // $sql->bindParam(':val', NULL, PDO::PARAM_STR);
      // $sql->bindParam(':val', NULL, PDO::PARAM_STR);
      $sql->execute();
    }
  }
  public function addPost($email, $comment, $image) {
    $ob = new Connection();
    try {

        $this->query = $ob->conn->prepare("INSERT INTO post ( user, comment, post) VALUES(:user, :comment, :post)");
        $this->query->execute(array(':user' => $email, ':comment' => $comment, ':post' => $image));
        $result = $this->query->fetch(PDO::FETCH_ASSOC);
  }
    catch (Exception $e) {
      echo $e;
  }
}
public function addComment($email,$comment) {
    $ob = new Connection();
    $this->query = $ob->conn->prepare("INSERT INTO post ( user, comment) VALUES(:user, :comment)");
    $this->query->execute(array(':user' => $email, ':comment' => $comment));
    $result = $this->query->fetch(PDO::FETCH_ASSOC);
}
public function fetchUser($email) {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT * FROM info WHERE email='{$email}'");
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    return $row;

}

  public function fetchPost()
  {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("SELECT * FROM post");
    $sql2->execute();
    $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
    return $post;
  }
  public function showProfile($start) {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("SELECT i.user, i.image,p.post, p.comment FROM info as i INNER JOIN post as p  ON i.email=p.user limit 2,$start;
");
    $sql2->execute();
    $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
    return $post;
  }

  public function editProfile($oldname, $uname, $image)
  {
    $ob = new Connection();
    try {
      $sql2 = $ob->conn->prepare("UPDATE info SET user = ?, image = ? WHERE email = ?");
      $sql2->bindParam(1, $uname);
      $sql2->bindParam(2, $image);
      $sql2->bindParam(3, $oldname);
      $sql2->execute();
    }
    catch(Exception $e){
      echo $e;
    }

  }


}
