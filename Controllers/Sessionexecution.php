<?php
require_once './Controllers/Sessionprocess.php';
$ob = new Sessionprocess();
if($ob->sessionSet()) {
  header('location:/Landing');
  // echo "set";
}
else {
  echo "unset";
}
// else {
//   header('location:/Landing');
// }
?>
