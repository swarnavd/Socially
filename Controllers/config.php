
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Core/Dotenv.php';
$ob = new Dotenv();
$client_id = $_ENV['client_id'];
$client_secret = $_ENV['client_secret'];
$redirect_uri = "http://socially.com/Linkedin";
$scope = rawurlencode('openid profile email');
$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&state=foobar&scope=$scope";

