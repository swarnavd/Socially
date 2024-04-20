<?php
require_once __DIR__ . '/../Models/Query.php';
$ob = new Query();
// Fetching data for showing two posts by default.
$row = $ob->limitPost();
?>
