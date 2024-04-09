<?php

  require_once __DIR__ . '/../vendor/autoload.php';

class Dotenv {
  public function __construct() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
  }
}
?>
