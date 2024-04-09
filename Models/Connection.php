<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Core/Dotenv.php';
/**
 * Connection class to establish database connection.
 */
class Connection {
  public $conn;
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
