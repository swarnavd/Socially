<?php
  require_once __DIR__ . '/Connection.php';
/**
 * A class to perform various operation related to database.
 */
class Query
{
  private $query;
  public $row ;
  /**
   * A function to insert data of user into database.
   *
   * @param string $user
   * @param string $email
   * @param string $psw
   * @param string $image
   * @return void
   */
  public function insertion(string $user, string $email, string $psw, string $image)
  {
    $ob = new Connection();
    try {
      $this->query = $ob->conn->prepare("INSERT INTO info ( user, email, password, image) VALUES(:user, :email, :password, :image)");
      $this->query->execute(array(':user' => $user, ':email' => $email, ':password' => $psw, ':image' => $image));
      $result = $this->query->fetch(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
      echo $e;
    }
  }
  /**
   * A function to check if user is already registered or not.
   *
   * @param String $user
   * @return boolean
   */
  public function isExistingUser(String $user)
  {
    $ob = new Connection();
    try {
      $this->query = $ob->conn->prepare("SELECT * FROM info WHERE email = '$user'");
      $this->query->execute();
      $row = $this->query->rowCount();
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
  /**
   * A function to check if user is exists in database or not.
   *
   * @param String $usr
   * @return void
   */
  public function validUser(String $usr) {
    $ob = new Connection();
    try {
      $sql = $ob->conn->prepare("SELECT * FROM info WHERE email = '$usr'");
      $sql->execute();
      $user = $sql->fetch(PDO::FETCH_ASSOC);
      return $user;
    }
    catch(Exception $e) {
      echo $e;
    }
  }
  /**
   * A function to add generated hashed token into database.
   *
   * @param string $email
   * @return string
   */
  public function addToken(string $email)
  {
    $ob = new Connection();
    $token = bin2hex(random_bytes(16));
    $tokenHash = hash("sha256", $token);
    try {
      $this->query = $ob->conn->prepare("UPDATE info set reset_token_hash='$tokenHash' where email='$email'");
      $this->query->execute();
    }
    catch (Exception $e) {
      echo $e;
    }
    return $tokenHash;
  }
  /**
   * A function to update new password to the user's existing account.
   *
   * @param string $token
   * @param string $hash
   * @param string $email
   * @return void
   */
  public function resetPassword(string $token, string $hash, string $email)
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT * FROM info WHERE reset_token_hash = '{$token}'");
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $sql = $ob->conn->prepare("UPDATE info SET password=:hash, reset_token_hash=NULL, reset_token_expires_at=NULL WHERE email=:email");
      $sql->bindParam(':hash', $hash, PDO::PARAM_STR);
      $sql->bindParam(':email', $email, PDO::PARAM_STR);
      $sql->execute();
    }
  }
  /**
   * A function to add post in feed page.
   *
   * @param string $email
   * @param string $comment
   * @param string $image
   * @return void
   */
  public function addPost(string $email, string $comment, string $image) {
    $ob = new Connection();
    try {
        $this->query = $ob->conn->prepare("INSERT INTO post ( user, caption, post) VALUES(:user, :caption, :post)");
        $this->query->execute(array(':user' => $email, ':caption' => $comment, ':post' => $image));
        $result = $this->query->fetch(PDO::FETCH_ASSOC);
  }
    catch (Exception $e) {
      echo $e;
  }
}
  /**
   * A function to add post without image.
   *
   * @param string $email
   * @param string $comment
   * @return void
   */
  public function addComment(string $email, string $comment)
  {
    $ob = new Connection();
    $this->query = $ob->conn->prepare("INSERT INTO post ( user, comment) VALUES(:user, :comment)");
    $this->query->execute(array(':user' => $email, ':comment' => $comment));
    $result = $this->query->fetch(PDO::FETCH_ASSOC);
  }
  /**
   * A function to fetch information of a particular user from info table.
   *
   * @param string $email
   * @return array
   */
public function fetchUser(string $email) {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT * FROM info WHERE email='{$email}'");
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    return $row;
}
  /**
   * A function to display first two post by default in home page.
   *
   * @return array
   */
  public function limitPost()
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT i.user, i.id, i.image,p.post,p.post_id, p.caption, p.likes_count FROM info as i INNER JOIN post as p  ON i.email=p.user LIMIT 2 ");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function fetchPost()
  {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("SELECT i.user, i.image,p.post, p.caption FROM info as i INNER JOIN post as p  ON i.email=p.user limit 2");
    $sql2->execute();
    $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
    return $post;
  }
  public function showProfile(int $start)
  {
    try {
      $ob = new Connection();
      $sql2 = $ob->conn->prepare("SELECT  i.user, i.image,i.id, p.post, p.caption,p.post_id, p.likes_count FROM info as i INNER JOIN post as p ON i.email=p.user LIMIT :start, 2");
      $sql2->bindParam(':start', $start, PDO::PARAM_INT);
      $sql2->execute();
      $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
      return $post;
    }
    catch (PDOException $e) {
      // Handle the exception .
      echo "Error: " . $e->getMessage();
    }
  }

  public function editProfile(string $oldname, string $uname,  $image)
  {
    $ob = new Connection();
    try {
      if(empty($image)){
        $sql2 = $ob->conn->prepare("UPDATE info SET user = ? WHERE email = ?");
        $sql2->bindParam(1, $uname);
        $sql2->bindParam(2, $oldname);
        $sql2->execute();
      }
      else {
        $sql2 = $ob->conn->prepare("UPDATE info SET user = ?, image = ? WHERE email = ?");
        $sql2->bindParam(1, $uname);
        $sql2->bindParam(2, $image);
        $sql2->bindParam(3, $oldname);
        $sql2->execute();
      }
    }
    catch (Exception $e){
      echo $e;
    }
  }
public function insertLikes(string $email, int $pid) {
    $ob = new Connection();
    $query = $ob->conn->prepare("INSERT INTO likes (user, post_id) VALUES(:user, :post_id)");
    $query->execute(array(':user' => $email, ':post_id' => $pid));
}
public function getLikesinfo(string $user, int $pid) {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT * FROM likes where user=? and post_id=?");
    $sql->execute([$user,$pid]);
    if($sql->rowCount()>0){
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

public function increaseLikes(int $pid) {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("UPDATE post SET likes_count = COALESCE(likes_count, 0) + 1 where post_id = $pid");
    $sql2->execute();
}
public function getLikes(int $pid) {
    $ob = new Connection();
    $sql = $ob->conn->prepare("select likes_count from post where post_id=?");
    $sql->execute([$pid]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    return $result['likes_count'];
  }
public function insertComments(int $pid, string $comment, string $userid) {
  $ob = new Connection();
    $sql = $ob->conn->prepare("INSERT INTO comment(post_id, comment, userid) VALUES (:post_id, :comment, :userid)");
  $sql->execute(array(':post_id' => $pid, ':comment' => $comment, ':userid' => $userid));
}
public function getComments($pid) {
  $ob = new Connection();
  $sql = $ob->conn->prepare("SELECT * FROM comment where post_id = ?");
  $sql->execute([$pid]);
  $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}
  public function linkedinRegister(string $user, string $email)
  {
    $ob = new Connection();
    $query = $ob->conn->prepare("INSERT INTO info (user, email) VALUES(:user, :email)");
    $query->execute(array(':user' => $user, ':email' => $email));
  }
  public function commentDetails() {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("SELECT i.user, i.image FROM info as i INNER JOIN comment as c  ON i.id=c.userid");
    $sql2->execute();
    $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
    return $post;
  }
}
