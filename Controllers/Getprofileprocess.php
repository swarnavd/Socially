<?php
require_once './Models/Query.php';
$ob = new Query();
// Fetching data related to a particular user like profile pic,name,post etc.
$pro = $ob->showProfile($start);

