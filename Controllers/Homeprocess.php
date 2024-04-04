<?php
require_once './Models/Query.php';
$ob = new Query();
session_start();
$row = $ob->fetchPost();

?>
