<?php
if ($_SERVER['SCRIPT_FILENAME'] == '/var/www/mvctask/Controllers/load.php') {
  require_once '../vendor/autoload.php';
} else {
  require_once './vendor/autoload.php';
}
class Dotenv {
  public function __construct() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
  }
}
?>
