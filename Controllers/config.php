
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Core/Dotenv.php';
// Creating object of Dotenv class.
$ob = new Dotenv();
// Accessing client id of linkedin from .env file.
$client_id = $_ENV['client_id'];
// Accessing client secret of linkedin from .env file.
$client_secret = $_ENV['client_secret'];
// Redirected uri which same with the link provided on linkdin.Basically callback
// url.
$redirect_uri = "http://socially.com/Linkedin";
// Defining scope.
$scope = rawurlencode('openid profile email');
$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&state=foobar&scope=$scope";

