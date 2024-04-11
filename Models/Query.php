<?php
require_once __DIR__ . '/Connection.php';
/**
 * A class to perform various operation related to database.
 */
class Query
{
  private $query;
  public $row;
  /**
   * A function to insert data of user into database.
   *
   * @param string $user
   *  Username of a particular user.
   * @param string $email
   *  User's email id.
   * @param string $psw
   *  User's password.
   * @param string $image
   *  User's profile picture.
   *
   * @return void
   */
  public function insertion(string $user, string $email, string $psw, string $image)
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
  /**
   * A function to check if user is already registered or not.
   *
   * @param String $email
   *  User's email.
   *
   * @return boolean
   *  Returns 1 if user's email is found on DB else returns 0.
   */
  public function isExistingUser(String $email)
  {
    $ob = new Connection();
    try {
      $this->query = $ob->conn->prepare("SELECT * FROM info WHERE email = '$email'");
      $this->query->execute();
      $row = $this->query->rowCount();
      if ($row > 0) {
        return 1;
      } else {
        return 0;
      }
    } catch (Exception $e) {
      echo $e;
    }
  }
  /**
   * A function to check if user is exists in database or not.
   *
   * @param string $email
   *  User's email id.
   *
   * @return array
   *  Returns user.
   */
  public function validUser(String $email)
  {
    $ob = new Connection();
    try {
      $sql = $ob->conn->prepare("SELECT * FROM info WHERE email = '$email'");
      $sql->execute();
      $user = $sql->fetch(PDO::FETCH_ASSOC);
      return $user;
    } catch (Exception $e) {
      echo $e;
    }
  }
  /**
   * A function to add generated hashed token into database.
   *
   * @param string $email
   *  User's particular email id.
   *
   * @return string
   *  Returns a generated token.
   */
  public function addToken(string $email)
  {
    $ob = new Connection();
    $token = bin2hex(random_bytes(16));
    $tokenHash = hash("sha256", $token);
    try {
      $this->query = $ob->conn->prepare("UPDATE info set reset_token_hash = '$tokenHash' where email = '$email'");
      $this->query->execute();
    } catch (Exception $e) {
      echo $e;
    }
    return $tokenHash;
  }
  /**
   * A function to update new password to the user's existing account.
   *
   * @param string $token
   *  User's token.
   * @param string $hash
   *  User's password in form of hash.
   * @param string $email
   *  User's email.
   *
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
   *  User's email id.
   * @param string $caption
   *  Caption of a particular post.
   * @param string $image
   *  User's uploaded image.
   *
   * @return void
   */
  public function addPost(string $email, string $caption, string $image)
  {
    $ob = new Connection();
    try {
      $this->query = $ob->conn->prepare("INSERT INTO post ( user, caption, post) VALUES(:user, :caption, :post)");
      $this->query->execute(array(':user' => $email, ':caption' => $caption, ':post' => $image));
      $result = $this->query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      echo $e;
    }
  }
  /**
   * A function to add post without image.
   *
   * @param string $email
   * User's email.
   * @param string $caption.
   * User provided caption.
   *
   * @return void
   */
  public function addComment(string $email, string $caption)
  {
    $ob = new Connection();
    $this->query = $ob->conn->prepare("INSERT INTO post ( user, comment) VALUES(:user, :comment)");
    $this->query->execute(array(':user' => $email, ':comment' => $caption));
  }
  /**
   * A function to fetch information of a particular user from info table.
   *
   * @param string $email
   *  User's email id.
   *
   * @return array
   *  Return an array of information about a particular user.
   */
  public function fetchUser(string $email)
  {
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
   *  Returns array of attributes.
   */
  public function limitPost()
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT i.user, i.id, i.image,p.post,p.post_id, p.caption, p.likes_count FROM info as i INNER JOIN post as p  ON i.email=p.user LIMIT 2 ");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  /**
   * A function to fetch post with limit 2.
   *
   * @return void
   */
  public function fetchPost()
  {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("SELECT i.user, i.image,p.post, p.caption FROM info as i INNER JOIN post as p  ON i.email=p.user limit 2");
    $sql2->execute();
    $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
    return $post;
  }
  /**
   * Function to fetch posts after clicking load more with limited to 2 posts.
   *
   * @param integer $start
   *  Offset value.
   *
   * @return void
   */
  public function showProfile(int $start)
  {
    try {
      $ob = new Connection();
      $sql2 = $ob->conn->prepare("SELECT  i.user, i.image,i.id, p.post, p.caption,p.post_id, p.likes_count FROM info as i INNER JOIN post as p ON i.email=p.user LIMIT :start, 2");
      $sql2->bindParam(':start', $start, PDO::PARAM_INT);
      $sql2->execute();
      $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
      return $post;
    } catch (PDOException $e) {
      // Handle the exception .
      echo "Error: " . $e->getMessage();
    }
  }
  /**
   * Function to edit profile details mainly profile name and image.
   *
   * @param string $mail
   *  User's email id.
   * @param string $uname
   *  User's new profile name after updation.
   * @param mixed $image
   *  User's new profile picture after updation.
   *
   * @return void
   */
  public function editProfile(string $mail, string $uname,  $image)
  {
    $ob = new Connection();
    try {
      // If user don't want to update profile picture.
      if (empty($image)) {
        $sql2 = $ob->conn->prepare("UPDATE info SET user = ? WHERE email = ?");
        $sql2->bindParam(1, $uname);
        $sql2->bindParam(2, $mail);
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
    catch (Exception $e) {
      echo $e;
    }
  }
  /**
   * Function to identify the post in which user put a like.
   *
   * @param string $email
   *  User's email id.
   * @param integer $pid
   *  Post id in post table.
   *
   * @return void
   */
  public function insertLikes(string $email, int $pid)
  {
    $ob = new Connection();
    $query = $ob->conn->prepare("INSERT INTO likes (user, post_id) VALUES(:user, :post_id)");
    $query->execute(array(':user' => $email, ':post_id' => $pid));
  }
  /**
   * Function to identify if a user likes post once or multiple times.
   *
   * @param string $user
   *  User's id.
   * @param integer $pid
   *  Post id.
   *
   * @return void
   */
  public function getLikesinfo(string $user, int $pid)
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT * FROM likes where user=? and post_id=?");
    $sql->execute([$user, $pid]);
    if ($sql->rowCount() > 0) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
  /**
   * Function to increase the number of likes in post table.
   *
   * @param integer $pid
   *  Post id.
   *
   * @return void
   */
  public function increaseLikes(int $pid)
  {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("UPDATE post SET likes_count = COALESCE(likes_count, 0) + 1 where post_id = $pid");
    $sql2->execute();
  }
  /**
   * Function to get likes count from post table with respect to post id.
   *
   * @param integer $pid
   *  Post id.
   *
   * @return void
   */
  public function getLikes(int $pid)
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("select likes_count from post where post_id=?");
    $sql->execute([$pid]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    return $result['likes_count'];
  }
  /**
   * Function to insert comments,postid and userid in comments table.
   *
   * @param integer $pid
   *  Post id.
   * @param string $comment
   *  User's comment.
   * @param string $userid
   *  User id of particular user who commented.
   *
   * @return void
   */
  public function insertComments(int $pid, string $comment, string $userid)
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("INSERT INTO comment(post_id, comment, userid) VALUES (:post_id, :comment, :userid)");
    $sql->execute(array(':post_id' => $pid, ':comment' => $comment, ':userid' => $userid));
  }
  /**
   * Function to get comments.
   *
   * @param int $pid
   *  Post id in which user commented.
   *
   * @return void
   */
  public function getComments($pid)
  {
    $ob = new Connection();
    $sql = $ob->conn->prepare("SELECT * FROM comment where post_id = ?");
    $sql->execute([$pid]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  /**
   * Function to do registration with linkedin data if email id is not
   * registered in our database.
   *
   * @param string $user
   *  User's user name in linkedin.
   * @param string $email
   *  User's email id on linkedin.
   * 
   * @return void
   */
  public function linkedinRegister(string $user, string $email)
  {
    $ob = new Connection();
    $query = $ob->conn->prepare("INSERT INTO info (user, email) VALUES(:user, :email)");
    $query->execute(array(':user' => $user, ':email' => $email));
  }
  public function commentDetails()
  {
    $ob = new Connection();
    $sql2 = $ob->conn->prepare("SELECT i.user, i.image FROM info as i INNER JOIN comment as c  ON i.id=c.userid");
    $sql2->execute();
    $post = $sql2->fetchAll(PDO::FETCH_ASSOC);
    return $post;
  }
}
