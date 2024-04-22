<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Core/Dotenv.php';
/**
 * Connection class to establish database connection.
 */
class Connection {
  /**
   * Variable to establishing connection.
   *
   * @var \PDO
   */
  public $conn;
  /**
   * Constructor to access .env file and establishing database connection.
   */
  function __construct() {
    $env = new Dotenv();
    try {
      $this->conn = new PDO($_ENV['dbName'], $_ENV['user'], $_ENV['pass']);
    }
    catch(Exception $e) {
      die("Connection error:".$e);
    }
  }
}
?>
