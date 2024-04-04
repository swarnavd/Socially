<?php
if ($_SERVER['SCRIPT_FILENAME'] == '/var/www/mvctask/Controllers/load.php') {
    require_once '../vendor/autoload.php';
    require_once '../Core/Dotenv.php';
} else {
    require_once './vendor/autoload.php';
    require_once './Core/Dotenv.php';
}
class Connection {
    // public $user = $_ENV['user'];
    // public $pass = "root";
    public $conn;
    function __construct() {
        $env = new Dotenv();
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=social", $_ENV['user'], $_ENV['pass']);
        }
        catch(Exception $e) {
            die("Connection error:".$e);
        }
    }
}
?>
