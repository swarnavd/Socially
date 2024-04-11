<?php
require_once __DIR__ . '/Loginprocess.php';
$ob = new Loginprocess();
// Calling method to do general login.
$ob->login();
// Calling method to do login with linkedin.
$ob->LinkedIn();
?>
